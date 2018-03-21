#!/usr/bin/env php
<?php

$app = require __DIR__.'/bootstrap/app.php';

try {
    // 获取本机的相关配置
    $config = $app->make('config')->getExtendTypeAsKey();

    // 获取需要下载的扩展实例
    $extend = $app->make($argv[1]);
} catch (\Kernel\App\Exception\ApplicationException $e) {
    exit($e->getMessage());
}

// 是否有符合本机配置的扩展
if (!$extend->hasExtend($config)) {
    exit('There is no extension package that matches your environment!');
}

// 下载扩展包
$extend->downloadExtend();

// 安装扩展包
$extend->installExtend();
