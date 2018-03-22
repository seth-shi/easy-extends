<?php

use DavidNineRoc\EasyExtends\Application;
use DavidNineRoc\EasyExtends\Filesystem\Filesystem;
use DavidNineRoc\EasyExtends\Filesystem\IniReader;


require __DIR__.'/../vendor/autoload.php';

/**
 * 实例化应用程序，加载当前环境目录.
 */
$app = new Application(
    realpath(__DIR__.'/../')
);

$app->bind(Filesystem::class, function (Application $app) {
    return new Filesystem();
});
$app->bind(IniReader::class, function (Application $app) {
    return new IniReader($app->getphpIniPath());
});

 // var_dump((new IniReader($app->getBasePath() . '/php.ini'))->parse($app->make(Filesystem::class)));

return $app;
