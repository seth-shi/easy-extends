<?php

namespace Kernel\App\Extensions;

use Kernel\App\Common\Extendtion;

class Mongo extends Extendtion
{
    protected $mapUrl = array(
        '5.6-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.16/php_mongo-1.6.16-5.6-nts-vc11-x86.zip',
        '5.6-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.16/php_mongo-1.6.16-5.6-ts-vc11-x86.zip',
        '5.6-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.16/php_mongo-1.6.16-5.6-nts-vc11-x64.zip',
        '5.6-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.16/php_mongo-1.6.16-5.6-ts-vc11-x64.zip',

        '5.5-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.14/php_mongo-1.6.14-5.5-nts-vc11-x86.zip',
        '5.5-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.14/php_mongo-1.6.14-5.5-ts-vc11-x86.zip',
        '5.5-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.14/php_mongo-1.6.14-5.5-nts-vc11-x64.zip',
        '5.5-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.14/php_mongo-1.6.14-5.5-ts-vc11-x64.zip',

        '5.4-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.14/php_mongo-1.6.14-5.4-nts-vc9-x86.zip',
        '5.4-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.14/php_mongo-1.6.14-5.4-ts-vc9-x86.zip',

        '5.3-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.14/php_mongo-1.6.14-5.3-nts-vc9-x86.zip',
        '5.3-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/mongo/1.6.14/php_mongo-1.6.14-5.3-ts-vc9-x86.zip',
    );

    protected $dllName = 'php_mongo.dll';
}
