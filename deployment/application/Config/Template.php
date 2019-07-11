<?php

namespace Config;


/**
 * Class Template
 * @package Config
 */
class Template
{
    /**
     *
     */
    static function Define()
    {
        $data = Config::GetConfig();
        \P3x\Template::MergeDefaultData($data);
    }
}
