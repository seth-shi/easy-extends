<?php

namespace DavidNineRoc\EasyExtends\Support;


use DavidNineRoc\EasyExtends\Exception\StringException;

class Arr
{
    protected $realArray;
    protected $array;

    public function __construct($array)
    {
        if (! is_array($array)) {
            throw new StringException("Not is array");
        }

        $this->realArray = $array;
        $this->array = $array;
    }
}
