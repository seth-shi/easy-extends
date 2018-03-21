<?php

namespace DavidNineRoc\EasyExtends\Contracts;


interface Container
{
    public function has($key);
    public function get($key);
}