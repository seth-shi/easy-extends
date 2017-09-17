<?php

namespace Kernel\App\Util;



use Kernel\App\Exception\ConfigException;

class Config
{
    // 扩展目录
    protected $extPath;
    // ini 文件路径
    protected $phpIniPath;

    // PHP 版本
    private $phpVersion;
    // NTS 版本
    private $ntsVersion;
    // VC  版本
    private $vcVersion;
    // win 版本
    private $winVersion;

    // 配置
    protected $iniConfig;
    // 关闭的配置
    protected $offConfig = array('False' => true, 'Off' => 'On', '' => '手动配置');

    /**
     * 注册基础配置
     * Config constructor.
     */
    public function __construct()
    {
        // 扩展和php.ini 目录
        $this->extPath = ini_get('extension_dir');
        $this->phpIniPath = php_ini_loaded_file();

        // 注册 phpinfo 信息
        $this->initBaseInfo();
    }

    /**
     * 打开一个 PHP 扩展
     * @param $extendName
     * @return bool
     */
    public function openExtend($extendName, $extendValue = null, $parent = 'PHP')
    {
        $config = $this->getExtendConfig($extendName, $parent);

        if (! is_string($config))
        {
            $config = (string)$config;
        }

        if (is_null($extendValue))
        {
            // 如果配置了此项， 但是配置文件中没有这个选项
            $extendValue = $this->iniConfig[$config];

            // 已经打开了此扩展， false=没有 false值=没开 off  或者值等于 false都需要操作
            if (array_search($config, $this->offConfig))
            {
                return true;
            }
        }
        elseif ($extendValue == $config)
        {
            return true;
        }

        // 重新写 ini 文件，打开扩展
        $this->writeExtendConfg($extendName, $extendValue, $parent);

        return false;
    }

    /**
     * 获取配置项，如无参数则返回全部
     * @param null $extendName
     * @param string $parent
     * @return bool
     */
    private function getExtendConfig($extendName = null, $parent = 'PHP')
    {
        if (is_null($this->iniConfig))
        {
            $this->readExtendConfg();
        }

        if (is_null($extendName))
        {
            return $this->iniConfig;
        }

        if ( isset($this->iniConfig[$parent][$extendName]))
        {
            return $this->iniConfig[$parent][$extendName];
        }

        return false;
    }

    /**
     * 读取所有配置
     */
    private function readExtendConfg()
    {
        $reader = new IniReader();

        $this->iniConfig = $reader->readFile($this->phpIniPath);
    }

    /**
     * 写配置文件
     * @param $extendName
     * @param $extendValue
     * @param string $parent
     */
    private function writeExtendConfg($extendName, $extendValue, $parent = 'PHP')
    {
        $writer = new IniWriter();

        // 往 $parent 节点插入一个值 这和 $var[] 的行为不同，后者会新建一个数组。
        $this->iniConfig[$parent][$extendName] = $extendValue;

        // php.ini 文件路径
        $writer->writeToFile($this->phpIniPath, $this->iniConfig);
    }




    /**
     * 拼接名字做为 key 返回
     */
    public function getExtendTypeAsKey()
    {
        // map 的 key 拼接形式，(PHP_VERSION)-(IS_NTS)-(VC_VERSION)-(WIN_VERSION)
        return "{$this->phpVersion}-{$this->ntsVersion}-{$this->vcVersion}-{$this->winVersion}";
    }


    /*********************************** 注册 phpinfo 信息 *************************/
    /**
     * 初始化基础属性
     * @throws ConfigException
     *
     */
    private function initBaseInfo()
    {
        $config = $this->getPHPInfoArray();

        // Architecture == X86
        if (! array_key_exists('Architecture', $config))
        {
            throw new ConfigException('phpinfo 中的 Architecture 信息异常');
        }

        // PHP Extension Build
        if (! array_key_exists('PHP Extension Build', $config))
        {
            throw new ConfigException('phpinfo 中的 PHP Extension Build 信息异常');
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
     * 获取 PHP 信息(关联数组返回)
     * @return array
     * @throws ConfigException
     */
    private function getPHPInfoArray()
    {
        // 通过缓冲区函数，获取信息
        ob_start();
        phpinfo(INFO_GENERAL);
        $phpinfo = ob_get_clean();

        if ($this->getRunMode() == 'cli')
        {
            // 以换行做为分隔
            $tmp = explode("\n", $phpinfo);
            // 取出空值数组
            $tmp = array_filter($tmp);
            // 以 => 分隔键值对
            $config = array();

            foreach ($tmp as $k => $v)
            {
                $v = explode('=>', $v);

                unset($tmp[$k]);

                if (count($v) === 2)
                {
                    $config[1][] = $v[0];
                    $config[2][] = $v[1];
                }
            }
        }
        else
        {
            // 保留 tr td 标签
            $phpinfo = strip_tags($phpinfo, "<tr><td>");

            // 正则匹配出来所有用的标签
            preg_match_all('/<td class="e">([\w\W]+)<\/td><td class="v">([\w\W]+)<\/td>/U', $phpinfo, $config);
        }



        // 取出多余的空格
        $config[1] = array_map('trim', $config[1]);
        $config[2] = array_map('trim', $config[2]);

        // 根据 phpinfo() 的信息合并成键值对数组
        $config = array_combine($config[1], $config[2]);

        if (empty($config))
        {
            throw new ConfigException('phpinfo 信息异常');
        }

        return $config;
    }

    /**
     * 获取运行方式
     * @return string
     */
    public function getRunMode()
    {
        $mode = php_sapi_name();

        return (false !== $mode) ? $mode : PHP_SAPI;
    }



    public function getExtPath()
    {
        return $this->extPath;
    }

}