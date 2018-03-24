#!/usr/bin/env php
<?php

/**
 * @var $app \DavidNineRoc\EasyExtends\Application
 */
$app = require __DIR__.'/bootstrap/app.php';
$argv[1] = 'mongodb';
/****************************************
 * 根据传入的参数实例化对应的 Extensions/ 类
 * @var $extension \DavidNineRoc\EasyExtends\Foundation\Expand
 */
$extension = $app->getExtension($argv);


/****************************************
 * 根据传入的参数实例化对应的 Extensions/ 类
 * @var $extension \DavidNineRoc\EasyExtends\Foundation\Expand
 */
$extension->installExtend($app->getEnv());
