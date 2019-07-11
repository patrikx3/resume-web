<?php

namespace Controller;

use P3x\Http;
use P3x\File\Mime;

class Sitemap extends \Controller
{

    public function index()
    {
        $sitemap = new \Operation\Sitemap();
        $content = $sitemap->generateCached();
        Http::HeaderContent(Mime::XML);
        echo $content;
    }

    public function yandex()
    {
        $sitemap = new \Operation\Sitemap(false);
        $content = $sitemap->generateCached();
        Http::HeaderContent(Mime::XML);
        echo $content;

    }

}
