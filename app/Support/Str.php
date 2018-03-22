<?php

namespace DavidNineRoc\EasyExtends\Support;


use DavidNineRoc\EasyExtends\Exception\StringException;

class Str
{
    protected $realString;
    protected $string;

    public function __construct($string)
    {
        if (! is_string($string)) {
            throw new StringException("Not is string");
        }

        $this->realString = $string;
        $this->string = $string;
    }


    /**
     * 默认过滤字符串的制表符
     *
     * @param string $search
     * @return $this
     */
    public function replaceSpace($search = "\t")
    {
        $this->string = str_replace($search, " ", $this->string);

        return $this;
    }

    /**
     * 过滤字符串两边的空白字符
     *
     * @return $this
     */
    public function trimSpace()
    {
        $this->string = trim($this->string);

        return $this;
    }



    /**
     * 获取真实传入的字符串
     *
     * @return string
     */
    public function getRealString()
    {
        return $this->realString;
    }

    /**
     * 返回操作后的字符串
     *
     * @return string
     */
    public function toString()
    {
        return $this->string;
    }

    public function __toString()
    {
        return $this->toString();
    }
}
