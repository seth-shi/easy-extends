<?php

namespace Kernel\App\Extensions;


use Kernel\App\Common\Extendtion;

class Memcache extends Extendtion
{
    protected $mapUrl = array(
        '5.6-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.6-nts-vc11-x86.zip',
        '5.6-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.6-ts-vc11-x86.zip',
        '5.6-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.6-nts-vc11-x64.zip',
        '5.6-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/redis/2.2.7/php_redis-2.2.7-5.6-ts-vc11-x64.zip',
        '5.5-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.5-nts-vc11-x86.zip',
        '5.5-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.5-ts-vc11-x86.zip',
        '5.5-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.5-nts-vc11-x64.zip',
        '5.5-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.5-ts-vc11-x64.zip',

        '5.4-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.4-nts-vc9-x86.zip',
        '5.4-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.4-ts-vc9-x86.zip',

        '5.3-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.3-nts-vc9-x86.zip',
        '5.3-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/memcache/3.0.8/php_memcache-3.0.8-5.3-ts-vc9-x86.zip'
    );

    protected $dllName = 'php_memcache.dll';



}