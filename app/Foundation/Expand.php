<?php

namespace DavidNineRoc\EasyExtends\Foundation;

use DavidNineRoc\EasyExtends\Application;
use DavidNineRoc\EasyExtends\Contracts\Expand as ExpandContract;
use DavidNineRoc\EasyExtends\Exception\DownloadExtensionException;
use DavidNineRoc\EasyExtends\Exception\NotExtensionDirException;
use Wenpeng\Curl\Curl;

class Expand implements ExpandContract
{
    protected $mapUrl = [];
    /**
     * @var Application
     */
    protected $app;
    // 缓存的路径
    protected $cachePath;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->cachePath = $this->app->getBasePath().'/bootstrap/cache';
    }

    public function installExtend($env)
    {
        if (! $this->hasExtend($env)) {
            // throw new NotExtensionDirException('There is no environment-compliant version');
        }

        $zip = $this->downloadExtend($env);


    }

    protected function hasExtend($env)
    {
        return array_key_exists($env, $this->mapUrl);
    }

    /**
     * 根据环境变量下载压缩文件夹
     * @param $env
     * @return string
     * @throws DownloadExtensionException
     */
    protected function downloadExtend($env)
    {
        $url = $this->mapUrl[$env];
        $extendPath = $this->cachePath.'/'.basename($url);
        dd($url);

        $curl = new Curl();
        $curl->url($url)->save($extendPath);

        if ($curl->error()) {
            throw new DownloadExtensionException($curl->message());
        }

        return $extendPath;
    }

}
