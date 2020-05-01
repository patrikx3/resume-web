<?php

namespace P3x;

/**
 * Class View
 * @package P3x
 */
class View
{
    /**
     *
     */
    const ITEM_PRE = '{{';
    /**
     *
     */
    const ITEM_POST = '}}';
    /**
     * @var bool
     */
    var $layout = false;
    /**
     * @var bool
     */
    var $noLayout = false;
    /**
     * @var bool
     */
    var $layoutName = false;
    /**
     * @var string
     */
    static $ViewRoot = ROOT . 'views/';

    /**
     * View constructor.
     * @param $layout
     */
    public function __construct($layout)
    {
        $this->layoutName = $layout;
    }

    /**
     * @param $no_layout
     * @return $this
     */
    public function disableLayout($no_layout)
    {
        $this->noLayout = $no_layout;
        return $this;
    }

    /**
     * @param $view_name
     * @param string $area
     * @param array $data
     */
    public function updateView($view_name, $area = 'CONTENT', $data = [])
    {
        if (is_array($area)) {
            $data = $area;
            $area = 'CONTENT';
        }
        $view_content = View::Get($view_name, $data);
        $this->updateContent($view_content, $area, $data);
    }

    /**
     * Make sure $data looks empty, but the included uses.
     *
     * @param $view_name
     * @param null|array $data
     * @return string
     */
    public static function Get($view_name, $data = null)
    {
        ob_start();
        include static::$ViewRoot . $view_name . '.php';
        $view = ob_get_contents();
        ob_end_clean();
        $result = $view;
        return $result;
    }

    /**
     * @param $view_content
     * @param string $area
     * @param array $data
     */
    public function updateContent($view_content, $area = 'CONTENT', $data = [])
    {
        if (is_array($area)) {
            $data = $area;
            $area = 'CONTENT';
        }
        if ($this->noLayout) {
            $this->layout = $view_content;
        } else {
            $this->layout = str_replace(
                static::ITEM_PRE . $area . static::ITEM_POST, $view_content, $this->getLayout($data)
            );
        }
    }

    /**
     * @param null $data
     * @return bool|string
     */
    private function getLayout($data = null)
    {
        if ($this->layout === false) {
            $result = View::Get($this->layoutName, $data);
            $this->layout = $result;
        }
        return $this->layout;
    }

    /**
     * @return array|bool|mixed
     */
    public function render()
    {
        if (is_array($this->layout)) {
            return $this->layout;
        }
        return preg_replace('/{{[^}]*}}/', '', $this->layout);
    }

}
