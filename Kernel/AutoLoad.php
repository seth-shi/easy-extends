<?php


class AutoLoad
{
    public static function loaded($class)
    {
        // 目录
        $path = dirname($class);
        // 文件名
        $file = basename($class);

        // 文件名全部转小写
        $path = self::normalize($path);

        $file = "{$path}/{$file}.php";

        if (is_file($file))
        {
            require $file;
        }
    }

    protected static function normalize($string)
    {
        // 转小写 去掉分隔符
        $string = strtolower($string);
        // 全部转换成 /
        $string = trim($string, '\\');
        $string = str_replace('\\', '/', $string);

        return $string;
    }
}