<?php

namespace DavidNineRoc\EasyExtends\Kernel;


use DavidNineRoc\EasyExtends\Contracts\Container as ContainerContract;

class Container implements ContainerContract
{
    protected static $instance;

    public function has($key)
    {

    }

    public function get($key)
    {

    }

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }


    protected function setInstance(ContainerContract $container)
    {
        static::$instance = $container;
    }
}