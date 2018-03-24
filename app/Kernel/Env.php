<?php

namespace DavidNineRoc\EasyExtends\Kernel;

use DavidNineRoc\EasyExtends\Exception\ConfigException;
use DavidNineRoc\EasyExtends\Exception\NotExtensionDirException;


trait Env
{
    // 扩展目录
    protected $extPath;

    // ini 文件路径
    protected $phpIniPath;

    // PHP 版本
    protected $phpVersion;

    // NTS 版本
    protected $ntsVersion;

    // VC  版本
    protected $vcVersion;

    // win 版本
    protected $winVersion;

    /**
     * 加载当前环境变量，包括 php 版本，
     */
    public function loadCurrentEnv()
    {
        $this->checkConfig();

        $this->setIniInfo();

        $this->setBaseConfig();
    }

    /**
     * 检查 php.ini 是否有配置.
     * 扩展目录是否已经可以读取
     *
     * @throws ConfigException
     */
    protected function checkConfig()
    {
        if (false === php_ini_loaded_file()) {
            throw new ConfigException('invalid php.ini path, please copy  php.ini-development or php.ini-production as php.ini, and');
        } elseif (false === ini_get('extension_dir')) {
            throw new NotExtensionDirException('configure extension_dir not set');
        }
    }

    /**
     * 设置当前扩展的目录，
     * 当前 phpini 的文件路径.
     */
    protected function setIniInfo()
    {
        // 扩展和php.ini 目录
        $this->phpIniPath = php_ini_loaded_file();
        $this->extPath = $this->getExtensionPath($this->phpIniPath);
    }

    /**
     * 捕捉 phpinfo 的信息设置到内部属性.
     *
     * @throws ConfigException
     */
    protected function setBaseConfig()
    {
        $config = $this->getPHPInfoArray();

        // Architecture == X86
        if (!array_key_exists('Architecture', $config)) {
            throw new ConfigException('phpinfo Architecture information exception');
        }

        // PHP Extension Build
        if (!array_key_exists('PHP Extension Build', $config)) {
            throw new ConfigException('phpinfo PHP Extension Build information exception');
        }

        // 注册进属性
        $this->winVersion = $config['Architecture'];
        // 格式总是这样的 API20151012,NTS,VC14 后面两个是用到的
        $attr = explode(',', $config['PHP Extension Build']);
        $this->ntsVersion = $attr[1];
        $this->vcVersion = $attr[2];
        // PHP 版本
        $phpVersion = phpversion();
        $phpVersion = (false !== $phpVersion) ? $phpVersion : PHP_VERSION;
        // 截取前三位
        $this->phpVersion = substr($phpVersion, 0, 3);
    }

    /**
     * 获取 PHP 信息(关联数组返回).
     *
     * @return array
     *
     * @throws ConfigException
     */
    protected function getPHPInfoArray()
    {
        // 通过缓冲区函数，获取信息
        ob_start();
        phpinfo(INFO_GENERAL);
        $phpinfo = ob_get_clean();

        // 以换行做为分隔
        $tmp = explode("\n", $phpinfo);
        // 取出空值数组
        $tmp = array_filter($tmp);
        // 以 => 分隔键值对
        $config = array();

        foreach ($tmp as $k => $v) {
            $v = explode('=>', $v);

            unset($tmp[$k]);

            if (2 === count($v)) {
                $config[1][] = $v[0];
                $config[2][] = $v[1];
            }
        }

        // 取出多余的空格
        $config[1] = array_map('trim', $config[1]);
        $config[2] = array_map('trim', $config[2]);

        // 根据 phpinfo() 的信息合并成键值对数组
        $config = array_combine($config[1], $config[2]);

        if (empty($config)) {
            throw new ConfigException('phpinfo Extendtion');
        }

        return $config;
    }

    /**
     * 获取扩展存放的目录.
     *
     * @param $iniPath
     *
     * @return bool|string
     */
    protected function getExtensionPath($iniPath)
    {
        $basePath = dirname($iniPath);
        $extPath = get_cfg_var('extension_dir');

        return realpath($basePath.'/'.$extPath);
    }

    /**
     * 获取扩展目录.
     *
     * @return string
     */
    public function getExtPath()
    {
        return $this->extPath;
    }

    public function getEnv()
    {
        return strtolower("{$this->phpVersion}-{$this->ntsVersion}-{$this->vcVersion}-{$this->winVersion}");
    }

    /**
     * 获取 php.ini 路径.
     *
     * @return string
     */
    public function getphpIniPath()
    {
        return $this->phpIniPath;
    }

    /**
     * @return mixed
     */
    public function getPhpVersion()
    {
        return $this->phpVersion;
    }

    /**
     * @return mixed
     */
    public function getNtsVersion()
    {
        return $this->ntsVersion;
    }

    /**
     * @return mixed
     */
    public function getVcVersion()
    {
        return $this->vcVersion;
    }

    /**
     * @return mixed
     */
    public function getWinVersion()
    {
        return $this->winVersion;
    }
}
