<?php

use DavidNineRoc\EasyExtends\Application;
use DavidNineRoc\EasyExtends\Filesystem\Filesystem;
use DavidNineRoc\EasyExtends\Filesystem\IniReader;
use DavidNineRoc\EasyExtends\Filesystem\IniWrite;


require __DIR__.'/../vendor/autoload.php';

/****************************************
 * 实例化应用程序，加载当前环境目录.
 */
$app = new Application(
    realpath(__DIR__.'/../')
);

/****************************************
 * 绑定程序运行必须的实例
 * 1. 文件操作系统实例
 * 2. 读取 ini 文件实例
 * 3. 写入 ini 文件实例
 */
$app->bind(Filesystem::class, function (Application $app) {
    return new Filesystem();
});
$app->bind(IniReader::class, function (Application $app) {
    return new IniReader($app->getphpIniPath());
});
$app->bind(IniWrite::class, function (Application $app) {
    return new IniWrite($app->getphpIniPath());
});

$iniConfig = $app->call(new IniReader($app->getBasePath() . '/tests/php.ini'), 'parse');
var_dump((new IniWrite(__FILE__ . 'php.ini'))->render());

return $app;
