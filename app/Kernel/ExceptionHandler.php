<?php

namespace DavidNineRoc\EasyExtends\Kernel;

use Exception;

trait ExceptionHandler
{
    protected function registerFatalHandler()
    {
        set_exception_handler(function ($e) {
            exit;
            var_dump($e);
            exit(0);
        });
    }

}
