<?php

namespace DavidNineRoc\EasyExtends\Kernel;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

trait ExceptionHandler
{
    protected function registerFatalHandler()
    {
        /**
         * 日志记录
         */
        $log = new Logger('easy-extends');
        $log->pushHandler(new StreamHandler($this->getBasePath().'/bootstrap/logs/log.txt', Logger::WARNING));

        /**
         * 注册错误处理
         */
        $whoops = new Run;
        $whoops->pushHandler(new PlainTextHandler($log));
        $whoops->register();
    }

}
