<?php

namespace Template;

use P3x\Template\Face;

class Contact extends Face
{
    public function data()
    {
        $data = (new \Template\Slot\DownloadResume(false))->data();
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
