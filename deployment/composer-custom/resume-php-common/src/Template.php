<?php

namespace P3x;


use \LightnCandy\LightnCandy;
use P3x\Template\Face;

/**
 * Class Template
 * @package P3x
 */
class Template
{
    /**
     * @var string
     */
    static $TemplateNamespace = '\\Template\\';

    /**
     * @var string
     */
    static $TemplateRoot = ROOT . 'templates/';
    /**
     * @var string
     */
    static $TemplatedCompiled = ROOT_BUILD . 'template-compiled-php/';
    /**
     * @var array
     */
    static $Templates = [];
    /**
     * @var array
     */
    static $TemplatesRow = [];

    /**
     * @var array
     */
    static $DefaultData = [];

    /**
     * @var array
     */
    static $DefaultCompile = [];

    /**
     *
     */
    public static function Boot()
    {
        static::$DefaultCompile = [
            'flags' => LightnCandy::FLAG_ELSE | LightnCandy::FLAG_HANDLEBARS | LightnCandy::FLAG_ERROR_EXCEPTION,
            'helpers' => [
                'p3x-language' => function ($area, $item) {
                    return \P3x\Language::Get($area, $item);
                },
                'p3x-icon-unicode' => function ($value) {
                    return new \LightnCandy\SafeString(
                        \P3x\Template\Icon::Unicode($value)
                    );
                },
                'p3x-base64-decode' => function ($value) {
                    return new \LightnCandy\SafeString(
                        base64_decode($value)
                    );
                },
                'p3x-date' => function ($format, $date = null, $options = null) {
                    return date($format, $options == null ? time() : floor($date / 1000));
                },
                'p3x-route-url' => function ($url) {
                    return \P3x\Router::Url($url);
                },
                'p3x-sprintf' => function ($spec, ... $arguments) {
                    array_pop($arguments);
                    return vsprintf($spec, $arguments);
                },
                'p3x-expr' => function ($v1, $op, $v2) {
                    switch ($op) {
                        case '=':
                        case '==':
                            return $v1 == $v2;

                        case '!=':
                        case '<>':
                            return $v1 != $v2;

                        case '<':
                            return $v1 < $v2;

                        case '>':
                            return $v1 > $v2;

                        case '<=':
                            return $v1 <= $v2;

                        case '>=':
                            return $v1 >= $v2;

                        case '&&':
                        case 'and':
                            return $v1 && $v2;

                        case '||':
                        case 'or':
                            return $v1 || $v2;

                        case '+':
                            return (float)$v1 + (float)$v2;

                        case '-':
                            return (float)$v1 - (float)$v2;

                        case '*':
                            return (float)$v1 * (float)$v2;

                        case '/':
                            return (float)$v1 / (float)$v2;

                        case '%':
                            return (float)$v1 % (float)$v2;

                        default:
                            throw new Exception(sprintf('Unknown p3x-expr operand: %s', $op));
                    }
                },
                'p3x-count' => function ($arr) {
                    return count($arr);
                },
                'p3x-string-id' => function ($string) {
                    return \P3x\Str::ToUrl($string);
                },
                'p3x-replace' => function ($str, $find, $replace) {
                    return str_replace($find, $replace, $str);
                },
                'p3x-json' => function ($context) {
                    return json_encode($context);
                }
            ],
            'partials' => []
        ];
    }

    /**
     * @param $data
     */
    public static function MergeDefaultData($data)
    {
        static::$DefaultData = array_merge_recursive(static::$DefaultData, $data);
    }

    /**
     * @param $compile
     */
    public static function MergeDefaultCompile($compile)
    {
        static::$DefaultCompile = array_merge_recursive(static::$DefaultCompile, $compile);
    }

    /**
     * @param $renderer
     * @return \Closure
     */
    private static function GenerateRenderer(&$renderer)
    {
        return function ($data = []) use (&$renderer) {
            $data['p3x-default'] = static::$DefaultData;
            return $renderer($data);
        };
    }

    /**
     * @param $template_name
     * @return string
     */
    public static function GetTemplateFile($template_name)
    {
        return static::$TemplateRoot . $template_name . '.hbs';
    }

    /**
     * @param $template_name
     * @return mixed
     */
    public static function GetRaw($template_name)
    {
        if (isset(static::$TemplatesRow[$template_name])) {
            return static::$TemplatesRow[$template_name];
        }
        static::$TemplatesRow[$template_name] = file_get_contents(
            static::GetTemplateFile($template_name)
        );
        return static::$TemplatesRow[$template_name];
    }

    /**
     * @param $template_name
     * @param array $compile
     * @return mixed
     * @throws \Exception
     */
    public static function Get($template_name, $compile = [])
    {
        if (isset(static::$Templates[$template_name])) {
//            debug::send('used ' . $template_name);
            return static::$Templates[$template_name];
        }
//        debug::send('new ' . $template_name);
        $template_file = static::GetTemplateFile($template_name);
        $template_file_time = filemtime($template_file);
        $compiled_file = static::$TemplatedCompiled . $template_name . '.php';
        if (!DEBUG && is_file($compiled_file)) {
            $compiled_file_time = filemtime($compiled_file);
            if ($template_file_time == $compiled_file_time) {
//                debug::send('new compiled ' . $template_name);
                $renderer = include_once $compiled_file;
                static::$Templates[$template_name] = static::GenerateRenderer($renderer);
                return static::$Templates[$template_name];
            }
        }
//        debug::send('new generate compiled ' . $template_name);
        $template = static::GetRaw($template_name);

        $compile = array_merge_recursive(static::$DefaultCompile, $compile);
        foreach ($compile['partials'] as $partial_key => $partial_template) {
            $compile['partials'][$partial_key] = file_get_contents(static::GetTemplateFile($partial_template));
        }

        $phpStr = LightnCandy::compile($template, $compile);
        if ($phpStr === false) {
            throw new \Exception(sprintf('Invalid template: %s', $template_name));
        }
        $renderer = eval($phpStr);
        File::EnsurePutContents($compiled_file, '<?php ' . $phpStr);
        touch($compiled_file, $template_file_time);
//        $renderer = include($compiled_file);
        static::$Templates[$template_name] = static::GenerateRenderer($renderer);
        return static::$Templates[$template_name];
    }

    /**
     * @param $view_class
     * @param bool $disable_layout
     * @param array ...$arguments
     * @return array|mixed
     */
    public static function Render($view_class, $disable_layout = false, ... $arguments)
    {
        $view_class_sanitized = str_replace(['/', '-'], ['\\', '_'], $view_class);
        $view_class_actual = Router::RouteToClass($view_class_sanitized);
        $hb_class = static::$TemplateNamespace . $view_class_actual;

        if (class_exists($hb_class)) {
            $hb_object = new $hb_class(...$arguments);
        } else {
            $hb_object = new Face(... $arguments);
        }
        if ($disable_layout) {
            return [
                'template' => $view_class,
                'data' => $hb_object->data(),
                'compile' => $hb_object->compile()
            ];
        }
        $content = $hb_object->render($view_class);
        return $content;
    }

    /**
     * @param $function
     * @param array ...$arguments
     * @return string
     */
    public static function GetContent($function, ...$arguments)
    {
        ob_start();
        $function($arguments);
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }
}
