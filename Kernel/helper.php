<?php


if (! function_exists('app'))
{
    function app($make = null, $parameters = [])
    {
        if (is_null($make))
        {
            return \Kernel\App\Application::getInstance();
        }

        return \Kernel\App\Application::getInstance()->make($make, $parameters);
    }
}

if (! function_exists('config'))
{
    function config()
    {
    }
}