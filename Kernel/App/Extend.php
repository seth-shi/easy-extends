<?php

namespace Kernel\App;


class Extend
{
    protected $mapUrl = [
        '5.3' => [],
        '5.4' => [],
        '5.5' => [],
        '5.6' => [],
        '7.0' => [],
        '7.1' => [],
    ];
    protected $extendType;



    public function hasExtend()
    {
        // $file = "dll/{$extend_name}/{$info['php_ver']}-{$info['nts']}-{$info['vc']}-{$info['win']}.dll";
       if (in_array($extend, $this->extends));
    }
    public function downloadExtend()
    {

    }

}