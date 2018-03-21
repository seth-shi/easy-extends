<?php

namespace DavidNineRoc\EasyExtends;


use DavidNineRoc\EasyExtends\Foundation\Env;
use DavidNineRoc\EasyExtends\Kernel\Container;

class Application extends Container
{
    use Env;

    // 版本号
    const VERSION = '1.1.2';
    // 根目录
    protected $basePath;
    // 扩展 maps
    protected $extendMaps = array();

    public function __construct($basePath = null)
    {
        if (! is_null($basePath)) {
            $this->basePath = $basePath;
        }

        $this->setInstance($this);
        $this->loadConfig();
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