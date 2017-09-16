<?php

namespace Kernel\App;

class Base
{
    // 取出多余的斜杆，空格
    private function normalize($service, $charlist = "\\ ")
    {
        return is_string($service) ? ltrim($service, $charlist) : $service;
    }
}