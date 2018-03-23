<?php

namespace DavidNineRoc\EasyExtends\Extensions;

use DavidNineRoc\EasyExtends\Foundation\Expand;
class Sqlsrv extends Expand
{
    protected $mapUrl = array(
        '7.1-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/sqlsrv/5.0.0preview/php_sqlsrv-5.0.0preview-7.1-nts-vc14-x86.zip',
        '7.1-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/sqlsrv/5.0.0preview/php_sqlsrv-5.0.0preview-7.1-ts-vc14-x86.zip',
        '7.1-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/sqlsrv/5.0.0preview/php_sqlsrv-5.0.0preview-7.1-nts-vc14-x64.zip',
        '7.1-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/sqlsrv/5.0.0preview/php_sqlsrv-5.0.0preview-7.1-ts-vc14-x64.zip',

        '7.0-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/sqlsrv/5.0.0preview/php_sqlsrv-5.0.0preview-7.0-nts-vc14-x86.zip',
        '7.0-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/sqlsrv/5.0.0preview/php_sqlsrv-5.0.0preview-7.0-ts-vc14-x86.zip',
        '7.0-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/sqlsrv/5.0.0preview/php_sqlsrv-5.0.0preview-7.0-nts-vc14-x64.zip',
        '7.0-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/sqlsrv/5.0.0preview/php_sqlsrv-5.0.0preview-7.0-ts-vc14-x64.zip',
    );

    protected $dllName = 'php_sqlsrv.dll';
}
