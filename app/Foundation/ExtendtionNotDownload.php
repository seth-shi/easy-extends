<?php

namespace Kernel\App\Common;

/**
 * 只需要打开扩展不需要下载的继承这个类
 * Class Expand.
 */
class ExtendtionNotDownload implements ExtendtionInterface
{
    // 打开的扩展名
    protected $extendName;

    // 扩展值
    protected $extendValue;

    // 父节点
    protected $parent = 'PHP';

    public function hasExtend($key)
    {
        return true;
    }

    public function downloadExtend($key = null)
    {
        return true;
    }

    public function installExtend()
    {
        exit('please overwrite ExtendsNotDownload');
    }
}
