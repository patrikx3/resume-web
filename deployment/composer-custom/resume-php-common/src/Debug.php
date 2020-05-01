<?php

namespace P3x;

/**
 * Class Debug
 * @package P3x
 */
class Debug
{
    /**
     * @param $message
     */
    static function Send($message)
    {
        echo $message . PHP_EOL;
    }

    /**
     *
     */
    static function GtCwd()
    {
        static::Send(sprintf('Current directory: %s', getcwd()));
    }

    /**
     * @param $dir
     */
    static function ChDir($dir)
    {
        chdir($dir);
        Debug::GtCwd();
    }

    /**
     * @param $data
     */
    static function Dump(&$data)
    {
        if (php_sapi_name() != 'cli') {
            echo '<pre>';
        }
        print_r($data);
        if (php_sapi_name() != 'cli') {
            echo '</pre>';
        } else {
            echo PHP_EOL;
        }
    }
}
