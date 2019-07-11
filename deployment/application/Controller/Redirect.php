<?php

namespace Controller;

use P3x\File;
use P3x\File\Mime;
use P3x\Language;

class Redirect
{
    public function patrikSwf()
    {
        $playground = Language::Get('playground', 'playground');
        $flashes = $playground[count($playground) - 1]['flash'];
        $file = ROOT . 'public/' . $flashes[count($flashes) - 1][0];
        File::StreamFile($file, Mime::SWF);
    }
}
