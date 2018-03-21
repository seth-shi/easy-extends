<?php

namespace DavidNineRoc\EasyExtends\Contracts;

use DavidNineRoc\EasyExtends\Application;

interface AppConstruct
{
    public function __construct(Application $app);
}
