<?php

namespace DavidNineRoc\EasyExtends\Kernel;


use DavidNineRoc\EasyExtends\Exception\ContainerException;

trait ExceptionHandler
{
    protected function registerFatalHandler()
    {
        register_shutdown_function(function () {
            var_dump($lastError = error_get_last());
        });

        set_exception_handler(function (ContainerException $e) {
            var_dump($e->getMessage());
        });
    }

}
