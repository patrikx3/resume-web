<?php

use PHPUnit\Framework\TestCase;

use P3x\Language as l;

class LanguageTest extends TestCase
{
    public function testAreaList()
    {
        $areas = l::GetAreas();
        $count = count($areas);
        $this->assertEquals(2, $count);
    }

    public function testItem()
    {
        $first = l::Get('first', 'first');
        $this->assertEquals('first', $first);

        $another = l::Get('second/item', 'another');
        $this->assertEquals('another', $another);

    }
}
