<?php

use P3x\Language;
use P3x\Router;
use P3x\View;
use Config\Config;
use Config\Icon;
use Config\Menu;
use Operation\Html;

$view_data = $data;
list($default_url, $menu) = Menu::GetMenu();
list($default_theme, $orignal_themes, $light_themes, $dark_themes, $current_theme, $all_themes, $theme_dark_css, $theme_light_css) = config::GetThemes();
$currentLightOrDark = in_array($current_theme, $light_themes) || in_array($current_theme, $orignal_themes) ? $theme_light_css : $theme_dark_css;
$title_name = Html::GetTitleName('layout', 'title');
?>
<!DOCTYPE html>
<html lang="<?= Language::$Language ?>">
<head>
    <base href="<?= Router::Absolute(WEB_ROOT) ?>"/>
    <meta charset="UTF-8">

    <?php foreach (Language::$AvailableLanguages as $language) : ?>
        <link rel="alternate" href="<?= URL . $language ?>" hreflang="<?= $language ?>"/>
    <?php endforeach; ?>

    <link rel="shortcut icon" type="image/x-icon" href="<?= Router::Url('favicon.ico') ?>"/>
    <link rel="apple-touch-icon" href="<?= Router::Url('apple-touch-icon.png') ?>">
    <title>
        {{TITLE}}</title>

    <meta name="google-site-verification" content="pbVywkvDYDmUoP7E8rwbmtetgqjmtR9sW8-eAT5A-rI"/>
    <meta name="yandex-verification" content="3c73d957b813b894"/>
    <meta name="msvalidate.01" content="399AA37B8CB122803932681E0F0EE79D"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
    <meta name="description" content="{{DESCRIPTION}}"/>
    <meta name="author" content="<?= Language::Get('layout', 'author') ?>">

    <script src="https://www.google.com/recaptcha/api.js?onload=lmRecaptcha&render=explicit" async defer></script>

    <?= View::Get('layout/bower') ?>
    <?= View::Get('layout/head', $view_data) ?>

</head>

<body class="<?= $currentLightOrDark ?>">

<header>
    <div id="language-flag-switcher">
        <?php if (Language::$Language == 'en') : ?>
            <a href="<?= Language::RouteUrl(Router::$CurrentControllerPath, 'hu'); ?>"
               onclick="return p3x.Language.Switch('hu', event );">
                <img alt="<?= Language::Get('layout', 'country-hu') ?>" class="language-flag"
                     src="<?= Router::Url('images/language-flag-hungary.png') ?>"/>
            </a>
        <?php else : ?>
            <a href="<?= Language::RouteUrl(Router::$CurrentControllerPath, 'en'); ?>"
               onclick="return p3x.Language.Switch('en', event );">
                <img alt="<?= Language::Get('layout', 'country-us') ?>" class="language-flag"
                     src="<?= Router::Url('images/language-flag-usa.png') ?>"/>
            </a>
        <?php endif ?>
    </div>

    <nav id="layout-top" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button id="navigation-menu-button" type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#navigation" onclick="$(this).toggleClass('change');">
                    <span id="menu-bar-1" class="icon-bar"></span>
                    <span id="menu-bar-2" class="icon-bar"></span>
                    <span id="menu-bar-3" class="icon-bar"></span>
                </button>
                <a class="navbar-brand" p3x-ajax-href="<?= Language::RouteUrl($default_url); ?>"
                   href="<?= Language::RouteUrl($default_url); ?>">
                    <i class="<?= Icon::ICON_LOGO ?> logo-animation" style="opacity: 0.5 !important;"></i>
                    <?= $title_name ?>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="nav navbar-nav">
                    <?php foreach ($menu as $menu_url => $menu_title) : ?>
                        <?php
                        $active = Router::$CurrentControllerPath == $menu_url;
                        $menu_url = Language::RouteUrl($menu_url);
                        ?>
                        <li <?= $active ? 'class="active"' : ''; ?>>
                            <a p3x-ajax-href="<?= $menu_url ?>" href="<?= $menu_url ?>">
                                <?php if (array_key_exists('icon', $menu_title)) : ?>
                                    <span class="<?= $menu_title['icon'] ?>"></span>
                                <?php endif; ?>
                                <?= $menu_title['text'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul id="navigation-theme" class="nav navbar-nav navbar-right"
                    style="margin-right: 32px;">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <span class="<?= Icon::ICON_THEME ?>"></span>
                            <?= Language::Get('layout', 'theme') ?>
                            <i class="fa fa-static patrikx3-caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($orignal_themes as $theme) : ?>
                                <li id="theme-<?= $theme ?>"
                                    class="keep <?= $theme == $current_theme ? 'current-theme active' : '' ?>">
                                    <a href="javascript:lm.SwitchTheme('<?= $theme ?>');"
                                       style="text-transform: capitalize;">
                                        <?= $theme ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li role="separator" class="divider"></li>
                            <?php foreach ($light_themes as $theme) : ?>
                                <li id="theme-<?= $theme ?>"
                                    class="keep <?= $theme == $current_theme ? 'current-theme active' : '' ?>">
                                    <a href="javascript:lm.SwitchTheme('<?= $theme ?>');"
                                       style="text-transform: capitalize;">
                                        <?= $theme ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li role="separator" class="divider"></li>
                            <?php foreach ($dark_themes as $theme) : ?>
                                <li id="theme-<?= $theme ?>"
                                    class="keep <?= $theme == $current_theme ? 'active' : '' ?>">
                                    <a href="javascript:lm.SwitchTheme('<?= $theme ?>');"
                                       style="text-transform: capitalize;">
                                        <?= $theme ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>


<main id="layout-main">
    <!-- {{ADMIN}} -->
    <div id="layout-content">
        <div id="layout-content-start">
            {{CONTENT}}
        </div>
    </div>
</main>

<footer>
    <div style="text-align: center;">
        <?= P3x\Template::Render('slot/social') ?>
    </div>


    <div class="p3x-sponsor fader">
        <? /*= Language::Get('layout', 'sponsored-by');  */ ?> <!-- :
        <br/>
        -->
        <a target="_blank" href="https://www.jetbrains.com/?from=patrikx3"><img
                src="https://cdn.corifeus.com/assets/svg/jetbrains-logo.svg" style="height: 50px; width: auto;"/></a>
        &nbsp;
        <span class="p3x-sponsor-responsive">&nbsp;</span>
        <a target="_blank" href="https://www.jetbrains.com/?from=patrikx3">JetBrains</a>
    </div>

    <br/>

    <div id="layout-bottom" class="label label-default">
        <div>
            <span id="layout-bottom-logo">
                <span class="text-extended"> <i
                        class="<?= Icon::ICON_LOGO ?> logo-animation"></i></span> <?= $title_name ?>
            </span>
            <span class="text-extended"><i class="<?= Icon::ICON_COPYRIGHT ?>"></i> <?= date('Y', GIT_DATE) ?></span>
        </div>
    </div>


    <div class="text-extended transition p3x-info fader">
        <!--
        <span class="p3x-rs-status">
        <? //= Language::Get('layout', 'last-modified') ?>
            : <//?= date(Language::Get('layout', 'date-format'), GIT_DATE) ?>
        </span>
        <span class="p3x-rs-status-divider">|</span>
        -->
        <span class="p3x-rs-status">
            <?= VERSION_TEXT ?>
        </span>
        <span class="p3x-rs-status-divider">|</span>
        <span class="p3x-rs-status">
            <a data-toggle="modal" data-target="#layout-status-modal" p3x-ajax-href="<?= Router::Url('modal/status') ?>"
               href="<?= Router::Url('modal/status') ?>">
                <?= Language::Get('layout', 'web-status') ?>
            </a>
        </span>
    </div>

</footer>

</body>
</html>
