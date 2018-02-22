<?php
namespace Router;

use P3x\Language;
use P3x\View;

class Error {
    static function NotSsl() {
        header('HTTP/1.0 403 Forbidden');
        $url = \P3x\Router::UrlSsl($_SERVER['REQUEST_URI']);
        $info = \Config\Icon::ICON_INFO;
        $message = <<<EOL
        
<span class="fa-stack fa-lg">
  <i class="fa fa-square fa-stack-2x"></i>
  <i class="{$info} fa-stack-1x fa-inverse"></i>
</span>        
<a href="{$url}">{$url}</a> 
EOL;

        static::Error(Language::Get('layout', 'error-403.4'), \Config\Icon::ICON_403_4, $message);
    }

    static function Error($title, $icon, $message = null)
    {
        $path = $_SERVER['REQUEST_URI'];
        \P3x\Router::SetAllRoutes($path);
        $view = new view('layout/base');
        $view->updateView(
            'errors/default', [
            'title' => $title,
            'icon' => $icon,
            'message' => $message
        ]
        );
        $view->updateContent($title, 'TITLE');
        $view->updateContent($title, 'DESCRIPTION');
        echo $view->render();
    }

    static function NotAuthorized() {
        header('HTTP/1.0 403 Forbidden');
        static::Error(Language::Get('layout', 'error-403'), \Config\Icon::ICON_403);
    }

    static function NotFound()
    {
        $not_found = '404 Not Found';
        header('HTTP/1.0 ' . $not_found);
        static::Error(Language::Get('layout', 'error-404'), \Config\Icon::ICON_404);

        /*
        if (!DEBUG) {
            $data = \P3x\Router::RequestInfo();
            $email = base64_decode(EMAIL);
            $name = Language::Get('layout', 'title');
            $header
                = <<<EOF
From: $name <{$email}>;
MIME-Version: 1.0
Content-Type: text/html; charset=UTF-8
EOF;
            $email = base64_decode(EMAIL);
            \Operation\Mail::Send($email, $email, '404 ERROR | ' . $_SERVER['REQUEST_URI'], $data);
        }
        */
    }

}
