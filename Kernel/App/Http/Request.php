<?php

namespace Kernel\App\Http;


use Kernel\App\Exception\ConfigException;
use Kernel\App\Util\Config;

class Request
{

    /**
     * 下载文件
     * @param $url
     * @param $newPath
     */
    public function download($url, $newPath)
    {
        if (false === $this->hasAllowUrlFopenExtend())
        {
            echo "The allow_url_fopen extension has been opened. Please restart your server\n";
        }

        // 获取响应头
        $headers = get_headers($url, 1);
        if (! $headers)
        {
            echo "Network failure\n";
        }

        // 打开两个文件
        $pf = fopen($url, 'r');
        // 下载的扩展存到临时目录，之后复制到扩展目录
        $file_name = basename($url);
        $newFile = fopen("{$newPath}/{$file_name}", 'w+');


        // 如果权限不足，直接退出程序
        if (! $newFile)
        {
            exit("{$newPath} 目录创建失败");
        }


        if (app('config')->getRunMode() === 'cli')
        {
            // 计算大小
            $size = $this->formatBytes($headers['Content-Length']);
            $down_size = 0;
            while (! feof($pf))
            {
                $data = fread($pf, 128);
                $down_size += fwrite($newFile, $data, 128);

                $count = $down_size/$headers['Content-Length']*50;

                $this->formatOutput($count, $this->formatBytes($down_size), $size);
            }

            echo "\n";
            if ($down_size == $headers['Content-Length'])
            {
                echo "download complete\n";
            }
            else
            {
                echo "download fail\n";
            }
        }
        else
        {
            while (! feof($pf))
            {
                $data = fread($pf, 100);
                fwrite($newFile, $data, 100);
            }
        }


        fclose($pf);
        fclose($newFile);

    }

    /**
     * 格式化下载的输出
     * @param $count
     * @param $downSize
     * @param $size
     */
    private function formatOutput($count, $downSize, $size)
    {
        echo sprintf("[%-50s] %s / %s", str_repeat('#', $count), $downSize, $size);
        echo "\r";
    }

    /**
     * 格式化单位
     * @param $size
     * @param string $delimiter
     * @return string
     */
    private function formatBytes($size, $delimiter = '')
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 6; $i++)
        {
            $size /= 1024;
        }

        return round($size, 2) . $delimiter . $units[$i];
    }


    /**
     * 是否再起了 allow_url_fopen 扩展
     * @return mixed
     */
    private function hasAllowUrlFopenExtend()
    {
        // 打开 allow_url_fopen 扩展
        try
        {
            // 打开扩展如果，返回false代表是已经打开了，否则则修改了 php.ini 文件，然后重启服务器
            return app('config')->openExtend('allow_url_fopen', 'On');
        }
        catch (ConfigException $e)
        {
            echo $e->getMessage();
        }
    }




}