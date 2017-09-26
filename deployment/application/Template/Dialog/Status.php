<?php
namespace Template\Dialog;

use P3x\Template\Face;

class Status extends Face
{
    public function data() {
        $data = [
            'ci' => ['resume-php-common', 'resume-js-common', 'resume-js-bootstrap', 'resume-web' ]
        ];
        return $data;
    }
}