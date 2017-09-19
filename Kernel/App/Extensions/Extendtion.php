<?php

namespace Kernel\App\Extensions;


use Kernel\App\Http\Request;

class Extendtion
{
    protected $mapUrl = array();

    // 扩展的 key
    protected $extendKey;
    // 下载的文件名
    protected $fileName;
    // 下载到那个路径
    protected $cachePath = '';
    // dll 文件名
    protected $dllName = '';

    /**
     * 是否有这个扩展，适配本机配置的
     * @param $key
     * @return bool
     */
    public function hasExtend($key)
    {
        $this->extendKey = strtolower($key);

        return array_key_exists($this->extendKey, $this->mapUrl);
    }

    public function downloadExtend($key = null)
    {
        if (! is_null($key))
        {
            $this->extendKey = strtolower($key);
        }

        // 判断是否开启了 allow_url_open
        $url = $this->mapUrl[$this->extendKey];

        // 初始化
        $this->fileName = basename($url);
        $this->cachePath = app()->getBasePath() . '/cache/extends/';

        if (! is_dir($this->cachePath))
        {
            mkdir($this->cachePath);
        }

        // 下载文件
        (new Request())->download($url, $this->cachePath);
    }

    public function installExtend()
    {
        // zip 文件目录
        $zip_file = $this->cachePath . $this->fileName;
        // 先拼接出压缩文件的名字
        $this->unzip($zip_file, $this->cachePath);

        // 如果没有什么问题的话， 会有一个 php_extend.dll
        $extPath = app('config')->getExtPath();

        // 放到 php 扩展目录
        $new_path = $extPath . '/' . $this->dllName;

        // 如果已经加载了扩展，会复制失败。
        if (copy($this->cachePath . $this->dllName, $new_path))
        {
            echo 'installl complete';
        }
        else
        {
            echo 'install fail: extend already running';
        }

        // 删除文件
        $this->deldir($this->cachePath);

        // 打开扩展extension=php_bz2.dll
        app('config')->openExtend('extension', $this->dllName);
    }


    public function unzip($src_file, $dest_dir=false, $create_zip_name_dir=true, $overwrite=true){

        if ($zip = zip_open($src_file)){
            if ($zip){
                $splitter = ($create_zip_name_dir === true) ? "." : "/";
                if($dest_dir === false){
                    $dest_dir = substr($src_file, 0, strrpos($src_file, $splitter))."/";
                }

                // 如果不存在 创建目标解压目录
                $this->createDirs($dest_dir);

                // 对每个文件进行解压
                while ($zip_entry = zip_read($zip)){
                    // 文件不在根目录
                    $pos_last_slash = strrpos(zip_entry_name($zip_entry), "/");
                    if ($pos_last_slash !== false){
                        // 创建目录 在末尾带 /
                        $this->createDirs($dest_dir.substr(zip_entry_name($zip_entry), 0, $pos_last_slash+1));
                    }

                    // 打开包
                    if (zip_entry_open($zip,$zip_entry,"r")){

                        // 文件名保存在磁盘上
                        $file_name = $dest_dir.zip_entry_name($zip_entry);

                        // 检查文件是否需要重写
                        if ($overwrite === true || $overwrite === false && !is_file($file_name)){
                            // 读取压缩文件的内容
                            $fstream = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

                            @file_put_contents($file_name, $fstream);
                            // 设置权限
                            chmod($file_name, 0777);
                        }

                        // 关闭入口
                        zip_entry_close($zip_entry);
                    }
                }
                // 关闭压缩包
                zip_close($zip);
            }
        }else{
            return false;
        }
        return true;
    }

    public function deldir($dir) {
        //先删除目录下的文件：
        $dh=opendir($dir);
        while ($file=readdir($dh)) {
            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    deldir($fullpath);
                }
            }
        }

        closedir($dh);
        //删除当前文件夹：
        if(rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }

    public function createDirs($path){
        if (!is_dir($path)){
            $directory_path = "";
            $directories = explode("/",$path);
            array_pop($directories);

            foreach($directories as $directory){
                $directory_path .= $directory."/";
                if (!is_dir($directory_path)){
                    mkdir($directory_path);
                    chmod($directory_path, 0777);
                }
            }
        }
    }

    // 取出多余的斜杆
    private function normalize($service)
    {
        return is_string($service) ? ltrim($service, '\\/') : $service;
    }

}