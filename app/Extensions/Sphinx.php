<?php

namespace DavidNineRoc\EasyExtends\Extensions;

use DavidNineRoc\EasyExtends\Foundation\Expand;

class Sphinx extends Expand
{
    protected $mapUrl = array(
        '5.6-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.6-nts-vc11-x86.zip',
        '5.6-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.6-ts-vc11-x86.zip',
        '5.6-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.6-nts-vc11-x64.zip',
        '5.6-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.6-ts-vc11-x64.zip',

        '5.5-nts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.5-nts-vc11-x86.zip',
        '5.5-ts-vc11-x86' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.5-ts-vc11-x86.zip',
        '5.5-nts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.5-nts-vc11-x64.zip',
        '5.5-ts-vc11-x64' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.5-ts-vc11-x64.zip',

        '5.4-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.4-nts-vc9-x86.zip',
        '5.4-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.4-ts-vc9-x86.zip',

        '5.3-nts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.3-nts-vc9-x86.zip',
        '5.3-ts-vc9-x86' => 'http://windows.php.net/downloads/pecl/releases/sphinx/1.3.3/php_sphinx-1.3.3-5.3-ts-vc9-x86.zip',
    );

    protected $dllName = 'php_sphinx.dll';
}
