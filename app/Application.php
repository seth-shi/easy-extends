<?php

namespace DavidNineRoc\EasyExtends;

use DavidNineRoc\EasyExtends\Kernel\Container;
use DavidNineRoc\EasyExtends\Kernel\Env;
use DavidNineRoc\EasyExtends\Kernel\ExceptionHandler;


class Application extends Container
{
    use Env, ExceptionHandler;

    // 版本号
    const VERSION = '1.1.2';

    // 根目录
    public $basePath;

    // 扩展 maps
    protected $extendMaps = array();

    public function __construct($basePath = null)
    {
        if (!is_null($basePath)) {
            $this->basePath = $basePath;
        }
        $this->setInstance($this);
        $this->registerFatalHandler();
        $this->loadConfig();
    }


    public function getBasePath()
    {
        return $this->basePath;
    }
}
