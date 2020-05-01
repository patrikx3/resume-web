<?php

use PHPUnit\Framework\TestCase;

use P3x\Router;

class RouterTest extends TestCase
{
    public function testRouter()
    {
        $this->assertEquals(Router::Url('hello'), '/patrikx3/hello');
        $this->assertEquals(Router::Url('hello/world'), '/patrikx3/hello/world');
    }

    public function testPathToUrl()
    {
        $this->assertEquals(Router::PathToUrl('/admin/Index/index'), '/admin/index/index');
        $this->assertEquals(Router::PathToUrl('/front/aboutMe'), '/front/about-me');
        $this->assertEquals(Router::PathToUrl('/front/goWithMeSomething/go'), '/front/go-with-me-something/go');
        $this->assertEquals(Router::PathToUrl('/FrontThisGo/becasueThisIsGood/an-Now'), '/front-this-go/becasue-this-is-good/an-now');
    }
}
