<?php

namespace P3x;

use P3x\File\Mime;
use P3x\Template as tpl;

/**
 * Class Controller
 * @package P3x
 */
class Controller
{
    /**
     *
     */
    const CONTENT_TYPE_VIEW = 'view';
    /**
     *
     */
    const CONTENT_TYPE_STRING = 'content';
    /**
     *
     */
    const CONTENT_TYPE_TEMPLATE = 'template';

    /**
     * @param $data
     * @param int $settings
     * @return string
     */
    static function Json($data, $settings = 0)
    {
        if (DEBUG) {
            $settings |= JSON_PRETTY_PRINT;
        }
        return json_encode($data, $settings);
    }

    /**
     * @param $data
     * @return string
     */
    static function JsonAttribute($data)
    {
        $settings = ENT_QUOTES;
        if (DEBUG) {
            $settings |= JSON_PRETTY_PRINT;
        }
        return htmlspecialchars(json_encode($data, $settings));
    }


    /**
     * @return bool
     */
    static function IsAjax()
    {
        return Http::GetHeader('X-Requested-With') == 'XMLHttpRequest';
    }

    /**
     * @param $data
     */
    static function SendJson($data)
    {
        Http::HeaderContent(mime::JSON);
        echo static::Json($data);
    }

    /**
     * @return bool
     */
    static function IsLayoutDisabled()
    {
        return Controller::IsAjax() || isset($_REQUEST['raw']) ? true : false;
    }


    /**
     * @var View
     */
    protected $renderer;

    /**
     * Controller constructor.
     * @param $layout
     */
    public function __construct($layout)
    {
        $this->renderer = new View($layout);
    }

    /**
     * @param $view
     * @param string $area
     */
    public function view($view, $area = 'CONTENT')
    {
        $this->renderer->updateContent($view, $area);
    }

    /**
     * @param $view
     * @param array $data
     */
    protected function content($view, $data = [])
    {
        $this->contentByType(static::CONTENT_TYPE_STRING, $view, $data);
    }

    /**
     * @param $view
     * @param array $data
     */
    protected function contentTemplate($view, $data = [])
    {
        $this->contentByType(static::CONTENT_TYPE_TEMPLATE, $view, $data);
    }

    /**
     * @param $view
     * @param array $data
     */
    protected function contentView($view, $data = [])
    {
        $this->contentByType(static::CONTENT_TYPE_VIEW, $view, $data);
    }

    /**
     * @param $type
     * @param $content_or_view
     * @param array $data
     */
    protected function contentByType($type, $content_or_view, $data = [])
    {
        $disable_layout = static::IsLayoutDisabled();
        $this->renderer->disableLayout($disable_layout);
        if ($type == static::CONTENT_TYPE_TEMPLATE) {
            $content_or_view = tpl::Render($content_or_view, $disable_layout);
        }
        if ($type == static::CONTENT_TYPE_VIEW) {
            $this->renderer->updateView($content_or_view, 'CONTENT', $data);
        } else {
            $this->renderer->updateContent($content_or_view, 'CONTENT', $data);
        }
    }

    /**
     * @param $type
     * @param $data
     */
    protected function render($type, $data)
    {
        $result = $this->renderer->render();
        if (!isset($_REQUEST['raw']) && static::IsLayoutDisabled()) {
            $json_data = [
                'content' => $result,
                'debug' => DEBUG,
                'type' => $type
            ];
            if (isset($data['dialog'])) {
                $json_data['dialog'] = $data['dialog'];
            }
            if (isset($data['title'])) {
                $json_data['title'] = $data['title'];
            }
            if (isset($data['run-id'])) {
                $json_data['run-id'] = $data['run-id'];
            }
            if (isset($data['language-ensure-areas'])) {
                $language_ensured_areas = [];
                if (Http::GetHeader('P3x-Language-Ensured-Areas') !== false) {
                    $language_ensured_areas = json_decode(Http::GetHeader('P3x-Language-Ensured-Areas'));
                }
                $json_language_data = [];
                foreach ($data['language-ensure-areas'] as $language_check_areas) {
                    if (!in_array($language_check_areas, $language_ensured_areas)) {
                        $json_language_data[$language_check_areas] = Language::GetArea($language_check_areas);
                    }
                }
                if (count($json_language_data) > 0) {
                    $json_data['language-areas'] = $json_language_data;
                }
            }
            if ($json_data['type'] === static::CONTENT_TYPE_TEMPLATE) {
                $template_ensured = [];
                if (Http::GetHeader('P3x-Template-Ensured-Templates') !== false) {
                    $template_ensured = json_decode(Http::GetHeader('P3x-Template-Ensured-Templates'));
                }
                $template_data = [];
                $check_template = function ($what) use (&$template_data, $template_ensured) {
                    if (!in_array($what, $template_ensured)) {
                        $template_data[$what] = tpl::GetRaw($what);
                    }
                };
                $check_template($json_data['content']['template']);
                if (isset($json_data['content']['compile']['partials'])) {
                    foreach ($json_data['content']['compile']['partials'] as $template_name) {
                        $check_template($template_name);
                    }
                }
                if (count($template_data) > 0) {
                    $json_data['templates'] = $template_data;
                }
            }
            static::SendJson($json_data);
            return;
        }
        echo $result;
    }

}
