<?php

namespace P3x\Controller;

use P3x\Http;
use P3x\File\Mime;

/**
 * Class Template
 * @package P3x\Controller
 */
class Template
{
    /**
     * @param array ...$arguments
     */
    public function load(... $arguments)
    {

        Http::HeaderContent(mime::HANDLEBARS);
        $file = implode('/', $arguments);
        $path_parts = pathinfo($file);
        echo \P3x\Template::GetRaw($path_parts['dirname'] . '/' . $path_parts['filename']);
    }
}
