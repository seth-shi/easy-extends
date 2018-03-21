<?php

namespace DavidNineRoc\EasyExtends\Utin;

use DavidNineRoc\EasyExtends\Contracts\Ini;

class ReadIni implements Ini
{
    protected $iniPath;

    public function __construct($iniPath)
    {
        $this->iniPath = $iniPath;
    }
}
