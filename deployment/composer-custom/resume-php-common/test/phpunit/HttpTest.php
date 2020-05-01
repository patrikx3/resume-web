<?php

use PHPUnit\Framework\TestCase;

use P3x\Http;
use P3x\Http\Url;

class HttpTest extends TestCase
{

    protected function setUp(): void
    {
        ApplicationTest::Init();
    }

    public function testHttp()
    {

        $this->assertFalse(Http::IsSsl());

        $expected = 'https://yahoo@patrikx3.com:99/hello/world?cool=1';
        $parse = parse_url($expected);
        $actual = Url::Unparse($parse);
        $this->assertEquals($expected, $actual);
    }
}
