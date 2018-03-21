<?php

namespace Tests;

class EnvTest extends TestCase
{
    public function testHasExtPath()
    {
        $this->assertDirectoryExists(
            $this->app->getExtPath()
        );
    }

    public function testHasIniFile()
    {
        $this->assertFileExists(
            $this->app->getphpIniPath()
        );
    }
}
