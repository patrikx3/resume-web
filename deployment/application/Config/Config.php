<?php
namespace Config;

use P3x\Controller;
use P3x\Helper\Input;
use P3x\Language;
use P3x\Router;

/**
 * Class Config
 * @package Config
 */
class Config
{
    use Input;

    /**
     * @var null
     */
    protected static $themeData = null;

    public static $private = [];

    /**
     * @param array $view_data
     * @return array
     */
    public static function GetConfig($view_data = [])
    {
        $text = Language::GetFilled();

        $icons = Icon::GetConstants();

        list($default_theme, $orignal_themes, $light_themes, $dark_themes, $current_theme, $all_themes, $theme_dark_css, $theme_light_css) = Config::GetThemes();
        unset($text['router']);

        $data = [
            'themes' => [
                'light' => array_merge($light_themes, $orignal_themes),
                'dark' => $dark_themes,
            ],
            'base_url' => WEB_ROOT,
            'base_url_locale' => Language::Url(''),
            'theme' => $current_theme,
            'fps' => 1000 / 30,
            'default_url' => static::GetDefaultRoute(),
            'current_route' => Language::RouteUrl(Router::$CurrentControllerPath),
            'current_route_with_args' => Language::RouteUrl(Router::$CurrentControllerPathWithArgs),
            'response_status' => http_response_code(),
            'analytics' => ANALYTICS,
            'parameter' => [
                'theme' => PARAMETER_THEME,
                'theme-dark' => $theme_dark_css,
                'theme-light' => $theme_light_css
            ],
            'debug' => DEBUG,
            'google_analytics_id' => GOOGLE_ANALYTICS_ID,
            'language' => [
                'current' => Language::$Language,
                'available' => Language::$AvailableLanguages,
                'text' => $text
            ],
            'content-start-id' => 'layout-content-start',
            'page' => [
                'contact' => [
                    'url' => Language::RouteUrl('front/contact')
                ]
            ],
            'icons' => $icons,
            'version' => VERSION_TEXT,
            'project-divider' => PROJECT_DIVIDER,
            'url' => URL,
            'phone' => PHONE,
            'email' => EMAIL
        ];
        if (isset($view_data['run-id'])) {
            $data['start_run_id'] = $view_data['run-id'];
        }
        return $data;
    }


    /**
     * @param bool $reload
     * @return null
     */
    public static function GetThemes($reload = false)
    {
        if (static::$themeData == null || $reload) {

            // region Themes
            $default_theme = 'cosmo';

            $orignal_themes = array();
            $orignal_themes[] = 'bootstrap';

            $light_themes = array();
            $light_themes[] = 'cerulean';
            $light_themes[] = 'cosmo';
            $light_themes[] = 'flaty';
            $light_themes[] = 'journal';
            $light_themes[] = 'lumen';
            $light_themes[] = 'paper';
            $light_themes[] = 'readable';
            $light_themes[] = 'sandstone';
            $light_themes[] = 'simplex';
            $light_themes[] = 'spacelab';
            $light_themes[] = 'united';
            $light_themes[] = 'yeti';

            $dark_themes = array();
            $dark_themes[] = 'cyborg';
            $dark_themes[] = 'darkly';
            $dark_themes[] = 'slate';
            $dark_themes[] = 'superhero';
            $dark_themes[] = 'solar';
            // endregion

            $all_themes = array_merge($orignal_themes, $light_themes, $dark_themes);

            if (isset($_COOKIE[PARAMETER_THEME]) && in_array($_COOKIE[PARAMETER_THEME], $all_themes)) {
                $current_theme = $_COOKIE[PARAMETER_THEME];
            } else {
                $current_theme = $default_theme;
            }


            $theme_dark_css = 'theme-dark';
            $theme_light_css = 'theme-light';

            static::$themeData = [
                $default_theme,
                $orignal_themes,
                $light_themes,
                $dark_themes,
                $current_theme,
                $all_themes,
                $theme_dark_css,
                $theme_light_css
            ];
        }

        return static::$themeData;
    }

    /**
     * @return string
     */
    public static function GetDefaultRoute()
    {
        return 'front/about-me';
    }

    /**
     *
     */
    public static function Define()
    {

        static::$private = json_decode(file_get_contents(ROOT . 'settings.json'), true);

        $web_root = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        if ($web_root != '/') {
            $web_root .= '/';
        }

        define('WEB_ROOT', $web_root);
        $host = $_SERVER['HTTP_HOST'];
        if ($host == 'patrikx3.com') {
            $host = 'www.patrikx3.com';
        }
        define('HOST', $_SERVER['HTTP_HOST']);
        define('URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://') . HOST . '/');

        $debug = $host == 'www.patrikx3.com' ? false: true;
        $debug = isset($_REQUEST['debug']) ? true : $debug;
        $debug = isset($_REQUEST['production']) ? false : $debug;

        if (isset(static::$private['debug']) && static::$private['debug'] === false) {
            $debug = false;
        }

        $debug = php_sapi_name() == 'cli' ? true : $debug;
        define('DEBUG', $debug);

        if (isset($_REQUEST['analytics'])) {
            $analytics = static::RestrictBoolean($_REQUEST['analytics']);
        }  else {
            $analytics = !DEBUG;
        }
        define('ANALYTICS', $analytics);
//define('DEBUG', isset($_REQUEST['debug']) ? true : false);
        define('PHONE', '+36 20 342 8046');
//const DEBUG = true;
        // patrik laszlo email
        define('EMAIL', base64_encode('alabard@gmail.com'));
        define('WEB_TEST_SERVER', $host != 'www.patrikx3.com');
        define('GOOGLE_ANALYTICS_ID', 'UA-102206537-1');
        define('PARAMETER_THEME', 'patrikx3-theme');
        define('PROJECT_DIVIDER', ' | ');
        define('GOOGLE_MAPS_API_KEY', 'AIzaSyAE2nNyRzWTJitMQPRBie2B3GIk4HtLe1I');

        static::Version();
    }

    /**
     *
     */
    static function Version()
    {
        $read_data = function () {
            $data = null;
            if (is_file(VERSION_FILE)) {
                $data = explode(',', file_get_contents(VERSION_FILE));
            }
            if ($data == null) {
                return [
                    null,
                    null
                ];
            }
            $git_commit = $data[0];
            $git_date = $data[1];
            return [
                $git_commit,
                $git_date
            ];
        };


        $git_commit = null;
        $git_date = null;
        list($git_commit, $git_date) = $read_data();

        if (!Controller::IsAjax() && WEB_TEST_SERVER && DEBUG) {
            $output_commit = trim(shell_exec('git rev-list --all --count 2>&1'));
            $output_date = trim(shell_exec('git log -1 --format=%at 2>&1'));
            //if ($git_commit == null || $output_commit !== $git_commit) {
                \P3x\File::EnsurePutContents(VERSION_FILE, $output_commit . ',' . $output_date);
            //}
            list($git_commit, $git_date) = $read_data();
        }

        define('GIT_COMMIT', $git_commit);
        define('GIT_DATE', $git_date);
        define('VERSION', date('Y.n.j', $git_date) . '-' . GIT_COMMIT);
        define('VERSION_TEXT', 'v' . VERSION);
    }
}
