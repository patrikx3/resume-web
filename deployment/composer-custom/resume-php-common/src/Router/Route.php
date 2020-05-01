<?php

namespace P3x\Router;

/**
 * Class Route
 * @package P3x\Router
 */
class Route
{
    /**
     * @var array
     */
    static $Routes = [];

    /**
     * @var array
     */
    static $Filters
        = [
            // needs to be the first
            '\\P3x\\Router\\Filter\\Language',
        ];

    /**
     * @var string
     */
    static $ControllerNamespace = '\\Controller';
}
