<?php

use P3x\Language;

$l = [];

$pg_en = Language::Get('playground', 'playground', 'en');
$pg = Language::Get('playground', 'playground');
$pg_array = [];
foreach ($pg_en as $key => $pg_en_item) {
    $pg_array[$pg_en_item['id']] = [
        'title' => $pg[$key]['id']
    ];
}

$l['router'] = [
    'front' => [
        'title' => 'ajto',
        'child' => [
            'about-me' => [
                'title' => 'rolam',
            ],
            'resume' => [
                'title' => 'oneletrajz',
                'child' => [
                    'download' => [
                        'title' => 'letoltes'
                    ],
                    'cover' => [
                        'title' => Language::Get('resume', 'tab-cover-id', 'hu')
                    ],
                    'personal' => [
                        'title' => Language::Get('resume', 'tab-personal-id', 'hu')
                    ],
                    'skill' => [
                        'title' => Language::Get('resume', 'tab-skills-id', 'hu')
                    ],
                    'education' => [
                        'title' => Language::Get('resume', 'tab-education-id', 'hu')
                    ],
                    'employer' => [
                        'title' => Language::Get('resume', 'tab-employment-id')
                    ],
                ]
            ],
            'projects' => [
                'title' => 'munkak',
            ],
            'playground' => [
                'title' => 'jatszoter',
                'child' => $pg_array,
            ],
            'contact' => [
                'title' => 'kapcsolat',
            ]
        ]
    ]
];
$l['router-inverse'] = Language::GenerateInverseRoute($l['router']);
