<?php

namespace P3x;

/**
 * Class Http
 * @package P3x
 */
class Http
{
    /**
     * @var array
     */
    static $Headers = [];

    /**
     * @param null $item
     * @return array|bool|mixed
     */
    public static function GetHeader($item = null)
    {
        if (static::$Headers == null) {
            static::$Headers = getallheaders();
        }
        if ($item == null) {
            return static::$Headers;
        }
        if (!isset(static::$Headers[$item])) {
            return false;
        }
        return static::$Headers[$item];
    }

    /**
     * @param $mime
     */
    static function HeaderContent($mime)
    {
        header('Content-Type: ' . $mime);
    }

    /**
     * @return string
     */
    static function GetClientIp()
    {
        $ip = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
        return $ip;
    }

    /**
     *
     */
    static function NoCache()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    /**
     * @param $parameter
     * @param $value
     * @param int $time
     * @param null $path
     * @param null $domain
     * @param null $secure
     * @param null $httponly
     */
    static function SetCookie($parameter, $value, $time = 0, $path = null, $domain = null, $secure = null, $httponly = null)
    {
        if ($path == null) {
            $path = WEB_ROOT;
        }
        $_COOKIE[$parameter] = $value;
        setcookie($parameter, $value, $time, $path, $domain, $secure, $httponly);
    }

    /**
     * @param null $modified
     */
    static function GenerateLastModified($modified = null)
    {
        if ($modified == null) {
            $modified = time();
        }
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $modified) . ' GMT', true, 200);
    }

    /**
     * @param $time
     * @return bool
     */
    static function LastModifiedSent($time)
    {
        // Getting headers sent by the client.
        $headers = static::GetHeader();

        // Checking if the client is validating his cache and if it is current.
        if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) >= $time)) {
            // Client's cache IS current, so we just respond '304 Not Modified'.
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $time) . ' GMT', true, 304);
            return true;
        }
        return false;
    }

    /**
     * @param $url
     * @param int $timeout
     * @return array
     */
    static function Get($url, $timeout = 5)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $response = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        $headers = static::GetHeadersFromCurlResponse($header);
        $content_type = static::GetHeaderContent($headers);
        curl_close($ch);
        return [
            $body,
            $headers,
            $content_type
        ];
    }

    /**
     * @param $response
     * @return array
     */
    static function GetHeadersFromCurlResponse($response)
    {
        $headers = array();
        $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
        foreach (explode("\r\n", $header_text) as $i => $line) {
            if ($i === 0) {
                $headers['http_code'] = $line;
            } else {
                list ($key, $value) = explode(': ', $line);

                $headers[$key] = $value;
            }
        }
        return $headers;
    }

    /**
     * @param $headers
     * @return null
     */
    static function GetHeaderContent(&$headers)
    {
        if (!isset($headers['Content-Type'])) {
            return null;
        }
        $value = $headers['Content-Type'];
        $values = explode(';', $value);
        return $values[0];
    }

    /**
     * @return bool
     */
    static function IsSsl()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            return true;
        }
        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            return true;
        }
        return false;
    }
}

?>
