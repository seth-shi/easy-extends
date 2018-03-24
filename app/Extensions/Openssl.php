<?php

namespace DavidNineRoc\EasyExtends\Extensions;

use DavidNineRoc\EasyExtends\Foundation\NotDownloadExpand;

/**
 * CURL 没找到 dll 文件，应该是默认安装 PHP 时就有的
 * Class Curl.
 */
class Openssl extends NotDownloadExpand
{
    // 打开的扩展名
    protected $dllName = 'php_openssl.dll';


    protected function getExtendConfig()
    {
        return <<<'config'
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
