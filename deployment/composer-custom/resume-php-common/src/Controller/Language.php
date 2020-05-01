<?php

namespace P3x\Controller;


/**
 * Class Language
 * @package P3x\Controller
 */
class Language
{
    /**
     * @param $area
     */
    public function area($area)
    {
        $data = [];
        $data[$area] = \P3x\Language::GetArea($area);
        \P3x\Controller::SendJson($data);
    }
}
