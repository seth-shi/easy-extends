<?php

    define('ROOT_PATH', __DIR__);


    // 注册自动加载
    require ROOT_PATH . '/Kernel/AutoLoad.php';
    spl_autoload_register('\AutoLoad::loaded');

    $app = new \Kernel\App\Application(ROOT_PATH);

    // 注册助手函数
    require ROOT_PATH . '/Kernel/helper.php';

    phpinfo();exit();
    // 获取本机的配置项目
    $extend = $app->make('redis');

    if (! $extend->hasExtend($extend))
    {
        exit('没有适配你环境的扩展包！');
    }

    // 下载扩展包
    $extend->downloadExtend();

    // 安装扩展包
    $extend->installExtend();
