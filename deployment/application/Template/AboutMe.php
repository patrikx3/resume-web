<?php

namespace Template;

use P3x\Template\Face;
use P3x\Language;
use Operation\Html;

class AboutMe extends Face
{
    public function data()
    {
        $slogan1 = '';
        $slogan1 .= Language::Get('about-me', 'slogan-1-1');
        $slogan1 .= ' ' . Language::Get('about-me', 'slogan-1-mix') . ' ';
        $slogan1 .= Html::UpdateSlogan('about-me-slogan-notify', Language::Get('about-me', 'slogan-1-2'));
        $slogan1 .= ' ' . Language::Get('about-me', 'slogan-1-mix') . ' ';
        $slogan1 .= Language::Get('about-me', 'slogan-1-3');

        $slogan2 = '';
        $slogan2 .= Html::UpdateSlogan('about-me-slogan-notify', Language::Get('about-me', 'slogan-2-1'));
        $slogan2 .= ' ' . Language::Get('about-me', 'slogan-2-mix') . ' ';
        $slogan2 .= Language::Get('about-me', 'slogan-2-2');

        $slogans = array(
            $slogan1,
            $slogan2
        );
        shuffle($slogans);
        $welcome = Language::Get('about-me', 'welcome-2');
        $welcome = Html::UpdateSlogan('about-me-welcome-notify', $welcome);

        $data = [
            'slogans' => $slogans,
            'welcome' => $welcome,
            'welcome-1' => Language::Get('about-me', 'welcome-1'),
            'welcome-3' => Language::Get('about-me', 'welcome-3'),
            'content-title' => Language::Get('about-me', 'content-title'),
            'content' => Language::Get('about-me', 'content')
        ];
        $data = array_merge_recursive($data, (new \Template\Slot\DownloadResume(true))->data());
        return $data;
    }

    public function compile()
    {
        return [
            'partials' => [
                'download-resume' => 'slot/download-resume'
            ]
        ];
    }

}
