<?php
namespace Config;


use P3x\Router;
use Router\Error;

/**
 * Class Route
 * @package Config
 */
class Route
{
    /**
     * @var array
     */
    public static $Routes
        = [
            'sitemap.xml' => 'sitemap',
            'sitemap-yandex.xml' => 'sitemap/yandex',
            'base.swf' => 'redirect/patrik-swf',
            'contact' => 'front/contact'
        ];

    // order is important
    /**
     * @var array
     */
    public static $Filters
        = [
            '\\Router\\Filter\\Admin',
            '\\Router\\Filter\\Theme',
        ];

    /**
     *
     */
    static function Define()
    {
        foreach (static::$Routes as $route_from => $route_to) {
            \P3x\Router\Route::$Routes[$route_from] = $route_to;
        }
        foreach (static::$Filters as $filter) {
            \P3x\Router\Route::$Filters[] = $filter;
        }


        Router::InjectError(
            '404', function () {
            Error::NotFound();
        });
    }

    /**
     * @return array
     */
    static function Folders()
    {
        $folder_source = 'assets/';
        $folder_source_scripts = $folder_source . 'scripts/';
        $folder_source_css = $folder_source . 'css/';

        $folder_production = 'production/';
        $folder_production_css = $folder_production . 'css/';
        $folder_production_script = $folder_production . 'scripts/';

        return [
            $folder_source,
            $folder_source_scripts,
            $folder_source_css,
            $folder_production,
            $folder_production_css,
            $folder_production_script
        ];
    }
}
