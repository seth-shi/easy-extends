<?php

namespace Kernel\App\Extensions;


use Kernel\App\Common\Extendtion;

class Mongodb extends Extendtion
{
    protected $mapUrl = array(
        '7.1-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-7.1-nts-vc14-x86.zip',
        '7.1-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-7.1-ts-vc14-x86.zip',
        '7.1-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-7.1-nts-vc14-x64.zip',
        '7.1-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-7.1-ts-vc14-x64.zip',

        '7.0-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-7.0-nts-vc14-x86.zip',
        '7.0-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-7.0-ts-vc14-x86.zip',
        '7.0-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-7.0-nts-vc14-x64.zip',
        '7.0-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-7.0-ts-vc14-x64.zip',

        '5.6-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-5.6-nts-vc11-x86.zip',
        '5.6-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-5.6-ts-vc11-x86.zip',
        '5.6-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-5.6-nts-vc11-x64.zip',
        '5.6-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0RC1/php_mongodb-1.3.0rc1-5.6-ts-vc11-x64.zip',

        '5.5-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0beta1/php_mongodb-1.3.0beta1-5.5-nts-vc11-x86.zip',
        '5.5-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0beta1/php_mongodb-1.3.0beta1-5.5-ts-vc11-x86.zip',
        '5.5-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0beta1/php_mongodb-1.3.0beta1-5.5-nts-vc11-x64.zip',
        '5.5-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/mongodb/1.3.0beta1/php_mongodb-1.3.0beta1-5.5-ts-vc11-x64.zip',
    );

    protected $dllName = 'php_mongodb.dll';



}