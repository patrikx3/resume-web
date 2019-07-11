<?php

namespace Controller;

use P3x\Language;
use P3x\Str;

class Item extends \Controller
{
    public function playground($id)
    {
        $games = Language::Get('playground', 'playground');
        $id = count($games) - $id;

        $data = [
            'content' => \Operation\PlayGround::ItemFull($id)
        ];
        static::SendJson($data);
    }

    public function project($era)
    {
        static::SendJson(
            [
                'content' => \Operation\Project::ProjectEra(
                    $era, [
                        'tab' => $era,
                        'accordion' => ''
                    ]
                )
            ]
        );
    }

    public function projectEra($era, $id)
    {
        $projects = Language::Get('projects', 'projects');
        $project_items = $projects[$era]['items'];
        $id = count($project_items) - $id;
        $data = [
            'content' => \Operation\Project::ProjectContent($era, $id)
        ];
        static::SendJson($data);
    }

    public function employment($id)
    {
        $employment = \Operation\Project::Employment();
        foreach ($employment as $employer_name => $value) {
            $employer_key = Str::ToUrl($employer_name);
            if ($employer_key == $id) {
                break;
            }
        }

        $data = [
            'content' => \Operation\Resume::ItemEmployment($employer_name)
        ];
        static::SendJson($data);
    }

    public function resume($id)
    {
        $data = [];
        switch ($id) {
            case 1:
                $data['content'] = \Operation\Resume::Cover();
                break;
            case 2:
                $data['content'] = \Operation\Resume::Personal();
                break;
            case 3:
                $data['content'] = \Operation\Resume::Skills();
                break;
            case 4:
                $data['content'] = \Operation\Resume::Education();
                break;
            case 5:
                $data['content'] = \Operation\Resume::Employment();
                break;
        }
        static::SendJson($data);
    }
}
