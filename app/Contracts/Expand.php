<?php

namespace DavidNineRoc\EasyExtends\Contracts;

interface Expand
{
    // 是否有这个扩展(符合本机配置的)
    public function hasExtend();

    // 下载扩展
    public function downloadExtend();

    // 安装扩展
    public function installExtend($env);
}
