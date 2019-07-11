<?php

namespace Cli;

use P3x\Debug;

/**
 * Class Helper
 * @package Cli
 */
class Helper
{
    /**
     * @param $source
     * @param $dest
     */
    static function Copy($source, $dest)
    {
        Debug::Send(sprintf(
            'copy: %s, to: %s',
            $source,
            $dest
        ));
        copy($source, $dest);
    }
}
