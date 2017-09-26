<?php
namespace Operation;

use P3x\Language;

class PlayGround
{
    public static function ItemFull($index)
    {
        $games = Language::Get('playground', 'playground');
        $game = $games[$index];
        $output = '<div class="panel-body">';
        $output .= static::Item(Language::Get('playground', 'title-summary'), $game, 'summary');
        $output .= static::Item(Language::Get('playground', 'title-url'), $game, 'url', 'url');
        $output .= static::Item(Language::Get('playground', 'title-image'), $game, 'image', 'image');
        $output .= static::Item(Language::Get('playground', 'title-flash'), $game, 'flash', 'flash');
        $output .= '</div>';
        return $output;
    }

    public static function Item($title, $data, $item, $type = null, $additional = null)
    {
        if (array_key_exists($item, $data)) {
            return '<div>' . \Operation\Html::Item(
                $title, $data[$item], $type, $additional
            ) . '</div>';
        }
        return '';
    }
}