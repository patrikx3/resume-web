<?php

namespace P3x\Template;

use P3x\Template as tpl;

/**
 * Class Face
 * @package P3x\Template
 */
class Face
{
    /**
     * @var array|null
     */
    protected $arguments = null;

    /**
     * Face constructor.
     * @param array ...$arguments
     */
    public function __construct(... $arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return array
     */
    public function data()
    {
        return [];
    }

    /**
     * @return array
     */
    public function compile()
    {
        return [];
    }

    /**
     * @param $template
     * @return mixed
     */
    public function render($template)
    {
        $renderer = tpl::Get($template, $this->compile());
        $output = $renderer($this->data());
        return $output;
    }
}
