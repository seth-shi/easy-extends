<?php

namespace DavidNineRoc\EasyExtends\Filesystem;


use DavidNineRoc\EasyExtends\Exception\ReadIniException;
use DavidNineRoc\EasyExtends\Support\Arr;

class IniOperate
{
    const DELIMITER = '$';
    /**
     * ini 文件的路径
     * @var string
     */
    protected $iniFile;



    /**
     * 存储注释
     * @var array
     */
    protected $iniComments = [];

    /**
     * 存储 value 模块
     * @var array
     */
    protected $iniValues = [];

    public function __construct($iniFile)
    {
        $this->iniFile = $iniFile;
    }

    /**
     * 获取 section 的名字
     *
     * @param $string
     * @return string
     * @throws ReadIniException
     */
    protected function getSectionName($string)
    {
        if (
            0 === preg_match('/\[([\s\S]+)\]/', $string, $matches) ||
            ! isset($matches[1]))
        {
            throw new ReadIniException("No [{$string}] section");
        }

        return $matches[1];
    }

    /**
     * 是否是模块的 section
     *
     * @param $string
     * @return bool
     */
    protected function isSection($string)
    {
        return ($string{0} == '[');
    }

    /**
     * 在 ini 的 values 中是否有 key 的 section 块
     *
     * @param $key
     * @return bool
     */
    protected function hasSection($key)
    {
        return array_key_exists($key, $this->iniValues);
    }

    /**
     * 在 values 块中寻找
     *
     * @param $section
     * @param $key
     * @return bool
     */
    protected function hasValues($section, $key)
    {
        return isset($this->iniValues[$section][$key]);
    }

    /**
     * 是否是注释
     *
     * @param $string
     * @return bool
     */
    protected function isComment($string)
    {
        return 0 === preg_match('/^[a-zA-Z0-9[]/', $string);
    }

    /**
     * 设置 section
     *
     * @param $sectionName
     * @param string $value
     */
    protected function setSection($sectionName, $value = '')
    {
        $this->iniValues[$sectionName] = [];
    }

    /**
     * 为 section 设置模块
     *
     * @param $section
     * @param $key
     * @param $value
     * @return ReadIniException
     */
    protected function setValue($section, $key, $value)
    {
        if (! array_key_exists($section, $this->iniValues)) {
            return new ReadIniException("Not [{$section}] section");
        }

        /****************************************
         * 模块下的块名有可能重复，比如 php.ini 下的
         * extension=redis.dll
         * extension=pdo_mysql.dll
         * extension=memcache.dll
         */
        if (isset($this->iniValues[$section][$key])) {
            /****************************************
             * 第一次重复是字符串，之后的重复是数组，统一
             * 转换成数组来进行处理。
             * 当成为数组之后，把重复 key 值的插入数组中
             */
            $this->iniValues[$section][$key] = Arr::wrap($this->iniValues[$section][$key]);
            $this->iniValues[$section][$key][] = $value;

        } else {
            $this->iniValues[$section][$key] = $value;
        }
    }


    /**
     * 存储注释的内容
     *
     * @param $section
     * @param $comment
     * @param null $key
     */
    protected function setComment($section, $comment, $key = null)
    {
        if (! is_null($key)) {
            $section = $section. self::DELIMITER .$key;
        }

        // 不论是否有一行或者多行的内容，总是存成数组的形式
        $this->iniComments[$section][] = $comment;
    }

    public function toString()
    {
        return [
            'comment' => $this->iniComments,
            'values' => $this->iniValues,
        ];
    }
}