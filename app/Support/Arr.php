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

    /**
     * 如果给定的值不是数组，则将其包装在一个数组中。
     *
     * @param  mixed  $value
     * @return array
     */
    public static function wrap($value)
    {
        return ! is_array($value) ? [$value] : $value;
    }
}
