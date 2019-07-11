<?php

namespace Operation;

use DOMDocument;
use SimpleXMLElement;
use P3x\Http;
use P3x\File;
use P3x\Language;
use P3x\Router;
use P3x\File\Mime;
use P3x\Http\Url;
use Config\Menu;

class Sitemap
{
    const SCHEMA_IMAGE = 'http://www.google.com/schemas/sitemap-image/1.1';
    const SCHEMA_VIDEO = 'http://www.google.com/schemas/sitemap-video/1.1';

    /**
     * The current sitemap file.
     * @var string
     */
    private $fileName;
    private $urls = [];
    private $uniqueDownload = 0;
    private $dataHtml = [];

    /**
     * Decides if images are supported in the current sitemap.
     * @var bool
     */
    private $supportsImages = false;

    /**
     * Sitemap constructor.
     * If it supports images or not.
     * @param bool $images
     */
    function __construct($images = true)
    {
        $this->supportsImages = $images;
        $this->fileName = ROOT_BUILD . 'sitemap' . (!$images ? '-no-images' : '') . '.xml';
    }

    public function generateCached()
    {
        if (!file_exists($this->fileName) || DEBUG || GIT_DATE >= filemtime($this->fileName)) {
            $start = microtime(true);
            list(, $menu) = Menu::GetMenu();
            foreach ($menu as $url => $menu_data) {
                foreach (Language::$AvailableLanguages as $language) {
                    $this->recursive(Language::RouteUrl($url, $language));
                    /*
                    $route_url = $this->construct_url(Language::RouteUrl($url, $language));
                    $this->urls[$route_url] = [
                        'url' => $route_url
                    ];
                    */
                }
            }

            $xml = new SimpleXMLElement('<urlset/>');
            $xml->addAttribute("xmlns:xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");

            if ($this->supportsImages) {
                $xml->addAttribute("xmlns:xmlns:image", static::SCHEMA_IMAGE);
            }
            //$xml->addAttribute("xmlns:xmlns:video", static::SCHEMA_VIDEO);
            foreach ($this->urls as $url) {
                $xml_url = $xml->addChild('url');
                $this->url($xml_url, $url);
            }
            $end = microtime(true) - $start;
            $xml->addAttribute('time-seconds', $end);
            $xml->addAttribute('date-time', date('Y-m-d H:i:s'));
            $xml->addAttribute('unique-urls', count($this->urls));
            $xml->addAttribute('unique-downloads', $this->uniqueDownload);
            $xml->addAttribute('memory', round(memory_get_peak_usage(true) / 1024, 2) . 'KB');
            $xml->addAttribute('version', VERSION);
            $dom = new DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml->asXML());
            $contents = $dom->saveXML();
            File::EnsurePutContents($this->fileName, $contents);
            return $contents;
        }
        return file_get_contents($this->fileName);
    }

    private function recursive($path, $parent = null /*, $href_base = null*/)
    {
        if (!$this->isLocalUrl($path)) {
            return;
        }
        $url = $this->constructUrl($path);
        if (isset($this->urls[$url])) {
            return;
        }

        $url_data = parse_url($url);
        $path_info = pathinfo($url_data['path']);
        if (isset($path_info['extension'])) {
            $extension = strtolower($path_info['extension']);
            switch ($extension) {
                case 'png':
                case 'jpg':
                case 'jpeg':
                case 'gif':
                    if (isset($this->dataHtml[$parent])) {
                        $this->urls[$parent]['images'][] = $url;
                    }
                    break;

                default:
                    $this->urls[$url] = [
                        'url' => $url,
                    ];
                    break;
            }
            return;
        }
        /*
        if ($href_base == null) {
            $href_base = $url;
        } else {
            $href_base = $this->construct_url($href_base);
        }
        */
        list($html, $header, $content_type) = $this->getHtml($url);

        $this->urls[$url] = [
            'url' => $url,
            'images' => [],
        ];
        if ($content_type != Mime::HTML) {
            return;
        }
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        foreach ($dom->getElementsByTagName('a') as $node) {
            $href_ajax = (string)$node->getAttribute("p3x-ajax-href");
            // this is for old sitemap
            //$href_base = (string)$node->getAttribute("data-base-href");
            $href = (string)$node->getAttribute("href");
            if ($href_ajax != '') {
                $href = $href_ajax;
            }
            $this->recursive($href, $url);
        }
    }

    private function isLocalUrl(&$path)
    {
        $path = trim($path);
        if (0 === stripos($path, 'http')) {
            return false;
        }
        if (0 === stripos($path, 'javascript')) {
            return false;
        }
        return true;
    }

    private function constructUrl($path)
    {
        $path = rtrim(URL, '/') . Router::Url($path);
        $url_data = parse_url($path);
        unset($url_data['fragment']);
        $result = Url::Unparse($url_data);
        return $result;
    }

    private function getHtml($url)
    {
        if (isset($this->dataHtml[$url])) {
            return $this->dataHtml[$url];
        }
        $this->uniqueDownload++;
        $this->dataHtml[$url] = Http::Get($url . '?production&raw');
        return $this->getHtml($url);
    }

    private function url(&$xml_url, &$url)
    {
        $xml_url->addChild('loc', $url['url']);

        if ($this->supportsImages && isset($url['images'])) {
            foreach ($url['images'] as $image_url) {
                $xml_image = $xml_url->addChild('image:image', null, static::SCHEMA_IMAGE);
                $xml_image->addChild('image:loc', $image_url, static::SCHEMA_IMAGE);
            }
        }

        $xml_url->addChild('lastmod', date('Y-m-d', GIT_DATE));
        $xml_url->addChild('changefreq', 'daily');
        $xml_url->addChild('priority', '1.0');
    }

}
