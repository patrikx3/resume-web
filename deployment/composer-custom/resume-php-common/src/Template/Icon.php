<?php

namespace P3x\Template;

/**
 * Class Icon
 * @package P3x\Template
 */
class Icon
{
    /**
     * @param $value
     * @return string
     */
    public static function Unicode($value)
    {
        return '&#x' . $value . ';';
    }
}
