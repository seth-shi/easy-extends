<?php
/**
 * 引用 Piwik - free/libre analytics platform 的包
 *
 * 读的时候，自动转换成bool值，不符合实际情况，稍加修改,读取的时候有多个 extends 多个键值会被覆盖
 */

namespace Kernel\App;
use Kernel\App\Exception\ConfigException;


/**
 * Reads INI configuration.
 */
class IniReader
{
    /**
     * @var bool
     */
    private $useNativeFunction;

    public function __construct()
    {
        $this->useNativeFunction = function_exists('parse_ini_string');
    }

    /**
     * Reads a INI configuration file and returns it as an array.
     *
     * The array returned is multidimensional, indexed by section names:
     *
     * ```
     * array(
     *     'Section 1' => array(
     *         'value1' => 'hello',
     *         'value2' => 'world',
     *     ),
     *     'Section 2' => array(
     *         'value3' => 'foo',
     *     )
     * );
     * ```
     *
     * @param string $filename The file to read.
     * @throws ConfigException
     * @return array
     */
    public function readFile($filename)
    {
        $ini = $this->getContentOfIniFile($filename);

        return $this->readString($ini);
    }

    /**
     * Reads a INI configuration string and returns it as an array.
     *
     * The array returned is multidimensional, indexed by section names:
     *
     * ```
     * array(
     *     'Section 1' => array(
     *         'value1' => 'hello',
     *         'value2' => 'world',
     *     ),
     *     'Section 2' => array(
     *         'value3' => 'foo',
     *     )
     * );
     * ```
     *
     * @param string $ini String containing INI configuration.
     * @throws ConfigException
     * @return array
     */
    public function readString($ini)
    {
        // On PHP 5.3.3 an empty line return is needed at the end
        // See http://3v4l.org/jD1Lh
        $ini .= "\n";


        // 不能用默认的 parse_ini_file 文件解析，因为配置文件中有多个 extend
        $array = $this->readWithAlternativeImplementation($ini);


        return $array;
    }

    private function getContentOfIniFile($filename)
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new ConfigException(sprintf("The file %s doesn't exist or is not readable", $filename));
        }

        $content = $this->getFileContent($filename);

        if ($content === false) {
            throw new ConfigException(sprintf('Impossible to read the file %s', $filename));
        }

        return $content;
    }

    /**
     * Reads ini comments for each key.
     *
     * The array returned is multidimensional, indexed by section names:
     *
     * ```
     * array(
     *     'Section 1' => array(
     *         'key1' => 'comment 1',
     *         'key2' => 'comment 2',
     *     ),
     *     'Section 2' => array(
     *         'key3' => 'comment 3',
     *     )
     * );
     * ```
     *
     * @param string $filename The path to a file.
     * @throws ConfigException
     * @return array
     */
    public function readComments($filename)
    {
        $ini = $this->getContentOfIniFile($filename);
        $ini = $this->splitIniContentIntoLines($ini);

        $descriptions = array();

        $section     = '';
        $lastComment = '';

        foreach ($ini as $line) {
            $line = trim($line);

            if (strpos($line, '[') === 0) {
                $tmp     = explode(']', $line);
                $section = trim(substr($tmp[0], 1));

                $descriptions[$section] = array();
                $lastComment            = '';
                continue;
            }


            if (!preg_match('/^[a-zA-Z0-9[]/', $line)) {
                if (strpos($line, ';') === 0) {
                    $line = trim(substr($line, 1));
                }
                // comment
                $lastComment .= $line . "\n";
                continue;
            }

            list($key, $value) = explode('=', $line, 2);

            $key = trim($key);
            if (strpos($key, '[]') === strlen($key) - 2) {
                $key = substr($key, 0, -2);
            }

            if (empty($descriptions[$section][$key])) {
                $descriptions[$section][$key] = $lastComment;
            }

            $lastComment = '';
        }

        return $descriptions;
    }

    private function splitIniContentIntoLines($ini)
    {
        if (is_string($ini)) {
            $ini = explode("\n", str_replace("\r", "\n", $ini));
        }

        return $ini;
    }

    /**
     * Reimplementation in case `parse_ini_file()` is disabled.
     *
     * @author Andrew Sohn <asohn (at) aircanopy (dot) net>
     * @author anthon (dot) pang (at) gmail (dot) com
     *
     * @param string $ini
     * @return array
     */
    private function readWithAlternativeImplementation($ini)
    {
        $ini = $this->splitIniContentIntoLines($ini);


        if (count($ini) == 0) {
            return array();
        }

        $sections = array();
        $values   = array();
        $result   = array();
        $globals  = array();
        $i        = 0;

        $ss = 1;
        foreach ($ini as $line) {
            $line = trim($line);
            $line = str_replace("\t", " ", $line);


            // Comments
            if (!preg_match('/^[a-zA-Z0-9[]/', $line)) {
                continue;
            }


            // Sections 模块
            if ($line{0} == '[') {
                $tmp        = explode(']', $line);
                $sections[] = trim(substr($tmp[0], 1));
                $i++;
                continue;
            }

            // Key-value pair
            list($key, $value) = explode('=', $line, 2);

            $key   = trim($key);
            $value = trim($value);



            if (strstr($value, ";")) {
                $tmp = explode(';', $value);
                if (count($tmp) == 2) {
                    if ((($value{0} != '"') && ($value{0} != "'")) || preg_match('/^".*"\s*;/', $value) || preg_match('/^".*;[^"]*$/', $value) || preg_match("/^'.*'\s*;/", $value) || preg_match("/^'.*;[^']*$/", $value)) {
                        $value = $tmp[0];
                    }
                } else {
                    if ($value{0} == '"') {
                        $value = preg_replace('/^"(.*)".*/', '$1', $value);
                    } elseif ($value{0} == "'") {
                        $value = preg_replace("/^'(.*)'.*/", '$1', $value);
                    } else {
                        $value = $tmp[0];
                    }
                }
            }

            $value = trim($value);


            // Special keywords
            /*  不需要特殊的标记
            if ($value === 'true' || $value === 'yes' || $value === 'on') {
            $value = yes;
            } elseif ($value === 'false' || $value === 'no' || $value === 'off') {
            $value = false;
            } elseif ($value === '' || $value === 'null') {
            $value = null;
            }
            */

            if (is_string($value)) {
                $value = trim($value, "'\"");
            }


            if ($i == 0) {
                if (substr($key, -2) == '[]') {
                    $globals[substr($key, 0, -2)][] = $value;
                } else {
                    $globals[$key] = $value;
                }
            } else {
                if (substr($key, -2) == '[]') {
                    $values[$i - 1][substr($key, 0, -2)][] = $value;
                } else {

                    // ！！！当有重复的 key 时，在后面加#直至没有重复
                    $flag_count = 0;
                    $tmp_key    = $key;
                    do {
                        if (!isset($values[$i - 1])) {
                            $values[$i - 1] = array();
                        }


                        if (array_key_exists($tmp_key, $values[$i - 1])) {
                            // 每次进来加一个 #
                            ++$flag_count;
                            $tmp_key = $key . str_repeat('#', $flag_count);
                        } else {
                            // 出去的时候，如果 flag_count 不是0 要重新赋值带有 # 的key 给它
                            if ($flag_count != 0) {
                                $key = $tmp_key;
                            }

                            // 如果没有重复就直接退出
                            $flag_count = false;
                        }

                    } while ($flag_count);

                }
            }


            $values[$i - 1][$key] = $value;
        }


        // 把索引数组转换成关联数组
        for ($j = 0; $j < $i; $j++) {

            if (isset($values[$j])) {
                $result[$sections[$j]] = $values[$j];
            } else {
                $result[$sections[$j]] = array();
            }
        }

        $finalResult = $result + $globals;

        return $finalResult;
    }

    /**
     * @param string $filename
     * @return bool|string Returns false if failure.
     */
    private function getFileContent($filename)
    {
        if (function_exists('file_get_contents')) {
            return file_get_contents($filename);
        } elseif (function_exists('file')) {
            $ini = file($filename);
            if ($ini !== false) {
                return implode("\n", $ini);
            }
        } elseif (function_exists('fopen') && function_exists('fread')) {
            $handle = fopen($filename, 'r');
            if (!$handle) {
                return false;
            }
            $ini = fread($handle, filesize($filename));
            fclose($handle);
            return $ini;
        }

        return false;
    }




}
