<?php

namespace Kernel\App\Extensions;

use Kernel\App\Common\Extendtion;


/**
 * CURL 没找到 dll 文件，应该是默认安装 PHP 时就有的
 * Class Curl
 * @package Kernel\App\Extensions
 */
class Openssl extends Extendtion
{
    // 打开的扩展名
    protected $dllName = 'php_openssl.dll';

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

        // 写入文件最后面
        $config = app('config')->assertConfig(';[openssl]', $this->getExtendConfig());
    }



    protected function getExtendConfig()
    {
        return <<<config
[openssl]
; The location of a Certificate Authority (CA) file on the local filesystem
; to use when verifying the identity of SSL/TLS peers. Most users should
; not specify a value for this directive as PHP will attempt to use the
; OS-managed cert stores in its absence. If specified, this value may still
; be overridden on a per-stream basis via the "cafile" SSL stream context
; option.
;openssl.cafile=
config;

    }
}