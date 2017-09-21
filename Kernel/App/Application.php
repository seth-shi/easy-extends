<?php

namespace Kernel\App;

use Closure;
use Kernel\App\Exception\ApplicationException;
use Kernel\App\Util\Config;
use ReflectionClass;
use ReflectionException;

/**
 * 只能绑定单例简单容器
 * Class Application
 * @package Kernel\App
 */
class Application
{
    // 版本号
    const VERSION = '1.1.2';
    // 根目录
    private $basePath;

    // 扩展 maps
    private $extendMaps = array();
    // 绑定的闭包
    private $binds = array();
    // 实例
    private $instances = array();
    // 自身静态实例
    private static $instance;

    
    public function __construct($basePath)
    {
        $basePath = str_replace('\\', '/', $basePath);

        // 把自己也注册进去
        self::$instance = $this;
        $this->instances[] = $this;

        // 网站根目录
        $this->basePath = $basePath;

        // 注册所有扩展列表
        $this->initAllExtendList();

        // 注册基本服务
        $this->regisBaseServer();

        // 备份 php.ini 文件
        $this->backup();
    }


    /**
     * 注册所有扩展列表
     */
    private function initAllExtendList()
    {
        // 注册所有扩展列表
        $this->extendMaps = require $this->basePath . '/Kernel/App/Config/ExtendProviders.php';
        // 助手函数
        require $this->basePath . '/Kernel/helper.php';
    }


    /**
     * 注册基本服务
     */
    private function regisBaseServer()
    {
        // 注册配置
        $this->bind('config', function(){
            return new Config();
        });
    }

    /**
     * 备份文件
     */
    private function backup()
    {
        $phpiniPath = $this->make('config')->getphpIniPath();
        $backupPath = $phpiniPath . '.bak';

        // 如果不存在备份文件， 就备份一次
        if (! is_file($backupPath))
        {
            if (! copy($phpiniPath, $backupPath))
            {
                exit('please backup php.ini for php.ini.bak');
            }
        }
    }



    /**
     * 把闭包放入一个绑定数组
     * @param $abstract
     * @param $concrete
     */
    public function bind($abstract, $concrete)
    {
        if ($concrete instanceof Closure)
        {
            $this->binds[$abstract] = $concrete;
        }
        elseif (is_object($concrete))
        {
            $this->instances[$abstract] = $concrete;
        }
        else
        {
            throw new ApplicationException('bind fail');
        }
    }

    /**
     * 核心方法，安装扩展
     * @param $entendName
     */
    public function make($abstract, $parameters = array())
    {
        // 转成小写，防止差错
        $abstract = strtolower($abstract);

        // 直接实例化扩展对象
        if (array_key_exists($abstract, $this->extendMaps))
        {
            // 使用反射实例化对象，而不是直接实例化
            return $this->build($this->extendMaps[$abstract]);
        }

        if (! array_key_exists($abstract, $this->instances))
        {
            if (! array_key_exists($abstract, $this->binds))
            {
                throw new ApplicationException("not exists [{$abstract}] instance");
            }

            // 调用闭包生成实例
            $this->instances[$abstract] = call_user_func_array($this->binds[$abstract], $parameters);
        }

        return $this->instances[$abstract];
    }


    /**
     * 通过反射获取实例，解决参数依赖问题
     * @param $concrete
     * @param array $parameters
     * @return mixed|object
     * @throws ApplicationException
     */
    public function build($concrete, $parameters = array())
    {
        // 回调执行
        if ($concrete instanceof Closure)
        {
            return $concrete($this, $parameters);
        }

        // 不是闭包，则通过反射获取实例
        try
        {
            $reflector = new ReflectionClass($concrete);
        }
        catch (ReflectionException  $e)
        {
            throw new ApplicationException("{$concrete} class error: {$e->getMessage()}");
        }

        // 不可以实例化类
        if (! $reflector->isInstantiable())
        {
            throw new ApplicationException($concrete . ' class not instantiable');
        }

        // 获取构造函数
        $constructor = $reflector->getConstructor();

        // 没有构造函数， 直接通过 new 实例化
        if (is_null($constructor))
        {
            return new $concrete;
        }

        // 获取参数列表， 只允许注入对象类型。
        $dependencies = $constructor->getParameters();

        /**
         * 把传进来的索引数组转换成关联数组， 键为定义时的变量名
         */
        foreach ($dependencies as $key => $value)
        {
            if (is_numeric($key))
            {
                unset($parameters[$key]);

                $parameters[$dependencies[$key]->name] = $value;
            }
        }

        // 实际生成对象需要的参数
        $instance_paramters = [];
        foreach ($dependencies as $parameter)
        {
            // 获取类名，不是对象返回 null
            $dependency = $parameter->getClass();

            if (array_key_exists($parameter->name, $parameters))
            {
                $instance_paramters[] = $parameters[$parameter->name];
            }
            if (is_null($dependency))
            {
                // 非对象类型，又没有参数，只能获取默认值
                if ($parameter->isDefaultValueAvailable())
                {
                    $instance_paramters[] = $parameter->getDefaultValue();
                }
                else
                {
                    throw new ApplicationException('parameters missing');
                }
            }
            else
            {
                // 是对象递归调用实例化
                $dependencies[] = $this->build($dependency->name);
            }
        }


        // 传入原本类构造函数的参数
        return $reflector->newInstanceArgs($dependencies);
    }


    /**
     * 取出多余的斜杆
     * @param $service
     * @return string
     */
    private function normalize($service)
    {
        return is_string($service) ? ltrim($service, '\\ ') : $service;
    }


    /**
     * 获取自身实例
     * @return Application
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * 获取根路径
     * @return mixed
     */
    public function getBasePath()
    {
        return $this->basePath;
    }
}