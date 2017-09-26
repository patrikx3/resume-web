<?php
namespace Operation;

use Config\Config;
use P3x\Http;

class Theme
{
    public static function TrySwitchTheme($theme)
    {
        if (!static::ValidTheme($theme)) {
            return false;
        }
        Http::SetCookie(PARAMETER_THEME, $theme, time() + (86400 * 365));
        Config::GetThemes(true);
        return true;
    }

    public static function ValidTheme($theme)
    {
        list($default_theme, $orignal_themes, $light_themes, $dark_themes, $current_theme, $all_themes) = Config::GetThemes();

        if (in_array($theme, $all_themes)) {
            return true;
        }
        return false;
    }
}