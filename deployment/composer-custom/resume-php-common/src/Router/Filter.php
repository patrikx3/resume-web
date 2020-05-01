<?php

namespace P3x\Router;

/**
 * Interface Filter
 * @package P3x\Router
 */
interface Filter
{
    /**
     * @param $path
     * @param $routes
     * @param $defaultRoute
     * @return mixed
     */
    public function Filter(&$path, &$routes, $defaultRoute);
}
