<?php

namespace Kernel\App\Extensions;

use Kernel\App\Common\Extendtion;

class Solr extends Extendtion
{
    protected $mapUrl = array(
        '7.1-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-7.1-nts-vc14-x86.zip',
        '7.1-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-7.1-ts-vc14-x86.zip',
        '7.1-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-7.1-nts-vc14-x64.zip',
        '7.1-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-7.1-ts-vc14-x64.zip',

        '7.0-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-7.0-nts-vc14-x86.zip',
        '7.0-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-7.0-ts-vc14-x86.zip',
        '7.0-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-7.0-nts-vc14-x64.zip',
        '7.0-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-7.0-ts-vc14-x64.zip',

        '5.6-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.6-nts-vc11-x86.zip',
        '5.6-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.6-ts-vc11-x86.zip',
        '5.6-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.6-nts-vc11-x64.zip',
        '5.6-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.6-ts-vc11-x64.zip',

        '5.5-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.5-nts-vc11-x86.zip',
        '5.5-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.5-ts-vc11-x86.zip',
        '5.5-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.5-nts-vc11-x64.zip',
        '5.5-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.5-ts-vc11-x64.zip',

        '5.4-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.4-nts-vc9-x86.zip',
        '5.4-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.4-ts-vc9-x86.zip',

        '5.3-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.3-nts-vc9-x86.zip',
        '5.3-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/solr/2.4.0/php_solr-2.4.0-5.3-ts-vc9-x86.zip',
    );

    protected $dllName = 'php_solr.dll';
}
