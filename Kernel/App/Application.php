<?php

namespace Kernel\App;

use Kernel\App\Exception\ApplicationException;

class Application extends Base
{
    // PHP 版本
    private $phpVersion;
    // NTS 版本
    private $ntsVersion;
    // VC  版本
    private $vcVersion;
    // win 版本
    private $winVersion;
    // 扩展目录
    private $extDir;
    // php.ini 的文件路径
    private $iniPath;
    
    
    public function __construct()
    {
        // 注册常用配置
        $this->initBaseInfo();


    }


    public function initBaseInfo()
    {
        $config = $this->getPHPInfoArray();
        
        // Architecture == X86
        if (! array_key_exists('Architecture', $config))
        {
            throw new ApplicationException('phpinfo 中的 Architecture 信息异常');
        }

        // PHP Extension Build
        if (! array_key_exists('PHP Extension Build', $config))
        {
            throw new ApplicationException('phpinfo 中的 PHP Extension Build 信息异常');
        }

        // 注册进属性
        $this->winVersion = $config['Architecture'];
        // 格式总是这样的 API20151012,NTS,VC14 后面两个是用到的
        $attr = explode(',', $config['PHP Extension Build']);
        $this->ntsVersion = $attr[1];
        $this->vcVersion = $attr[2];
        // PHP 版本
        $phpVersion = phpversion();
        $this->phpVersion = (false !== $phpVersion) ? $phpVersion : PHP_VERSION;

        // 扩展和php.ini 目录
        $this->extDir = ini_get('extension_dir');
        $this->iniPath = php_ini_loaded_file();
    }


    /**
     * 获取 PHP 信息
     * @return array
     * @throws ApplicationException
     */
    public function getPHPInfoArray()
    {
        // 通过缓冲区函数，获取信息
        ob_start();
        phpinfo(INFO_GENERAL);
        $phpinfo = ob_get_clean();

        // 保留 tr td 标签
        $phpinfo = strip_tags($phpinfo, "<tr><td>");

        // 正则匹配出来所有用的标签
        preg_match_all('/<td class="e">([\w\W]+)<\/td><td class="v">([\w\W]+)<\/td>/U', $phpinfo, $config);

        // 取出多余的空格
        $config[1] = array_map('trim', $config[1]);
        $config[2] = array_map('trim', $config[2]);

        // 根据 phpinfo() 的信息合并成键值对数组
        $config = array_combine($config[1], $config[2]);

        if (empty($config))
        {
            throw new ApplicationException('phpinfo 信息异常');
        }

        return $config;
    }

    public function getRunMode()
    {
        // php_sapi_name(), PHP_SAPI
    }

    /**
     * 拼接名字做为 key 返回
     */
    public function getExtendTypeAsKey()
    {
        // map 的 key 拼接形式，(PHP_VERSION)-(IS_NTS)-(VC_VERSION)-(WIN_VERSION)
        return "{$this->getPHPVersion()}-{$this->getNtsType()}-{$this->getVCVersion()}-{$this->getWinVersion()}";
    }

    /**
     * 获取 PHP 版本
     * @return string
     */
    public function getPHPVersion()
    {
        $version = phpversion();

        return (false !== $version) ? $version : PHP_VERSION;
    }

    public function getNtsType()
    {
        return '';
    }

    public function getVCVersion()
    {
        return '';
    }

    public function getWinVersion()
    {
        return '';
    }

    // 取出多余的斜杆
    private function normalize($service)
    {
        return is_string($service) ? ltrim($service, '\\ ') : $service;
    }
}