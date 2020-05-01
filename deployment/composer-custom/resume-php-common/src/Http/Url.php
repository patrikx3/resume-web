<?php

namespace P3x\Http;

use P3x\Http;

/**
 * Class Url
 * @package P3x\Http
 */
class Url
{
    /**
     * @param array $parsed
     * @return string
     */
    static function Unparse(array &$parsed)
    {
        $get = function ($key) use ($parsed) {
            return isset($parsed[$key]) ? $parsed[$key] : null;
        };

        $pass = $get('pass');
        $user = $get('user');
        $userinfo = $pass !== null ? "$user:$pass" : $user;
        $port = $get('port');
        $scheme = $get('scheme');
        $query = $get('query');
        $fragment = $get('fragment');
        $authority = ($userinfo !== null ? "$userinfo@" : '') . $get('host') . ($port ? ":$port" : '');

        return (strlen($scheme) ? "$scheme:" : '') . (strlen($authority) ? "//$authority" : '') . $get('path') . (strlen($query) ? "?$query" : '') . (strlen($fragment) ? "#$fragment" : '');
    }

    /**
     * @param $url
     * @return string
     */
    static function FullUrl($url)
    {
        $url = parse_url($url);

        $url['scheme'] = Http::IsSsl() ? 'https' : 'http';
        if (!isset($url['hostname'])) {
            $url['host'] = HOST;
        }
        return static::Unparse($url);
    }


    /**
     * @param $url
     * @param $paramaters
     * @return string
     */
    static function WithoutQueryParameter($url, $paramaters)
    {
        if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {
            parse_str($_SERVER['QUERY_STRING'], $query);

            foreach ($paramaters as $paramater) {
                unset($query[$paramater]);
            }
            $query_string = http_build_query($query);
            if ($query_string != '') {
                $url .= '?' . $query_string;
            }
        }
        return $url;
    }

}
