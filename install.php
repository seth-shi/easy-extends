#!/usr/bin/env php
<?php

    if ($argc !== 2)
    {
        exit ('php install extend_name');
    }

    define('ROOT_PATH', __DIR__);


    // 注册自动加载
    require ROOT_PATH . '/Kernel/AutoLoad.php';
    spl_autoload_register('\AutoLoad::loaded');

    $app = new \Kernel\App\Application(ROOT_PATH);

    // 助手函数
    require ROOT_PATH . '/Kernel/helper.php';


    try
    {
        // 获取本机的配置项目
        $config = $app->make('config')->getExtendTypeAsKey();

        // 获取需要下载的扩展实例
        $extend = $app->make($argv[1]);
    }
    catch (\Kernel\App\Exception\ApplicationException $e)
    {
        exit($e->getMessage());
    }


    // 调用扩展自身的下载方式
    if (! $extend->hasExtend($config))
    {
        exit('There is no extension package that matches your environment！');
    }

    // 下载扩展包
    $extend->downloadExtend();

    // 安装扩展包
    $extend->installExtend();
