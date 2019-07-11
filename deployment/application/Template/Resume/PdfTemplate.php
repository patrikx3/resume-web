<?php

namespace Template\Resume;

use P3x\Template\Face;
use P3x\Language as l;

class PdfTemplate extends Face
{
    public function data()
    {
        $education_count = count(l::Get('resume', 'tab-data-education'));
        $employment = \Operation\Project::Employment();
        $data = [
            'email' => base64_decode(EMAIL),
            'css' => [
                'color_header_bg' => '#1C1D21',
                'color_header_font' => 'white',
                'color_footer_bg' => '#1C1D21',
                'color_footer_font' => 'white',
                'color_note' => '#1C1D21',

                'default_color' => 'black',

                'color_title' => '#31353D',
                'color_title_project' => '#31353D',

                'color_link' => '#445878',
                'color_project_item_icon' => '#445878',

                'color_hr' => '#dddddd',
                'color_era' => '#dddddd',

                'border_radius' => '3px',
            ],
            'skill-upper' => count(l::Get('resume', 'tab-data-skills')) - 1,
            'education-upper' => $education_count - 1,
            'employment' => $employment,
            'employment-count' => count($employment),
        ];
        return $data;
    }

}
