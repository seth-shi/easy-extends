<?php

namespace DavidNineRoc\EasyExtends\Foundation;

use DavidNineRoc\EasyExtends\Application;
use DavidNineRoc\EasyExtends\Contracts\Expand as ExpandContract;
use DavidNineRoc\EasyExtends\Exception\DownloadExtensionException;
use DavidNineRoc\EasyExtends\Exception\NotExtensionDirException;
use DavidNineRoc\EasyExtends\Support\Request;
use DavidNineRoc\IniParseRender\Exception\FileNotFoundException;
use DavidNineRoc\IniParseRender\IniManager;
use VIPSoft\Unzip\Unzip;


class Expand implements ExpandContract
{
    protected $mapUrl = [];
    protected $dllName = '';
    /**
     * @var Application
     */
    protected $app;
    // 缓存的路径
    protected $cachePath;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->cachePath = $this->app->getBasePath()."/bootstrap/cache";
    }

    public function installExtend($env)
    {
        if (! $this->hasExtend($env)) {
            throw new NotExtensionDirException('There is no environment-compliant version');
        }

        $zip = $this->downloadExtend($env);

        // 解压 zip 文件
        $dll = $this->unZipFile($zip);

        // 把 dll 文件复制到扩展目录下
        $this->copyDllToExtPath();

        // 开启扩展
        $this->openExtend();
    }

    /**
     * 是否有合适的扩展
     * @param $env
     * @return bool
     */
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

        return (new Request())->download($url, $this->cachePath);
    }

    /**
     * 解压 zip 文件
     * @param $zipFile
     * @internal param $zip
     */
    protected function unZipFile($zipFile)
    {
        $zipper = new Unzip();
        $zipper->extract($zipFile, $this->cachePath);
    }

    /**
     * 复制 dll 文件到 php 的扩展目录下
     * @throws DownloadExtensionException
     * @throws FileNotFoundException
     */
    protected function copyDllToExtPath()
    {
        $dllName = $this->cachePath.'/'.$this->dllName;
        if (! file_exists($dllName)) {
            throw new DownloadExtensionException('Zip file not extension dll');
        }

        $dstPath = $this->app->getExtPath().'/'.$this->dllName;

        if (! copy($dllName, $dstPath)) {
            throw new FileNotFoundException("[{$dstPath}] path not write permission");
        }
    }

    /**
     * 开启扩展
     */
    protected function openExtend()
    {
        /**
         * @var IniManager
         */
        $ini = $this->app->make(IniManager::class);
        $ini->set('PHP', 'extension', $this->dllName);
        $ini->write();
        print "[$this->dllName] extension open success!!!";
    }

}
