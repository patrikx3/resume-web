<?php
namespace Router\Filter;

use P3x\Http\Url;
use P3x\Language as lang;
use P3x\Router;

/**
 * Class Theme
 * @package Router\Filter
 * @deprecated It is using JavaScript now.
 */
class Theme implements
    \P3x\Router\Filter
{
    /**
     * @param $path
     * @param $route
     * @param $defaultRoute
     * @return bool
     */
    public function filter(&$path, &$route, $defaultRoute)
    {
        if (isset($_GET[PARAMETER_THEME]) && !empty($_GET[PARAMETER_THEME])) {
            \Operation\Theme::TrySwitchTheme($_GET[PARAMETER_THEME]);
            $redirect_url = lang::RouteUrl(implode('/', $route));
            $redirect_url = Url::WithoutQueryParameter($redirect_url, [
                PARAMETER_THEME
            ]);
            Router::Redirect($redirect_url);
            return false;
        }
        return true;
    }
}
