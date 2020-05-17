<?php

namespace Router\Filter;

use P3x\Http;
use Router\Error;

class Admin implements
    \P3x\Router\Filter
{
    public function filter(&$path, &$routes, $defaultRoute)
    {
        if ($routes[0] == 'admin') {
            if (!Http::IsSsl()) {
                Error::NotSsl();
                return false;
            }
            $code = isset($_REQUEST['code']) ? $_REQUEST['code'] : '';
            if (WEB_TEST_SERVER || $code == 'patrikx3') {
                Http::SetCookie('code', $code);
                return true;
            }
            Error::NotAuthorized();
            return false;
        }
        return true;
    }
}
