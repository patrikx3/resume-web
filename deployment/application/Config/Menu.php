<?php

namespace Config;


use P3x\Language;

/**
 * Class Menu
 * @package Config
 */
class Menu
{

    /**
     * @return array
     */
    public static function GetMenu()
    {
        $menu = array();

        $default_url = Config::GetDefaultRoute();

        $menu[$default_url] = [
            'text' => Language::Get('layout', 'menu-home'),
            'icon' => Icon::ICON_HOME
        ];
        $menu['front/resume'] = [
            'text' => Language::Get('layout', 'menu-resume'),
            'icon' => Icon::ICON_RESUME
        ];
        $menu['front/projects'] = [
            'text' => Language::Get('layout', 'menu-projects'),
            'icon' => Icon::ICON_PROJECTS
        ];
        $menu['front/playground'] = [
            'text' => Language::Get('layout', 'menu-playground'),
            'icon' => Icon::ICON_PLAYGROUND
        ];
        $menu['front/contact'] = [
            'text' => Language::Get('layout', 'menu-contact'),
            'icon' => Icon::ICON_CONTACT
        ];
        return [
            $default_url,
            $menu
        ];
    }

}
