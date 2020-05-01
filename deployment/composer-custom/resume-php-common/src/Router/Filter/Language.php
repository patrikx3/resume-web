<?php

namespace P3x\Router\Filter;

use P3x\Language as lang;
use P3x\Router;
use P3x\Router\Filter;
use P3x\Http\Url;

/**
 * Class Language
 * @package P3x\Router\Filter
 */
class Language implements Filter
{
    /**
     * @param $path
     * @param $routes
     * @param $defaultRoute
     * @return bool
     */
    public function filter(&$path, &$routes, $defaultRoute)
    {
        $triedTrySwitch = lang::TrySwitchLanguage($routes[0]);

        if (isset($_GET[PARAMETER_LANGUAGE_SWITCH]) && !empty($_GET[PARAMETER_LANGUAGE_SWITCH])) {
            $routes = lang::RouteUrlInverse($routes);

            lang::TrySwitchLanguage($_GET[PARAMETER_LANGUAGE_SWITCH]);
            if (lang::ValidLanguage($routes[0])) {
                array_shift($routes);
            }
            if (count($routes) == 0) {
                $routes[] = Router::PathToRoute($defaultRoute);;
            }
            $route_new_language = lang::RouteUrl(implode('/', $routes));
            $route_new_language = Router::RemoveWebroot($route_new_language);
            $route_new_language = explode('/', $route_new_language);
            array_shift($route_new_language);
            $generate_arguments = $route_new_language;
            $redirect_url = lang::RouteUrl(implode('/', $generate_arguments));
            $redirect_url = Url::WithoutQueryParameter($redirect_url, [
                PARAMETER_LANGUAGE_SWITCH
            ]);
            Router::Redirect($redirect_url);
            return false;
        } elseif ($triedTrySwitch) {
            array_shift($routes);
            if (count($routes) == 0) {
                $routes[] = Router::PathToRoute($defaultRoute);;
            }
            $routes = lang::RouteUrlInverse($routes);
        }
        return true;
    }
}
