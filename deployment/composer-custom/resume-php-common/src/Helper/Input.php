<?php

namespace P3x\Helper;

/**
 * Class Input
 * @package P3x\Helper
 */
trait Input
{
    /**
     * @param $boolean
     * @return bool
     */
    public static function RestrictBoolean($boolean)
    {
        if ($boolean === true || $boolean === false) {
            return $boolean;
        }
        if (is_numeric($boolean) && abs($boolean) > 0) {
            return true;
        }
        switch (strtolower($boolean)) {
            case 'yes':
            case 'igaz':
            case 'igen':
            case 'true':
                $boolean = true;
                break;

            default:
                $boolean = false;
                break;
        }
        return $boolean;
    }
}
