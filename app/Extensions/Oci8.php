<?php

namespace Kernel\App\Extensions;

use Kernel\App\Common\Extendtion;

/**
 * 打开扩展之后需要安装oralce Instant Client
 * Class Oci8.
 */
class Oci8 extends Extendtion
{
    protected $mapUrl = array(
        '7.1-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.1.7/php_oci8-2.1.7-7.1-nts-vc14-x86.zip',
        '7.1-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.1.7/php_oci8-2.1.7-7.1-ts-vc14-x86.zip',
        '7.1-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.1.7/php_oci8-2.1.7-7.1-nts-vc14-x64.zip',
        '7.1-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.1.7/php_oci8-2.1.7-7.1-ts-vc14-x64.zip',

        '7.0-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/redis/3.1.4RC3/php_redis-3.1.4rc3-7.0-nts-vc14-x86.zip',
        '7.0-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.1.7/php_oci8-2.1.7-7.0-nts-vc14-x86.zip',
        '7.0-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.1.7/php_oci8-2.1.7-7.0-nts-vc14-x64.zip',
        '7.0-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.1.7/php_oci8-2.1.7-7.0-ts-vc14-x64.zip',

        '5.6-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.6-nts-vc11-x86.zip',
        '5.6-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.6-ts-vc11-x86.zip',
        '5.6-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.6-nts-vc11-x64.zip',
        '5.6-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.6-ts-vc11-x64.zip',

        '5.5-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.5-nts-vc11-x86.zip',
        '5.5-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.5-ts-vc11-x86.zip',
        '5.5-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.5-nts-vc11-x64.zip',
        '5.5-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.5-ts-vc11-x64.zip',

        '5.4-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.4-nts-vc9-x86.zip',
        '5.4-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.4-ts-vc9-x86.zip',

        '5.3-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.3-nts-vc9-x86.zip',
        '5.3-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.3-ts-vc9-x86.zip',
    );

    protected $dllName = 'php_oci8.dll';
}
