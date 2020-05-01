<?php

use PHPUnit\Framework\TestCase;

use P3x\Template as tpl;
use P3x\Language as l;
use P3x\Debug as d;

class TemplateTest extends TestCase
{

    protected function setUp(): void
    {
        ApplicationTest::Init();
        tpl::Boot();
    }

    public function testReplace()
    {
        $renderer = tpl::Get('replace');
        $result = $renderer();

        $this->assertEquals('resume--js--common', $result);

    }

    public function testTemplate()
    {
        $renderer = tpl::Get('template');
        $result = $renderer([
            'hello' => 'hello',
            'world' => 'world'
        ]);

        $this->assertEquals('hello world', $result);
    }


    public function testJson()
    {
        $renderer = tpl::Get('json');
        $result = $renderer([
            'data' => [
                'one' => 1,
                'two' => 2
            ],
        ]);

        $this->assertEquals('{"one":1,"two":2}', $result);
    }

    public function testDefault()
    {
        tpl::MergeDefaultData([
            'first' => 1,
            'second' => 2,
            'third' => 3
        ]);
        $renderer = tpl::Get('default');
        $result = $renderer();
        $excepted = <<<EOF
1
2
3
EOF;
//        d::Send('Use this for js-common default.hbs:');
//        d::Dump($result);

        $this->assertEquals($excepted, $result);
    }

    public function testComples()
    {
        $renderer = tpl::Get('complex');
        $result = $renderer([
            'content' => 1900
        ]);
        $this->assertEquals('since 1900 - about ' . (date('Y') - 1900) . ' years', $result);
    }

    public function testPrefix()
    {
        $renderer = tpl::Get('prefix');

        $unicode = 'f26e';
        $icon_unicode = P3x\Template\Icon::Unicode($unicode);

        $first = l::Get('first', 'first');
        $another = l::Get('second/item', 'another');

        $base64 = 'this is a really long test';

        $date_format = 'Y/m/d H:i:s';
        $date_time = 1477165399514;
        $date_result = date($date_format, floor($date_time / 1000));

        $url = 'europe/moon/saturn';
        $url_result = \P3x\Router::Url($url);

        $sprintf_format = '%s %s';
        $sprintf_1 = 'nasa';
        $sprintf_2 = 'los angeles';
        $sprint_result = sprintf($sprintf_format, $sprintf_1, $sprintf_2);

        $count = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $count_result = count($count);

        $lvalue = 10;
        $rvalue = 2;

        $math_result_plus = $lvalue + $rvalue;
        $math_result_minus = $lvalue - $rvalue;
        $math_result_multiply = $lvalue * $rvalue;
        $math_result_divide = $lvalue / $rvalue;
        $math_result_remainder = $lvalue % $rvalue;

        $string_id = '1234567890 áééléá8)Ö)=+';
        $string_id_result = \P3x\Str::ToUrl($string_id);

        $result = $renderer([
            'unicode' => $unicode,
            'base64' => base64_encode($base64),
            'date-format' => $date_format,
            'date-time' => $date_time,
            'url' => $url,
            'sprintf-format' => $sprintf_format,
            'sprintf-1' => $sprintf_1,
            'sprintf-2' => $sprintf_2,
            'count' => $count,
            'lvalue' => $lvalue,
            'rvalue' => $rvalue,
            'string-id' => $string_id
        ]);

        $excepted = <<<EOF
{$first}
{$another}
{$icon_unicode}
{$base64}
{$date_result}
{$url_result}
{$sprint_result}
eq-true
ne-true
lt-true
gt-true
lte-true
gte-true
and-true
or-true
{$count_result}
{$math_result_plus}
{$math_result_minus}
{$math_result_multiply}
{$math_result_divide}
{$math_result_remainder}
{$string_id_result}
EOF;
        //d::send('Use this for js-common prefix.hbs:');
        //d::dump($result);
        $this->assertEquals($excepted, $result);
    }
}
