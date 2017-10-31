<?php

namespace Kernel\App\Util;



use Kernel\App\Exception\ConfigException;
use Kernel\App\Extensions\Extendtion;

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
    protected $offConfig = array('False' => true, 'Off' => 'On', '' => 'handler config');

    /**
     * 注册基础配置
     * Config constructor.
     */
    public function __construct()
    {
        // 扩展和php.ini 目录
        $this->extPath    = ini_get('extension_dir');
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
        // 扩展是否已经开启
        if ($this->isOpenExtendConfig($extendValue, $parent)) {
            return true;
        }

        $config = $this->getExtendConfig($extendName, $parent);

        if (!is_string($config)) {
            $config = (string) $config;
        }


        if (is_null($extendValue)) {
            // 如果配置了此项， 但是配置文件中没有这个选项
            $extendValue = $this->iniConfig[$config];

            // 已经打开了此扩展， false=没有 false值=没开 off  或者值等于 false都需要操作
            if (array_search($config, $this->offConfig)) {
                return true;
            }
        } elseif ($extendValue == $config) {
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
        if (is_null($this->iniConfig)) {
            $this->readExtendConfg();
        }

        if (is_null($extendName)) {
            return $this->iniConfig;
        }


        if (isset($this->iniConfig[$parent][$extendName])) {
            return $this->iniConfig[$parent][$extendName];
        }

        return false;
    }

    /**
     * 扩展是否已经开启
     * @param null $extendName
     * @param string $parent
     */
    private function isOpenExtendConfig($extendName, $parent = 'PHP')
    {
        if (is_null($this->iniConfig)) {
            $this->readExtendConfg();
        }

        return in_array($extendName, $this->iniConfig[$parent]);
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
        // 这里读取的时候，需要判断一下是否存在
        $flag_count = 0;
        $tmp_key    = $extendName;
        do {
            if (array_key_exists($tmp_key, $this->iniConfig[$parent])) {
                // 每次进来加一个 #
                ++$flag_count;
                $tmp_key = $extendName . str_repeat('#', $flag_count);
            } else {
                // 出去的时候，如果 flag_count 不是0 要重新赋值带有 # 的key 给它
                if ($flag_count != 0) {
                    $extendName = $tmp_key;
                }
                // 如果没有重复就直接退出
                $flag_count = false;
            }

        } while ($flag_count);


        $writer                                = new IniWriter();
        // 往 $parent 节点插入一个值 这和 $var[] 的行为不同，后者会新建一个数组。  TODO
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
        $attr             = explode(',', $config['PHP Extension Build']);
        $this->ntsVersion = $attr[1];
        $this->vcVersion  = $attr[2];
        // PHP 版本
        $phpVersion       = phpversion();
        $phpVersion       = (false !== $phpVersion) ? $phpVersion : PHP_VERSION;
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

        if ($this->getRunMode() == 'cli') {
            // 以换行做为分隔
            $tmp    = explode("\n", $phpinfo);
            // 取出空值数组
            $tmp    = array_filter($tmp);
            // 以 => 分隔键值对
            $config = array();

            foreach ($tmp as $k => $v) {
                $v = explode('=>', $v);

                unset($tmp[$k]);

                if (count($v) === 2) {
                    $config[1][] = $v[0];
                    $config[2][] = $v[1];
                }
            }
        } else {
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

        if (empty($config)) {
            throw new ConfigException('phpinfo Extendtion');
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


    /**
     * 获取扩展目录
     * @return string
     */
    public function getExtPath()
    {
        return $this->extPath;
    }

    /**
     * 获取 php.ini 路径
     * @return string
     */
    public function getphpIniPath()
    {
        return $this->phpIniPath;
    }

}