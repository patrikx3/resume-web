<?php

namespace Controller;

use Operation\Contact;
use Operation\Resume;
use P3x\Language;
use P3x\Router;
use P3x\View;
use P3x\Http;

class Front extends \Controller
{
    function aboutMe()
    {
        $title = static::GetTitle(Language::Get('layout', 'menu-home'));
        $this->contentTemplate(
            'about-me', [
            'title' => $title,
            'run-id' => 'AboutMe',
            'language-ensure-areas' => ['about-me'],
        ]);
    }

    function swf()
    {
        $arguments = func_get_args();
        $height = array_pop($arguments);
        $width = array_pop($arguments);
        $file = implode('/', $arguments);
        $file = Router::Url($file);
        $data = [
            $file,
            $width,
            $height
        ];
        echo View::Get('slot/swf', $data);
    }

    function resume($downloadOrTab = null, $downloadRaw = false, $accordion = null)
    {
        if ($downloadOrTab == 'download' || $downloadOrTab == 'letoltes') {
            Resume::Execution($downloadOrTab, $downloadRaw);
            return;
        }
        $title = static::GetTitle(Language::Get('layout', 'menu-resume'));
        $this->contentView(
            'resume', [
                'downloadOrTab' => $downloadOrTab,
                'title' => $title,
                'accordion' => $accordion,
                'run-id' => 'Resume',
                'language-ensure-areas' => ['resume'],
                'description' => function () {
                    $projects = Language::Get('resume', 'tab-data-cover');
                    return str_ireplace(
                        [
                            '<br/>',
                            '<br>',
                            "\r\n",
                            "\n",
                            "\r",
                            "\"",
                            "  "
                        ], [
                        '',
                        '',
                        '',
                        '',
                        '',
                        '\'',
                        ''
                    ], $projects
                    );
                }
            ]
        );
    }

    function projects($tab = null, $accordion = null)
    {
        $title = static::GetTitle(Language::Get('layout', 'menu-projects'));
        $this->contentView(
            'projects', [
                'tab' => $tab,
                'accordion' => $accordion,
                'title' => $title,
                'run-id' => 'Projects',
                'language-ensure-areas' => ['projects'],
                'description' => function () {
                    $description = [];
                    $projects = Language::Get('projects', 'projects');
                    foreach ($projects as $era) {
                        foreach ($era['items'] as $project) {
                            if (isset($project['company'])) {
                                $description[$project['company']] = true;
                            }
                            $description[$project['project']] = true;
                        }
                    }
                    return array_keys($description);
                }
            ]
        );
    }

    function playground($accordion = null)
    {
        $title = static::GetTitle(Language::Get('layout', 'menu-playground'));
        $this->contentView(
            'playground', [
                'accordion' => $accordion,
                'title' => $title,
                'run-id' => 'PlayGround',
                'language-ensure-areas' => ['playground'],
                'description-index' => 'title',
                'description' => function () {
                    $playground = Language::Get('playground', 'playground');
                    return $playground;
                }
            ]
        );
    }

    function contact()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = Contact::Execution();
            static::SendJson($result);
            return;
        }
        $title = static::GetTitle(Language::Get('layout', 'menu-contact'));
        $this->contentTemplate(
            'contact', [
            'title' => $title,
            'run-id' => 'Contact',
            'language-ensure-areas' => ['contact'],
        ]);
    }

}
