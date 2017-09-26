<?php
namespace Cli;

use P3x\Debug;

/**
 * Class Build
 * @package Cli
 */
class Build
{
    /**
     *
     */
    public function run() {
        Debug::Send('Check following files for directories:');
        Debug::Send('.bowerrc');
        Debug::Send('.gitignore');
        Debug::Send('bower.json');
        Debug::Send('Gruntfile.js');
        Debug::Send('package.json');

        Debug::Send('RESUME');
        system('composer update');

        Debug::Send('PHP-COMMON');
        Debug::ChDir('../php-common');
        system('phpunit');

        Debug::Send('JS-COMMON');
        Debug::ChDir('../js-common');
        system('npm update');
        system('bower update');
        system('grunt build');

        Debug::Send('JS-BOOTSTRAP');
        Debug::ChDir('../js-bootstrap');
        system('npm update');
        system('bower update');
        system('grunt build');

        Debug::Send('RESUME');
        Debug::ChDir('../resume');
        system('phpunit');
        system('npm update');
        system('bower update');
        system('grunt build');

        $mpdf = new MPdf();
        $mpdf->run();

        chmod(VERSION_FILE, 0777);
        chmod(ROOT_BUILD, 0777);
    }
}