<?php

require __DIR__.'/../vendor/autoload.php';

/**
 * 实例化应用程序，加载当前环境目录
 */
$app = new \DavidNineRoc\EasyExtends\Application(
    realpath(__DIR__.'/../')
);

return $app;