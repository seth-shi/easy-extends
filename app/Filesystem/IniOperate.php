<?php

namespace DavidNineRoc\EasyExtends\Filesystem;


use DavidNineRoc\EasyExtends\Exception\ReadIniException;

class IniOperate
{
    /**
     * ini 文件的路径
     * @var string
     */
    protected $iniFile;

    /**
     * 存储 section 模块
     * @var array
     */
    protected $iniSections = [];

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
            0 === preg_match('/\[(\S+)\]/', $string, $matches) ||
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
        $this->iniSections[$sectionName] = $value;
        $this->iniValues[$sectionName] = [];
    }

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
         * 如果存在，把原来的值和 value 形成数组重新
         * 插入
         */
        if (isset($this->iniValues[$section][$key])) {
            $this->iniValues[$section][$key] = [
                $this->iniValues[$section][$key],
                $value
            ];
        }

        $this->iniValues[$section][$key] = $value;
    }
}