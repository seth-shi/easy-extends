<?php

namespace DavidNineRoc\EasyExtends;

use DavidNineRoc\EasyExtends\Kernel\Command;
use DavidNineRoc\EasyExtends\Kernel\Container;
use DavidNineRoc\EasyExtends\Kernel\Env;
use DavidNineRoc\EasyExtends\Kernel\ExceptionHandler;

class Application extends Container
{
    use Env, Command, ExceptionHandler;

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

        /*
         * 设置自己为单例，方便调用
         */
        $this->setInstance($this);

        /*
         * 注册异常，捕获控制台可能出现的异常
         */
        $this->registerFatalHandler();

        /*
         * 加载当前环境变量，包括 php 版本，
         * vc 版本，nts, win 版本
         */
        $this->registerEnv();
        $this->loadCurrentEnv();
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }
}
