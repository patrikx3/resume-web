<?php
use PHPUnit\Framework\TestCase;

use P3x\Application;
use P3x\Template as tpl;
use P3x\Http;
use P3x\Debug;

class ApplicationTest extends TestCase
{
    static function Init() {
        if (defined('ROOT')) {
            return;
        }
        define('ROOT', getcwd() . '/deployment/');
        $_SERVER['HTTP_HOST'] = 'patrikx3.patrikx3.com';
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        $_SERVER['REQUEST_URI'] = 'front/about-me';
        include_once ROOT . 'boot.php';
        Application::Boot();
    }

    protected function setUp()
    {
        static::Init();
    }

    static function GetRoute($route, $is_ajax = false) {
        if ($is_ajax) {
            http::$Headers['X-Requested-With'] = 'XMLHttpRequest';
        }
        return tpl::GetContent(function() use($route) {
            return Application::Run($route);
        });
    }

    /**
     * @runInSeparateProcess
     */
    function testApplication() {
        $result = json_decode(static::GetRoute('front/projects?production', true), true);
        $this->assertEquals($result['content']['template'], 'about-me');
    }



}