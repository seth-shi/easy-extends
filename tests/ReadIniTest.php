<?php

namespace Tests;

use DavidNineRoc\EasyExtends\Filesystem\IniReader;

class ReadIniTest extends TestCase
{
    public function testIniReader()
    {
        $ini = new IniReader(
            __DIR__.'/php.ini'
        );

        $this->assertInstanceOf(IniReader::class, $ini);

        return $ini;
    }

    /**
     * 测试 php.ini 的数据有效性
     *
     * @depends testIniReader
     * @param $iniReader
     */
    public function testValidateIni(IniReader $iniReader)
    {
        $ini = $this->app->call($iniReader, 'parse');

        $this->assertArrayHasKey('PHP', $ini);
    }
}
