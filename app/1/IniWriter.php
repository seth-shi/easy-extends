<?php

/**
 * 引用 Piwik - free/libre analytics platform 的包.
 *
 * 读的时候，自动转换成bool值，不符合实际情况，稍加修改,读取的时候有多个 extends 多个键值会被覆盖
 */

namespace Kernel\App;

use Kernel\App\Exception\ConfigException;

/**
 * Writes INI configuration.
 */
class IniWriter
{
    /**
     * Writes an array configuration to a INI file.
     *
     * The array provided must be multidimensional, indexed by section names:
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
     * @param string $filename
     * @param array  $config
     * @param string $header   optional header to insert at the top of the file
     *
     * @throws ConfigException
     */
    public function writeToFile($filename, array $config, $header = '')
    {
        $ini = $this->writeToString($config, $header);

        if (!file_put_contents($filename, $ini)) {
            throw new ConfigException(sprintf('Impossible to write to file %s', $filename));
        }
    }

    /**
     * Writes an array configuration to a INI string and returns it.
     *
     * The array provided must be multidimensional, indexed by section names:
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
     * @param array  $config
     * @param string $header optional header to insert at the top of the file
     *
     * @return string
     *
     * @throws ConfigException
     */
    public function writeToString(array $config, $header = '')
    {
        $ini = $header;

        $sectionNames = array_keys($config);

        foreach ($sectionNames as $sectionName) {
            $section = $config[$sectionName];

            // no point in writing empty sections
            if (empty($section)) {
                continue;
            }

            if (!is_array($section)) {
                throw new ConfigException(sprintf("Section \"%s\" doesn't contain an array of values", $sectionName));
            }

            $ini .= "[$sectionName]\n";

            // 这里是
            foreach ($section as $option => $value) {
                if (is_numeric($option)) {
                    $option = $sectionName;
                    $value = array(
                        $value,
                    );
                }

                if (is_array($value)) {
                    foreach ($value as $currentValue) {
                        $ini .= $option.'[] = '.$this->encodeValue($currentValue)."\n";
                    }
                } else {
                    // 这里修改一下， extends 多个的时候，在读取的时候加了 #
                    $option = rtrim($option, '#');

                    $ini .= $option.' = '.$this->encodeValue($value)."\n";
                }
            }

            $ini .= "\n";
        }

        return $ini;
    }

    private function encodeValue($value)
    {
        if (is_bool($value)) {
            return (int) $value;
        }
        if (is_string($value)) {
            return "\"$value\"";
        }

        return $value;
    }
}
