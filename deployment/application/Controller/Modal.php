<?php

namespace Controller;

use P3x\Language;

class Modal extends \Controller
{
    function status()
    {
        $title = static::GetTitle(Language::Get('layout', 'web-status'));
        $this->contentTemplate(
            'dialog/status', [
            'dialog' => 'layout-status-modal',
            'title' => $title,
            'language-ensure-areas' => ['layout'],
        ]);
    }
}
