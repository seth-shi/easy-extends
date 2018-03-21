<?php

namespace DavidNineRoc\EasyExtends\Utin;

use DavidNineRoc\EasyExtends\Contracts\Ini;

class WriteIni implements Ini
{
    protected $iniPath;

    public function __construct($iniPath)
    {
        $this->iniPath = $iniPath;
    }
}
