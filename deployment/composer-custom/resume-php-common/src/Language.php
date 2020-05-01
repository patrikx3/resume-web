<?php

namespace P3x;

/**
 * Class Language
 * @package P3x
 */
class Language
{
    /**
     * @var string
     */
    static $DirectoryRoot = ROOT . 'language';

    /**
     * @var string
     */
    static $DefaultLanguage = 'en';
    /**
     * @var string
     */
    static $Language = 'en';

    /**
     * @var array
     */
    static $AvailableLanguages
        = [
            'en',
            'hu'
        ];

    /**
     * @var array
     */
    static $Area = array();

    // maps country to language
    /**
     * @var array
     */
    static $Country
        = [
            'hu' => 'hu'
        ];

    /**
     * @param null $language
     * @return mixed
     */
    static function LoadAll($language = null)
    {
        if ($language == null) {
            $language = static::$Language;
        }
        foreach (static::GetAreas($language) as $area) {
            static::LoadArea($area, $language);
        }
        return static::$Area[$language];
    }

    /**
     * @param null $language
     * @return array
     */
    static function GetAreas($language = null)
    {
        if ($language == null) {
            $language = static::$Language;
        }
        $areas = static::Recursive(static::GetRootDirectory($language));
        return $areas;
    }

    /**
     * @param $dir
     * @return array
     */
    private static function Recursive($dir)
    {
        $areas = array();
        $dirs = scandir($dir);
        foreach ($dirs as $filename) {
            if ($filename != '.' && $filename != '..') {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $filename)) {
                    $areas = array_merge(
                        $areas, static::Recursive(
                        $dir . DIRECTORY_SEPARATOR . $filename
                    )
                    );
                } else {
                    $area_dir = $dir . DIRECTORY_SEPARATOR;
                    $area_dir = substr(
                        $area_dir, strlen(static::GetRootDirectory()) + 1
                    );
                    $areas[] = $area_dir . basename($filename, '.php');
                }
            }
        }
        return $areas;
    }

    /**
     * @param null $language
     * @return string
     */
    static function GetRootDirectory($language = null)
    {
        if ($language == null) {
            $language = static::$Language;
        }
        return static::$DirectoryRoot . DIRECTORY_SEPARATOR . $language . DIRECTORY_SEPARATOR;
    }

    /**
     * @param $area
     * @param null $language
     * @return mixed
     */
    static function LoadArea($area, $language = null)
    {
        if ($language == null) {
            $language = static::$Language;
        }
        global $l;
        $include = static::GetRootDirectory($language) . $area . '.php';
        require($include);
        static::$Area[$language][$area] = $l;
        return static::$Area[$language][$area];
    }

    /**
     *
     */
    static function DecideLanguage()
    {
        $language = static::$Language;

        $cookie_language = '';
        if (isset($_COOKIE[PARAMETER_LANGUAGE])) {
            $cookie_language = $_COOKIE[PARAMETER_LANGUAGE];
        };
        if (strlen($cookie_language) == 2 && static::ValidLanguage($cookie_language)) {
            static::$Language = $cookie_language;
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
            // hungary 185.33.54.10
            //$ip = '185.33.54.10';
            // gsmu 64.58.143.88
            //$ip = '64.58.143.88';
            // bratain 185.52.24.240
            //$ip = '185.52.24.240';
            // spanish 217.15.39.207
            //$ip = '217.15.39.207';
            list($body,) = Http::Get("http://ipinfo.io/{$ip}/json?token=" . IPINFO_TOKEN);
            $details = @json_decode(
                $body
            );
            if (is_object($details) && property_exists($details, 'country')) {
                $country = strtolower($details->country);

                if (array_key_exists($country, static::$Country)) {
                    $language = static::$Country[strtolower($country)];
                }
                if (static::ValidLanguage($language)) {
                    static::SetLanguage($language);
                }
            }
        }
    }

    /**
     * @param $language
     * @return bool
     */
    static function ValidLanguage($language)
    {
        $index = array_search($language, static::$AvailableLanguages);
        return $index !== false;
    }

    /**
     * @param $Language
     */
    static function SetLanguage($Language)
    {
        static::$Language = $Language;
        static::SendLanguage();
    }

    /**
     *
     */
    static function SendLanguage()
    {
        Http::SetCookie(PARAMETER_LANGUAGE, static::$Language, time() + (86400 * 365));
        header('Content-language: ' . static::$Language, true);
    }

    /**
     * @param $language
     * @return bool
     */
    static function TrySwitchLanguage($language)
    {
        if (!static::ValidLanguage($language)) {
            return false;
        }
        static::SetLanguage($language);
        return true;
    }

    /**
     * @param $start
     * @param $endOriginal
     * @return string
     */
    static function GetDuration($start, $endOriginal)
    {
        $start->setTime(0, 0, 0);
        $end = clone $endOriginal;
        $end->setTime(0, 0, 0);
        $end->add(new \DateInterval('P1D'));

        $diff = $end->diff($start);
        $output = '';
        $year = $diff->y;
        $add = '';
        if ($year > 0) {
            $output .= $year . ' ' . static::GetPlural($year, 'layout', 'date-year', 'date-years');
            $add = ' ';
        }
        $month = $diff->m;
        if ($month > 0) {
            $output .= $add . $month . ' ' . static::GetPlural($month, 'layout', 'date-month', 'date-months');
            $add = ' ';
        }
        $days = $diff->d;
        if ($days > 1 || ($year == 0 && $month == 0)) {
            $output .= $add . $days . ' ' . static::GetPlural($days, 'layout', 'date-day', 'date-days');
        }
        return $output;
    }

    /**
     * @param $count
     * @param $area
     * @param $item_single
     * @param $item_plural
     * @return mixed
     */
    static function GetPlural($count, $area, $item_single, $item_plural)
    {
        return static::Get($area, abs($count) > 1 ? $item_plural : $item_single);
    }

    /**
     * @param $area
     * @param $item
     * @param null $language
     * @return mixed
     */
    static function Get($area, $item, $language = null)
    {
        return static::GetArea($area, $language)[$item];
    }

    /**
     * @param $area
     * @param null $language
     * @return mixed
     */
    static function GetArea($area, $language = null)
    {
        if ($language == null) {
            $language = static::$Language;
        }
        if (!isset(static::$Area[$language]) || !isset(static::$Area[$language][$area])) {
            static::LoadArea($area, $language);
        }
        return static::$Area[$language][$area];
    }

    /**
     * @return array|mixed
     */
    static function GetFilled()
    {
        if (!isset(static::$Area[static::$Language])) {
            return [];
        }
        return static::$Area[static::$Language];
    }

    /**
     *
     */
    static function Clear()
    {
        static::$Area = [];
    }

    /**
     * @param $route
     * @param null $destination
     * @return string
     */
    static function RouteUrl($route, $destination = null)
    {
        $route = explode('/', $route);

        if ($destination == null) {
            $destination = static::$Language;
        }

        if ($destination == static::$DefaultLanguage) {
            array_unshift($route, static::$DefaultLanguage);
            $route = implode('/', $route);
            return WEB_ROOT . $route;
        }

        if ($destination != null) {
            global $l;
            $include = static::$DirectoryRoot . DIRECTORY_SEPARATOR . $destination . DIRECTORY_SEPARATOR . 'router.php';
            require($include);
            $routes_locale = $l['router'];
        } else {
            $routes_locale = static::Get('router', 'router');
        }

        foreach ($route as $key => $local_route) {
            if (isset($routes_locale[$local_route])) {
                $route[$key] = $routes_locale[$local_route]['title'];

                if (isset($routes_locale[$local_route]['child'])) {
                    $routes_locale = $routes_locale[$local_route]['child'];
                }
            }
        }

        $route = implode('/', $route);
        return static::Url($route, $destination);
    }

    /**
     * @param $url
     * @param null $destination
     * @return string
     */
    static function Url($url, $destination = null)
    {
        if ($destination == null) {
            $destination = static::$DefaultLanguage;
        }
        return Router::Url($destination . '/' . $url);
    }

    /**
     * @param $routes
     * @return mixed
     */
    static function RouteUrlInverse($routes)
    {
        if (static::$Language == static::$DefaultLanguage) {
            return $routes;
        }
        $route_inverse = static::Get('router', 'router-inverse');
        foreach ($routes as $key => $local_route) {
            if (isset($route_inverse[$local_route])) {
                $routes[$key] = $route_inverse[$local_route]['title'];

                if (isset($route_inverse[$local_route]['child'])) {
                    $route_inverse = $route_inverse[$local_route]['child'];
                }
            }
        }
        return $routes;

    }

    /**
     * @param $route
     * @return mixed
     */
    static function GenerateInverseRoute($route)
    {
        foreach ($route as $route_key => $route_item) {
            $inverse_key = $route[$route_key]['title'];
            $inverse_title = $route_key;
            $inverse_route = $route[$route_key];
            $route[$inverse_key] = $inverse_route;
            $inverse_route['title'] = $inverse_title;
            $route[$inverse_key] = $inverse_route;
            unset($route[$route_key]);
            if (isset($route[$inverse_key]['child'])) {
                $route[$inverse_key]['child'] = static::GenerateInverseRoute($route[$inverse_key]['child']);
            }
        }
        return $route;
    }
}
