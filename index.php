<?php

    define('ROOT_PATH', __DIR__);


    // 注册自动加载
    require ROOT_PATH . '/Kernel/AutoLoad.php';
    spl_autoload_register('\AutoLoad::loaded');

    $app = new \Kernel\App\Application(ROOT_PATH);

    // 获取本机的配置项目
    $extend = $app->make('redis');

    // 是否有适合这个 PHP NTS VC WIN 版本的扩展包
    if (! $extend->hasExtend($extend))
    {
        exit('There is no extension package that matches your environment！');
    }

    // 下载扩展包
    $extend->downloadExtend();

    // 安装扩展包
    $extend->installExtend();
