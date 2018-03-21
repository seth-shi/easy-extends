<?php

namespace Kernel\App\Extensions;

use Kernel\App\Common\Extendtion;

class Rollback extends Extendtion
{
    private $phpiniPath = '';
    private $backupPath = '';


    public function __construct()
    {
        $this->phpiniPath = app('config')->getphpIniPath();
        $this->backupPath = $this->phpiniPath . '.bak';
    }

    /**
     * 回滚不需要判断
     * @param $key
     * @return bool
     */
    public function hasExtend($key)
    {
        return true;
    }

    public function downloadExtend($key = null)
    {
        return true;
    }

    /**
     * 把 php.ini 文件回复到原来的地方
     */
    public function installExtend()
    {
        if (!is_file($this->backupPath)) {
            echo "backup file fail: php.ini.bak file not exist\n";
            exit;
        }

        if (copy($this->backupPath, $this->phpiniPath)) {
            // 删除备份文件
            echo "rollback complete\n";
        } else {
            echo "rollback fail\n";
        }
    }
}