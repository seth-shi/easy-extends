<?php

namespace Kernel\App\Extensions;

use Kernel\App\Common\Extendtion;

class Opcache extends Extendtion
{
    protected $mapUrl = array(
        '5.5-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/opcache/7.0.4/php_opcache-7.0.4-5.5-nts-vc11-x86.zip',
        '5.5-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/opcache/7.0.4/php_opcache-7.0.4-5.5-ts-vc11-x86.zip',
        '5.5-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/opcache/7.0.4/php_opcache-7.0.4-5.5-nts-vc11-x64.zip',
        '5.5-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/opcache/7.0.4/php_opcache-7.0.4-5.5-ts-vc11-x64.zip',

        '5.4-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/opcache/7.0.5/php_opcache-7.0.5-5.4-nts-vc9-x86.zip',
        '5.4-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/opcache/7.0.5/php_opcache-7.0.5-5.4-ts-vc9-x86.zip',

        '5.3-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/opcache/7.0.5/php_opcache-7.0.5-5.3-nts-vc9-x86.zip',
        '5.3-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/opcache/7.0.5/php_opcache-7.0.5-5.3-ts-vc9-x86.zip',
    );

    protected $dllName = 'php_opcache.dll';
}
