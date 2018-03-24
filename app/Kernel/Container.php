<?php

namespace DavidNineRoc\EasyExtends\Kernel;

use Closure;
use DavidNineRoc\EasyExtends\Application;
use DavidNineRoc\EasyExtends\Contracts\Container as ContainerContract;
use DavidNineRoc\EasyExtends\Exception\ContainerException;
use ReflectionMethod;

class Container implements ContainerContract
{
    protected static $instance;

    protected $binds = [];

    protected $instances = [];

    public function has($key)
    {
        return isset($this->instances[$key]) || isset($this->binds[$key]);
    }

    public function get($key, $share = true)
    {
        return $this->make($key, $share);
    }

    /**
     * 绑定一个实例.
     *
     * @param $abstract
     * @param Closure $contract
     */
    public function bind($abstract, Closure $contract)
    {
        $this->binds[$abstract] = $contract;
    }

    /**
     * 生成类对象
     *
     * @param $abstract
     * @param bool $share
     *
     * @return mixed
     *
     * @throws ContainerException
     */
    public function make($abstract, $share = true)
    {
        if (!$this->has($abstract)) {
            throw new ContainerException("Not [{$abstract}] class resolve");
        }

        /****************************************
         * 如果在 instances 中不存在实例，必须实例化
         * 一个对象，如果 share 设置为 false，代表
         * 不是单例，也强制实例化一个对象
         */
        if (
            !array_key_exists($abstract, $this->instances) ||
            !$share
        ) {
            $this->resolve($abstract);
        }

        return $this->instances[$abstract];
    }

    /**
     * 执行对象的一个方法.
     *
     * @param $abstract
     * @param $method
     *
     * @throws ContainerException
     */
    public function call($abstract, $method)
    {
        /************************************
         * 如果传入的是一个对象，则直接跳出，
         * 不然，则通过 make 方法得到一个对象
         */
        do {
            if (is_object($abstract)) {
                break;
            }

            $abstract = $this->make($abstract);
        } while (false);

        if (!method_exists($abstract, $method)) {
            throw new ContainerException("[{$abstract}] Class not exists [{$method}] method!");
        }

        return $this->reflectionMethod($abstract, $method);
    }

    /**
     * 简单的解析类，在 Container::bind() 里必须
     * 强制类型，第一个 key 随意，第二个参数必须是
     * 一个闭包，而且有一个参数 Container::class.
     *
     * @param $abstract
     */
    protected function resolve($abstract)
    {
        $this->instances[$abstract] = call_user_func($this->binds[$abstract], $this);
    }

    /**
     * 获取 Container 实例.
     *
     * @return Application
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * 设置 Container 实例.
     *
     * @param ContainerContract $container
     */
    protected function setInstance(ContainerContract $container)
    {
        static::$instance = $container;
    }

    /**
     * 反射执行对象的方法.
     *
     * @param $object
     * @param $method
     *
     * @return mixed
     *
     * @throws ContainerException
     */
    protected function reflectionMethod($object, $method)
    {
        $ref = new ReflectionMethod($object, $method);

        $parameters = $ref->getParameters();

        $realParameters = [];
        foreach ($parameters as $parameter) {
            $className = $parameter->getClass();
            if (is_null($className)) {
                throw new ContainerException('Dependency injection must be an object');
            }
            $realParameters[$parameter->getName()] = $this->make($className->getName());
        }

        return $ref->invokeArgs($object, $realParameters);
    }
}
