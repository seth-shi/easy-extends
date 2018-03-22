<?php

namespace DavidNineRoc\EasyExtends\Filesystem;


use DavidNineRoc\EasyExtends\Support\Str;

class IniWrite extends IniOperate
{
    protected $iniContents = '';

    public function render()
    {
        $this->compileCommentsAndValues();
    }

    public function compileCommentsAndValues()
    {
        /************************************
         * initComments 的内容格式总是这样的
         * ['__']            是开始的部分
         * ['PHP']           是section 的部分
         * ['PHP$extension'] 是 key=value 的部分
         */
        foreach ($this->iniComments as $key => $comment) {
            if ($key === '__') {
                $this->iniComments .= $comment."\n";
            }

            // 没有的话则是 section 块
            if (false === strpos(self::DELIMITER, $key)) {
                /************************************
                 * section 块直接两边加中括号存起来
                 */
                if ($this->hasSection($key)) {
                    $section = "[{$key}]";

                    $this->iniContents .= $section."\n";
                }
            } else {
                /************************************
                 * 通过 comment 的分隔 key 得到
                 * section 和 value的key 的名字
                 */
                list($section, $key) = explode(self::DELIMITER, $comment);
                if ($this->hasValues($section, $key)) {
                    /************************************
                     * values 有可能是数组，因为 php.ini 中
                     * extension=pdo_mysql.dll
                     * extension=memcache.dll
                     */
                    if (is_array($this->iniValues[$section][$key])) {
                        foreach ($this->iniValues[$section][$key] as $line) {
                            $this->iniContents .= "{$key}={$line}\n";
                        }

                    } else {
                        $this->iniContents .= "{$key}={$this->iniValues[$section][$key]}\n";
                    }
                }
            }

        }

        var_dump($this->iniContents);
    }
}