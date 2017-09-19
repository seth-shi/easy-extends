<?php

namespace Kernel\App\Extensions;

use Kernel\App\Common\Extendtion;


/**
 * CURL 没找到 dll 文件，应该是默认安装 PHP 时就有的
 * Class Curl
 * @package Kernel\App\Extensions
 */
class Curl extends Extendtion
{
    // 打开的扩展名
    protected $dllName = 'php_curl.dll';

    public function hasExtend($key)
    {
        return true;
    }

    public function downloadExtend($key = null)
    {
        return true;
    }

    /**
     * 安装扩展
     */
    public function installExtend()
    {
        // 打开扩展extension=php_bz2.dll
        $this->openExtend();
    }
}