<?php

namespace Tests;

class ApplicationTest extends TestCase
{
    public function testBasePathNotNull()
    {
        $this->assertNotNull(
            $this->app->getBasePath()
        );
    }
}
