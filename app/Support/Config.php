<?php

namespace DavidNineRoc\EasyExtends\Support;

use DavidNineRoc\EasyExtends\Application;

class Config
{
    protected $config;

    protected static $instance;

    public function __construct(Application $app)
    {
        $this->config = require $app->getBasePath().'/bootstrap/config.php';
    }

    /**
     * a static function.
     *
     * @static
     *
     * @return array
     */
    protected function get($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->config;
        }

        return $this->config[$key];
    }

    public static function __callStatic($method, $parameters)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self(Application::getInstance());
        }

        return self::$instance->$method(...$parameters);
    }
}
