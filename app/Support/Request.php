<?php

namespace DavidNineRoc\EasyExtends\Support;

use Dariuszp\CliProgressBar;
use DavidNineRoc\EasyExtends\Exception\DownloadExtensionException;
use Monolog\Logger;

class Request
{
    /**
     * @var Logger
     */
    protected $log;

    /**
     * @var CliProgressBar
     */
    protected $bar;

    protected $downing = false;

    protected $downloaded = false;

    public function __construct()
    {
        $this->bar = new CliProgressBar(100);
        $this->bar->display();
        $this->bar->setColorToRed();
    }

    public function download($url, $savePath)
    {
        $savePath = trim($savePath, '\\\/').'/'.basename($url);

        // 下载文件
        $stream = $this->requestUrl($url);
        /**
         * 有些扩展下载会导致重定向，在文件头会有一些
         * 稀奇古怪的东西，导致解压 zip 文件出错，所
         * 以，我们去除掉那些东西 zip 文件是以 pk 开
         * 头.
         */
        $stream = strstr($stream, 'PK');
        file_put_contents($savePath, $stream);

        /*
         * 下载结束的进度条显示
         */
        $this->downloaded = true;
        $this->bar->setColorToGreen();
        $this->bar->display();
        $this->bar->end();

        return $savePath;
    }

    /**
     * 请求 URL 下载.
     *
     * @param $url
     *
     * @return mixed
     *
     * @throws DownloadExtensionException
     */
    protected function requestUrl($url)
    {
        $ch = curl_init();

        // 从配置文件中获取根路径
        $headers = Config::get();
        $header = $headers[array_rand($headers)];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 模拟请求
        curl_setopt($ch, CURLOPT_USERAGENT, $header['CURLOPT_USERAGENT']);
        // 开启进度条
        curl_setopt($ch, CURLOPT_NOPROGRESS, 0);
        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, [$this, 'progress']);
        curl_setopt($ch, CURLE_ABORTED_BY_CALLBACK, [$this, 'progressAbort']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if (false === ($stream = curl_exec($ch))) {
            throw new DownloadExtensionException(curl_errno($ch));
        }

        curl_close($ch);

        return $stream;
    }

    protected function progressAbort()
    {
        dd(func_get_args());
    }

    /**
     * 进度条下载.
     *
     * @param $ch
     * @param $countDownloadSize
     * @param $currentDownloadSize
     * @param $countUploadSize
     * @param $currentUploadSize
     *
     * @return bool
     */
    protected function progress($ch, $countDownloadSize, $currentDownloadSize, $countUploadSize, $currentUploadSize)
    {
        //$this->log->info("{$countDownloadSize}：{$currentDownloadSize}");
        // 等于 0 的时候，应该是预读资源不等于 0的时候即开始下载
        if (0 === $countDownloadSize) {
            return false;
        }
        // 有时候会下载两次，第一次很小，应该是重定向下载
        if ($countDownloadSize > $currentDownloadSize) {
            $this->downloaded = false;
        // 继续显示进度条
        }
        // 已经下载完成还会再发三次请求
        elseif ($this->downloaded) {
            return false;
        }
        // 两边相等下载完成并不一定结束，
        elseif ($currentDownloadSize === $countDownloadSize) {
            return false;
        }

        // 开始计算
        $bar = $currentDownloadSize / $countDownloadSize * 100;
        $this->bar->progress($bar);
    }
}
