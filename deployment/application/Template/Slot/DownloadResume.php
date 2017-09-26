<?php
namespace Template\Slot;

use P3x\Template\Face;

class DownloadResume extends Face
{
    public function data() {

        return [
            'download-resume' => [
                'url' => \Operation\Resume::ResumeDownloadUrl(),
                'secondary' => isset($this->arguments[0]) ? $this->arguments[0] : false,
            ]
        ];
    }

}