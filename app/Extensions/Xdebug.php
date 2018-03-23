<?php

namespace DavidNineRoc\EasyExtends\Extensions;

use DavidNineRoc\EasyExtends\Foundation\Expand;

class Xdebug extends Expand
{
    protected $mapUrl = array(
        '7.1-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-7.1-nts-vc14-x86.zip',
        '7.1-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-7.1-ts-vc14-x86.zip',
        '7.1-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-7.1-nts-vc14-x64.zip',
        '7.1-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-7.1-ts-vc14-x64.zip',

        '7.0-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-7.0-nts-vc14-x86.zip',
        '7.0-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-7.0-ts-vc14-x86.zip',
        '7.0-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-7.0-nts-vc14-x64.zip',
        '7.0-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-7.0-ts-vc14-x64.zip',

        '5.6-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-5.6-nts-vc11-x86.zip',
        '5.6-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-5.6-ts-vc11-x86.zip',
        '5.6-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-5.6-nts-vc11-x64.zip',
        '5.6-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-5.6-ts-vc11-x64.zip',

        '5.5-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-5.6-nts-vc11-x86.zip',
        '5.5-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-5.5-ts-vc11-x86.zip',
        '5.5-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-5.5-nts-vc11-x64.zip',
        '5.5-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.5.5/php_xdebug-2.5.5-5.5-ts-vc11-x64.zip',

        '5.4-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.4.1/php_xdebug-2.4.1-5.4-nts-vc9-x86.zip',
        '5.4-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.4.1/php_xdebug-2.4.1-5.4-ts-vc9-x86.zip',

        '5.3-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.2.7/php_xdebug-2.2.7-5.3-nts-vc9-x86.zip',
        '5.3-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/xdebug/2.2.7/php_xdebug-2.2.7-5.3-ts-vc9-x86.zip',
    );

    protected $dllName = 'php_xdebug.dll';

    public function openExtend()
    {
        // dll path
        $extPath = app('config')->getExtPath();

        $tmpPath = dirname($extPath);
        $dllPath = $extPath.'/'.$this->dllName;

        $config = <<<config
[XDebug]
xdebug.profiler_output_dir="{$tmpPath}"
xdebug.trace_output_dir="{$tmpPath}"
xdebug.remote_port=9001
xdebug.idekey="PHPSTORM"
zend_extension={$dllPath}
config;

        $phpIni = app('config')->getphpIniPath();

        if (file_put_contents($phpIni, $config, FILE_APPEND)) {
            echo 'open complete';
        } else {
            echo 'open fails';
        }
    }
}
