<?php

namespace P3x;

/**
 * Class Composer
 * @package P3x
 */
class Composer
{
    /**
     *
     */
    static function DeleteCache()
    {
        if (Application::IsWin()) {
            File::DeleteDirRecursive(getenv('LOCALAPPDATA') . '\\Composer');
        } else {
            File::DeleteDirRecursive(' ~/.composer');
        }
    }
}
