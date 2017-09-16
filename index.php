<?php

    define('ROOT_PATH', __DIR__);


    // 注册自动加载
    require ROOT_PATH . '/Kernel/AutoLoad.php';
    spl_autoload_register('\AutoLoad::loaded');

    $app = new \Kernel\App\Application();


    var_dump($app);