<?php

namespace Kernel\App;

use Closure;
use Kernel\App\Exception\ApplicationException;
use Kernel\App\Util\Config;

/**
 * 只能绑定单例简单容器
 * Class Application
 * @package Kernel\App
 */
class Application
{
    // 版本号
    const VERSION = '1.1.1';
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
            throw new ApplicationException('绑定错误');
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
            return new $this->extendMaps[$abstract];
        }


        if (! array_key_exists($abstract, $this->instances))
        {
            if (! array_key_exists($abstract, $this->binds))
            {
                throw new ApplicationException("不存在 [{$abstract}] 实例");
            }

            // 调用闭包生成实例
            $this->instances[$abstract] = call_user_func_array($this->binds[$abstract], $parameters);
        }

        return $this->instances[$abstract];
    }


    /**
     * 注册所有扩展列表
     */
    private function initAllExtendList()
    {
        $this->extendMaps = require $this->basePath . '/Kernel/App/Config/ExtendProviders.php';
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


    // 取出多余的斜杆
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

    public function getBasePath()
    {
        return $this->basePath;
    }
}