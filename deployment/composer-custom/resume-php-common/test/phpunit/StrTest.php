<?php

use PHPUnit\Framework\TestCase;

use P3x\Str;

class StrTest extends TestCase
{
    protected function setUp(): void
    {
        ApplicationTest::Init();
    }

    function testMb()
    {
        $check = 'lászló   patrík   vágyok hello !@#$ go )(*& to }}} los angeles';
        $expected = 'laszlo-patrik-vagyok-hello-go-to-los-angeles';
        $actual = Str::ToUrl($check);
        $this->assertEquals($expected, $actual);
    }

    public function testEndWith()
    {
        $this->assertTrue(Str::EndsWith('lla', 'a'));
        $this->assertFalse(Str::EndsWith('llal', 'a'));
    }

    public function testStartWith()
    {
        $this->assertTrue(Str::StartsWith('all', 'a'));
        $this->assertFalse(Str::StartsWith('sall', 'a'));
    }

    public function testEndWithInsensitive()
    {
        $this->assertTrue(Str::EnsWithInsensitive('lla', 'A'));
        $this->assertTrue(Str::EnsWithInsensitive('lla', 'a'));

        $this->assertFalse(Str::EnsWithInsensitive('lla', 'b'));
        $this->assertFalse(Str::EnsWithInsensitive('lla', 'B'));
    }

    public function testStartWithInsensitive()
    {

        $this->assertTrue(Str::StartsWithInsensitive('alla', 'A'));
        $this->assertTrue(Str::StartsWithInsensitive('Alla', 'a'));

        $this->assertFalse(Str::StartsWithInsensitive('lla', 'b'));
        $this->assertFalse(Str::StartsWithInsensitive('lla', 'B'));
    }

    public function testTestRemove()
    {
        $this->assertEquals('patrik', Str::StartRemove('remove_patrik', 'remove_'));
        $this->assertEquals('removepatrik', Str::StartRemove('removepatrik', 'remove_'));
        $this->assertEquals('_removepatrik', Str::StartRemove('__removepatrik', '_'));
    }
}
