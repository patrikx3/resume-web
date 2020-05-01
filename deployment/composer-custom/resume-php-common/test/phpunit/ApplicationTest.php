<?php

use PHPUnit\Framework\TestCase;

use \P3x\Application;
use \P3x\Template as tpl;


class ApplicationTest extends TestCase
{

    static function Init()
    {
        if (defined('ROOT')) {
            return;
        }
        define('IPINFO_TOKEN', "test");
        define('ROOT', './');
        define('ROOT_BUILD', ROOT . 'build/');
        define('DEBUG', true);
        define('WEB_ROOT', '/patrikx3/');
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        $_SERVER["REQUEST_URI"] = '/';
        tpl::$TemplateRoot = ROOT . 'test/templates/';
        \P3x\View::$ViewRoot = ROOT . 'test/views/';
        \P3x\Language::$DirectoryRoot = ROOT . 'test/language';
        Application::Boot();
    }

    /**
     * @runInSeparateProcess
     */
    function testApplicationTemplate()
    {
        static::Init();
        $result = tpl::GetContent(function () {
            Application::Run('p3x/template/load/template');
        });
        $this->assertEquals('{{hello}} {{world}}', $result);
    }

    /**
     * @runInSeparateProcess
     */
    function testApplicationControllerLanguage()
    {
        static::Init();
        $result = json_decode(tpl::GetContent(function () {
            Application::Run('p3x/language/area/first');
        }));
        $this->assertEquals('first', $result->first->first);

    }
}
