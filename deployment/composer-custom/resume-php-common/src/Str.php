<?php

namespace P3x;

/**
 * Class Str
 * @package P3x
 */
class Str
{
    /**
     * @param $original
     * @param $replacement
     * @param $position
     * @param $length
     * @return string
     */
    static function MbSubstrReplace($original, $replacement, $position, $length)
    {
        $startString = mb_substr($original, 0, $position, "UTF-8");
        $endString = mb_substr(
            $original, $position + $length, mb_strlen($original), "UTF-8"
        );

        $out = $startString . $replacement . $endString;

        return $out;
    }

    /**
     * @param $url
     * @return string
     */
    static function ToUrl($url)
    {
        $url = static::RemoveAccents($url);
        $url = str_replace('.', '', $url);
        $url = preg_replace("/[^A-Za-z0-9]/", '-', $url);
        $url = preg_replace('/-+/', '-', $url);
        return strtolower($url);
    }


    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    static function StartsWith($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    static function EndsWith($haystack, $needle)
    {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    static function StartsWithInsensitive($haystack, $needle)
    {
        return $needle === "" || strripos($haystack, $needle, -strlen($haystack)) !== false;
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    static function EnsWithInsensitive($haystack, $needle)
    {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && stripos($haystack, $needle, $temp) !== false);
    }

    /**
     * @param $str
     * @param $prefix
     * @return string
     */
    static function StartRemove($str, $prefix)
    {
        if (substr($str, 0, strlen($prefix)) == $prefix) {
            return substr($str, strlen($prefix));
        }
        return $str;
    }


    /**
     * @param $str
     * @return string
     */
    static function RemoveAccents($str)
    {
        $unwanted_array = array(
            'Š' => 'S',
            'š' => 's',
            'Ž' => 'Z',
            'ž' => 'z',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'ü' => 'u'
        );
        $str = strtr($str, $unwanted_array);

        return $str;   // or add this : mb_strtoupper($str); for uppercase :)
    }
}
