<?php

namespace DavidNineRoc\EasyExtends\Extensions;

use DavidNineRoc\EasyExtends\Foundation\NotDownloadExpand;

/**
 * CURL 没找到 dll 文件，应该是默认安装 PHP 时就有的
 * Class Curl.
 */
class Gd extends NotDownloadExpand
{
    // 打开的扩展名
    protected $dllName = 'php_gd2.dll';
}
