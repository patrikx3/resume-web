<?php

namespace P3x;


/**
 *
 */
define('PARAMETER_LANGUAGE', 'patrikx3-language');
/**
 *
 */
define('PARAMETER_LANGUAGE_SWITCH', 'patrikx3-language-switch');

/**
 * Class Application
 * @package P3x
 */
class Application
{
    /**
     * @return bool
     */
    static function IsWin()
    {
        return DIRECTORY_SEPARATOR == '\\' ? true : false;
    }

    /**
     * @param $class
     * @param string $root
     * @return string
     */
    static function GenerateClassFilename($class, $root = 'application')
    {
        $class = str_replace('-', '_', $class);
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $className = ROOT . $root . DIRECTORY_SEPARATOR . $class . '.php';
        return $className;
    }

    /**
     * @param string $root
     */
    static function AutoLoad($root = 'application')
    {
        spl_autoload_register(
            function ($class) use ($root) {
                $filename = static::GenerateClassFilename($class, $root);
                if (is_file($filename)) {
                    include_once($filename);
                }
            }
        );
    }

    /**
     *
     */
    static function Boot()
    {
        static::AutoLoad();
        Template::Boot();
    }

    /**
     * @param $default_root
     */
    public static function Run($default_root)
    {
        //config::define();
        if (DEBUG) {
            Http::NoCache();
        }
        /*
        if (!DEBUG && http::last_modified_sent(GIT_DATE)) {
            return;
        }
        */
        Language::DecideLanguage();
        Router::Execute($default_root);
    }
}
