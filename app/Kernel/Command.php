<?php

namespace DavidNineRoc\EasyExtends\Kernel;

use DavidNineRoc\EasyExtends\Exception\CommandException;

trait Command
{
    public function getExtension($argv)
    {
        if (2 !== count($argv)) {
            throw new CommandException('Argv Parameters must have only two parameters');
        }

        list($script, $extend) = $argv;

        $class = '\\DavidNineRoc\\EasyExtends\\Extensions\\'.ucfirst($extend);

        if (!class_exists($class)) {
            throw new CommandException("Not exists class [{$class}]");
        }

        return new $class($this);
    }
}
