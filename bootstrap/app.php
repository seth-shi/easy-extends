<?php

use DavidNineRoc\EasyExtends\Application;
use DavidNineRoc\IniParseRender\IniManager;

require __DIR__.'/helpers.php';
require __DIR__.'/../vendor/autoload.php';


$app = new Application(
    realpath(__DIR__.'/../')
);

$app->bind(IniManager::class, function (Application $app) {
    return IniManager::load($app->getphpIniPath());
});


return $app;
