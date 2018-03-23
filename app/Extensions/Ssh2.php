<?php

namespace DavidNineRoc\EasyExtends\Extensions;

use DavidNineRoc\EasyExtends\Foundation\Expand;

class Ssh2 extends Expand
{
    protected $mapUrl = array(
        '7.1-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/1.1.2/php_ssh2-1.1.2-7.1-nts-vc14-x86.zip',
        '7.1-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/1.1.2/php_ssh2-1.1.2-7.1-ts-vc14-x86.zip',
        '7.1-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/ssh2/1.1.2/php_ssh2-1.1.2-7.1-nts-vc14-x64.zip',
        '7.1-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/ssh2/1.1.2/php_ssh2-1.1.2-7.1-ts-vc14-x64.zip',

        '7.0-nts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/1.1.2/php_ssh2-1.1.2-7.0-nts-vc14-x86.zip',
        '7.0-ts-vc14-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/1.1.2/php_ssh2-1.1.2-7.0-ts-vc14-x86.zip',
        '7.0-nts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/ssh2/1.1.2/php_ssh2-1.1.2-7.0-nts-vc14-x64.zip',
        '7.0-ts-vc14-x64' => 'http://windows.php.net/downloads/pecl/releases/ssh2/1.1.2/php_ssh2-1.1.2-7.0-ts-vc14-x64.zip',

        '5.5-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/0.12/php_ssh2-0.12-5.5-nts-vc11-x86.zip',
        '5.5-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/0.12/php_ssh2-0.12-5.5-ts-vc11-x86.zip',
        '5.5-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/ssh2/0.12/php_ssh2-0.12-5.5-nts-vc11-x64.zip',
        '5.5-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/ssh2/0.12/php_ssh2-0.12-5.5-ts-vc11-x64.zip',

        '5.4-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/0.12/php_ssh2-0.12-5.4-nts-vc9-x86.zip',
        '5.4-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/0.12/php_ssh2-0.12-5.4-ts-vc9-x86.zip',

        '5.3-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/0.12/php_ssh2-0.12-5.3-nts-vc9-x86.zip',
        '5.3-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/ssh2/0.12/php_ssh2-0.12-5.3-ts-vc9-x86.zip',
    );

    protected $dllName = 'php_ssh2.dll';
}
