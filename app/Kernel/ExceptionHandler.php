<?php

namespace DavidNineRoc\EasyExtends\Kernel;

use Exception;

trait ExceptionHandler
{
    protected function registerFatalHandler()
    {
        set_exception_handler(function ($e) {
            var_dump($e);
            exit(0);
        });
    }

}
