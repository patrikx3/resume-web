<?php

namespace P3x;

use P3x\Router\Route;
use P3x\Http\Url;

/**
 * Class Router
 * @package P3x
 */
class Router
{
    /**
     * @var null
     */
    public static $CurrentControllerPath = null;
    /**
     * @var null
     */
    public static $CurrentControllerPathWithArgs = null;

    /**
     * @var array
     */
    static $ErrorInjection = [];

    /**
     * @param $code
     * @param $callback
     */
    static function InjectError($code, $callback)
    {
        $code = (string)$code;
        static::$ErrorInjection[$code] = $callback;
    }

    /**
     * @return mixed
     */
    static function NotFound()
    {
        if (isset(static::$ErrorInjection['404'])) {
            return call_user_func_array(static::$ErrorInjection['404'], []);
        };
        $not_found = '404 Not Found';
        header('HTTP/1.0 ' . $not_found);
    }

    /**
     * @param $default_route
     * @param string $empty_action
     * @return mixed
     */
    static function Execute($default_route, $empty_action = 'index')
    {
        $path = strtok($_SERVER["REQUEST_URI"], '?');

        $path = static::RemoveWebroot($path);
        $path = static::SanitizePath($path);
        if (Language::ValidLanguage($path)) {
            $path = $path . '/' . $default_route;
        } elseif ($path == '/' || $path == '') {
            $path = $default_route;
        }
        if (isset(Route::$Routes[$path])) {
            $path = Route::$Routes[$path];
        }
        $routes = static::PathToRoute($path);

        // injectors
        foreach (Route::$Filters as $filter) {
            $filter_object = new $filter();
            $result = $filter_object->filter($path, $routes, $default_route);
            if (!$result) {
                return;
            }
        }
        $generate_arguments = $routes;

        if ($routes[0] == 'p3x') {
            $controller_class = '\\P3x\\Controller';
            $index_start = 1;
        } else {
            $controller_class = Route::$ControllerNamespace;
            $index_start = 0;
        }
        $found = false;
        $controll_file = null;
        $max_count = count($routes);
        $current_controller_path = '';
        $current_controller_path_append = '';
        for ($index = $index_start; $index < $max_count; $index++) {
            $controller_class .= '\\' . static::RouteToClass($routes[$index]);
            $current_controller_path .= $current_controller_path_append . strtolower($routes[$index]);
            $current_controller_path_append = '/';
            if (class_exists($controller_class)) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            if (class_exists($controller_class . '\\Index')) {
                $controller_class = $controller_class . '\\Index';
                $current_controller_path .= '/Index';
            } else {
                return Router::NotFound();
            }
        }
        $controller = new $controller_class();
        $method = '';
        if ($max_count > $index + 1) {
            $method = $routes[$index + 1];
        }
        if ($method == '') {
            $method = $empty_action;
        }
        $method = static::RouteToMethod($method);
        if (!method_exists($controller, $method)) {
            return Router::NotFound();
        }
        $arguments = array();
        if ($max_count > $index + 2) {
            $arguments = array_splice($generate_arguments, $index + 2);
        }

        $current_controller_path .= '/' . $method;
        $current_controller_path = str_replace('_', '-', $current_controller_path);
        $current_controller_path = static::PathToUrl($current_controller_path);
        $current_controll_path_with_args = $current_controller_path;
        if (count($arguments) > 0) {
            $current_controll_path_with_args .= '/' . implode('/', $arguments);
        }

        static::$CurrentControllerPath = $current_controller_path;
        static::$CurrentControllerPathWithArgs = $current_controll_path_with_args;

        if (is_callable(
            array(
                $controller,
                $method
            )
        )) {
            call_user_func_array(
                array(
                    $controller,
                    $method
                ), $arguments
            );
        } else {
            return Router::NotFound();
        }
    }

    /**
     * @param $className
     * @return mixed|string
     */
    static function RouteToClass($className)
    {
        $className = str_replace('_', '-', $className);
        $className = str_replace('-', ' ', $className);
        $className = str_replace('\\', '\\ ', $className);
        $className = mb_convert_case($className, MB_CASE_TITLE, "UTF-8");
        $className = str_replace(' ', '', $className);
        return $className;
    }

    /**
     * @param $method
     * @return string
     */
    static function RouteToMethod($method)
    {
        return lcfirst(static::RouteToClass($method));
    }

    /**
     * @param $path
     * @return string
     */
    static function PathToUrl($path)
    {
        $regex = preg_replace('/(([^\/-])([A-Z]))/', '$2-$3', $path);
        $path = ltrim(strtolower($regex), '-');
        return $path;
    }

    /**
     * @param $path
     * @return string
     */
    static function RemoveWebroot($path)
    {
        if (substr($path, 0, strlen(WEB_ROOT)) == WEB_ROOT) {
            $path = substr($path, strlen(WEB_ROOT));
        }
        return $path;
    }

    /**
     * @param $path
     * @return array
     */
    static function PathToRoute($path)
    {
        $route = explode('/', $path);
        if ($route[count($route) - 1] == '') {
            array_pop($route);
        }
        return $route;
    }

    /**
     * @param $path
     * @return mixed
     */
    static function SanitizePath($path)
    {
        $path = preg_replace('/\/+/', '/', $path);
        $path = preg_replace('/\/$/', '', $path);
        return $path;
    }

    /**
     * @return string
     */
    static function RequestInfo()
    {
        $ip = Http::GetClientIp();
        $json_function = function ($data) {
            return '<pre style="font-size: 16px;">' . json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</pre>';
        };
        $output = '';
        $array_function = function ($title, $array) use ($json_function, &$output) {
            if (!isset($array) || count($array) == 0) {
                return;
            }
            $output .= strtoupper($title);
            $output .= ($json_function($array));
        };
        $url_function = function ($title, $url) use ($json_function, &$output) {
            list($url_data,) = Http::Get($url);
            if ($url_data != '') {
                $output .= strtoupper($title);
                $output .= ($json_function(json_decode($url_data)));
            }
            return $url_data;
        };
        $found_data = false;
        $location_info = function ($data, $latitude, $longitude) use (&$found_data, &$output) {
            if ($found_data === true) {
                return;
            }
            if (is_object($data)) {
                if ($longitude == null && property_exists($data, $latitude)) {
                    $location = $data->$latitude;
                    $found_data = true;
                } else {
                    if (property_exists($data, $latitude)) {
                        $location = $data->$latitude . ',' . $data->$longitude;
                        $found_data = true;
                    }
                }
                if ($found_data) {
                    $output .= '<div>';
                    $google_maps_api_key = GOOGLE_MAPS_API_KEY;
                    $width = 640;
                    $height = 300;
                    $image_url = "http://maps.googleapis.com/maps/api/staticmap?center={$location}&zoom=12&size={$width}x{$height}&sensor=false&key={$google_maps_api_key}";
                    $output .= "<a target=\"_blank\" href=\"{$image_url}\">";
                    $output .= "<div><img class=\"map\" width=\"{$width}\" height=\"{$height}\" src=\"{$image_url}\"></div>";
                    $output .= "</a>";
                    $output .= "<a target=\"_blank\" href=\"http://maps.google.com/maps?q={$location}\">";
                    $output .= strtoupper($data->city);
                    $output .= "</a>";
                    $output .= '</div><br/>';
                }
            }
        };
        $link = Url::FullUrl($_SERVER['REQUEST_URI']);
        $output .= "<a target=\"_blank\" href=\"{$link}\">{$link}</a>" . '<br/><br/>';
        $output .= "<a href='http://{$ip}'>{$ip}</a><br/><br/>";
        $data = @json_decode($url_function('ipinfo.io', "http://ipinfo.io/{$ip}/json?token=" . IPINFO_TOKEN));
        $location_info($data, 'loc', null, 'city');
        $data = @json_decode($url_function('ip-api.com', "http://ip-api.com/json/{$ip}"));
        $location_info($data, 'lat', 'lon', '');
        if (!is_object($data)) {
            $data = @json_decode($url_function('freegeoip.net', "http://freegeoip.net/json/{$ip}"));
            $location_info($data, 'latitude', 'longitude');
        }
        $array_function('server', $_SERVER);
        $array_function('cookie', $_COOKIE);
        $array_function('post', $_POST);
        $array_function('get', $_GET);
        $array_function('session', @$_SESSION);
        return $output;
    }


    /**
     * @param $url
     */
    static function Redirect($url)
    {
        if ($url[0] != '/') {
            $url = WEB_ROOT . $url;
        }
        header('Location: ' . $url);
    }


    /**
     * @param $url
     * @return string
     */
    static function UrlSsl($url)
    {
        $url = static::Url($url);
        return 'https://' . $_SERVER['HTTP_HOST'] . $url;
    }


    /**
     * @param $url
     * @return string
     */
    static function Url($url)
    {
        if (0 === strpos($url, '/')) {
            return $url;
        }
        $url = WEB_ROOT . $url;
        return $url;
    }

    /**
     * @param $path
     */
    static function SetAllRoutes($path)
    {
        static::$CurrentControllerPath = static::$CurrentControllerPathWithArgs = $path;
    }

    static function Absolute($path)
    {
        if (Str::StartsWith($path, '/')) {
            $path = substr($path, 1);
        }
        return URL . $path;
    }

}

