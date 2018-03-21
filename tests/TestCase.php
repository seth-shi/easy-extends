<?php

namespace Tests;

use DavidNineRoc\EasyExtends\Application;
use PHPUnit\Framework\TestCase as PHPUnitTest;

class TestCase extends PHPUnitTest
{
    /**
     * @var Application
     */
    protected $app;

    public function setUp()
    {
        parent::setUp();

        $this->app = Application::getInstance();
    }
}
