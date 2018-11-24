<?php
namespace Operation;

use P3x\Language;
use P3x\Router;
use P3x\Str;

class Html
{

    public static function GetTitleName($area, $item)
    {

        $title = Language::Get($area, $item);

        $title = explode(' ', $title);
        $finder = Language::$Language == 'hu' ? 1 : 0;
        $o = '';
        $divider = '';
        foreach ($title as $index => $item) {
            $o .= $divider;
            if ($finder == $index) {
                $o .= '<span class="text-default text-extended-big">';
                $o .= $item;
                $o .= '</span>';
            } else {
                $o .= '<span class="text-extended">';
                $o .= $item;
                $o .= '</span>';
            }
            $divider = ' ';
        }
        return $o;
    }

    public static function UpdateSlogan($class, $value)
    {
        $first = mb_substr($value, 0, 1, "UTF-8");

        $value = Str::MbSubstrReplace(
            $value, '<span class="' . $class . '">' . $first . '</span>', 0, 1
        );
        return $value;
    }

    public static function Item($title, $content, $type, $additional = null)
    {
        $text = '';
        $text .= '<div class="list-group-item listing-item">';
        $text .= '<div class="label label-info " style="float: left;">' . $title . '</div>';
        $text .= '<div class="listing-item-content">';
        switch ($type) {
        case 'flash':
            $comma = '';
            foreach ($content as $flash) {
                $text .= $comma;
                $text .= static::Flash($flash);
                $comma = ', ';
            }
            break;
        case 'image':
            foreach ($content as $image) {
                $text .= static::Image($image);
            }
            break;

            // youtube add ?html5=1
        case 'youtube':
            if (!is_array($content)) {
                $text .= static::YouTube($content);
            } else {
                $comma = '';
                foreach ($content as $url) {
                    $text .= $comma;
                    $text .= static::YouTube($url);
                    $comma = ', ';
                }
            }
            break;

        case 'url':
            if (!is_array($content)) {
                $text .= static::Url($content);
            } else {
                $comma = '';
                foreach ($content as $key => $url) {
                    $text .= $comma;
                    $text .= static::Url($url, $key);
                    $comma = ', ';
                }
            }
            break;

        case 'company':
            if (isset($additional['company'])) {
                $content = $additional['company'];
            }
            $text .= '<a p3x-ajax-href="' . Language::RouteUrl('front/resume') . '" href="' . Project::EmployerUrl($additional) . '">';
            $text .= $content;
            $text .= '</a>';
            break;

        case 'email':
            $text .= static::Email($content);
            break;

        case 'badge':
            $text .= static::Badge($content);
            break;

        case 'date':
            $text .= static::DateMonth($content, $additional);
            break;

        case 'since':
            $text .= static::Since($content);
            break;

        default:
            $text .= $content;
            break;
        }
        $text .= '</div>';
        $text .= '<div style="clear: both; margin-bottom: 2px;"></div>';
        $text .= '</div>';
        return $text;
    }

    public static function Flash($data)
    {
        /**
         * var el = document.getElementById("my-target-element");
         * swfobject.embedSWF("myContent.swf", el, 300, 120, 10);
         **/
        $id = uniqid();
        $o = '';
        $file = WEB_ROOT . $data[0];
        $no_flash = json_encode(Language::Get('layout', 'flash-no'));
        $o
            .= <<<EOF
<div id="swf-container-{$id}" style="position: absolute; display: none; color: white;">
</div>
<script>
    function swf{$id}() {
        setTimeout(function() {
            var no_flash = {$no_flash}; 
            var id = 'swf-container-{$id}';
            
            if (p3x.Mobile.Any()) {
              $('.lity-close').trigger('click');
              p3x.Growl(no_flash);
            }
         
            var lity = $('.lity-content');
            lity.prop('id', 'swf-' + id);                    
            var parent = lity.parent();                    
            parent.css('width',  {$data[1]});
            parent.css('height',  {$data[2]});
            lity.css('width',  {$data[1]});
            lity.css('height',  {$data[2]});                    
            var lityiframeContainer = $('.lity-iframe-container');
            lityiframeContainer.css('width',  {$data[1]} );
            lityiframeContainer.css('height',  {$data[2]} );                    
            lityiframeContainer.css('overflow', 'hidden');                    

            
            /*
            
            var el = document.getElementById(id);
            if (swfobject.hasFlashPlayerVersion("10")) {
                    var add = $('<div/>');
                    add.prop('id', 'swf-' +id);
                    var lity = $('.lity-content');
                    lity.prop('id', 'swf-' + id);                    
                    var parent = lity.parent();                    
                    parent.css('width',  {$data[1]});
                    parent.css('height',  {$data[2]});
                    
                    swfobject.embedSWF("{$file}", lity.get(0), {$data[1]}, {$data[2]}, 10, null, null, {
                        'scale' : 'default',
                        'wmode' : 'gpu',
                        'browserzoom' : 'scale',
                        'quality': 'best'
                    });
            }
            else {
              //  $('.lity-close').trigger('click');
              //  p3x.Growl(no_flash);
            } 
            */       
        }, 250);
        return false;
    };
</script>

EOF;
        $url = static::FlashUrl($data);

        $o .= '<a data-lity href="' . $url . '#swf-container-' . $id . '" onclick="return swf' . $id . '();">' . basename(
                $data[0], '.swf'
            ) . '</a>';
        return $o;
    }

    public static function FlashUrl(&$flash)
    {
        return Language::RouteUrl('front/swf/' . $flash[0] . '/' . $flash[1] . '/' . $flash[2]);
    }

    public static function Image($image)
    {
        $url = Router::Url($image);
        $o = '';
        $o .= '<div class="image"><a href="' . $url . '" class="thumbnail"><img alt="' . $image . '" data-lity src="' . $url . '"/></a></div>';
        return $o;
    }

    public static function YouTube($url)
    {
        return '<a data-lity="" href="' . $url . '">' . $url . '</a>';
    }

    public static function Url($data, $text = null)
    {
        if (is_numeric($text) || $text == null) {
            $text = $data;
        }
        return '<a target="_blank" href="' . $data . '">' . $text . '</a>';
    }

    public static function Email($data, $id = null, $href = false)
    {
        $output = '';
        if ($id == null) {
            $id = uniqid();
            $output .= "<div id=\"{$id}\"></div>";
        }

        $output .= "<script>\n";
        $output .= "(function() {\n";
        $output .= "var email = \"{$data}\";\n";
        $output .= "email = atob(email);\n";

        if (!$href) {
            $output .= "var content = '<' +'a' + ' ' + 'h' + 'r' + 'e' + 'f' + '=' + 'm' + 'a' + 'i' + 'l' + 't' + 'o' + ':' + email + '>' + email + '<' + '/' + 'a' + '>';\n";
            $output .= "document.getElementById('{$id}').innerHTML = content;\n";
        } else {
            $output .= "document.getElementById('{$id}').href = 'm' + 'a' + 'i' + 'l' + 't' + 'o' + ':' + email;\n";
        }
        $output .= "})();\n";
        $output .= "</script>\n";
        return $output;
    }

    public static function Badge($data)
    {
        $text = '';
        $lines = explode("\n", $data);
        $first = true;
        foreach ($lines as $line) {
            if (trim($line) == '') {
                continue;
            }
            if (!$first) {
                $text .= '<div style="margin-top: 30px;">';
            } else {
                $text .= '<div style="margin-top: 0px;">';
            }
            $badges = explode(',', $line);
            $line_first = true;
            foreach ($badges as $badge) {
                if (!$line_first) {
                    $text .= ' ';
                }
                $line_first = false;
                $text .= '<span class="label label-default label-badge">' . $badge . '</span> &nbsp; ';
            }
            $text .= '</div>';
            $first = false;
        }
        return $text;
    }

    public static function DateMonth($date, $additional)
    {
        $result = '';

        $result .= '<div class="label label-default" style="float: right;">' . Language::GetDuration($date, isset($additional[1]['date-end']) ? $additional[1]['date-end'] : new \DateTime()) . '</div>';

        $result .= '<br/>';

        $result .= '<div style="float: right">';

        $result .= $date->format($additional[0]);

        $result .= ' - ';
        if (isset($additional[1]['date-end'])) {
            $result .= $additional[1]['date-end']->format($additional[0]);
        } else {
            $result .= '<i class="' . \config\Icon::ICON_PROGRESS . '"></i>';
        }

        $result .= '</div>';

        return $result;
    }

    public static function Since($content)
    {
        $o = '';
        $o .= '<div style="float: right;">';
        $o .= sprintf(Language::Get('resume', 'data-since'), $content);
        $o .= '</div>';

        $start = new \DateTime($content . '-01-01 00:00:00');
        $end = new \DateTime();
        $duration = Language::GetDuration($start, $end);

        $o .= '<br/><div style="float: right;" class="label label-default">';
        $o .= '<i class="' . \Config\Icon::ICON_PROGRESS . '"></i>&nbsp;' . $duration;
        $o .= '</div>';
        return $o;
    }

    public static function Country($country, $tooltip_placement, $class)
    {
        if (!isset($country)) {
            return '';
        }
        $o = '';

        $o .= '<span class="country-icon ' . $class . '" style="background-repeat: no-repeat; background-position: center; display: inline-block; width: 16px; height: 11px; vertical-align:middle; margin-bottom: 4px; margin-right: 5px; background-image: url(\'' . WEB_ROOT . 'images/famfamfam-flag-icons/' . $country . '.gif\');" data-toggle="tooltip" data-placement="' . $tooltip_placement . '" title="' . language::get('layout', 'country-' . $country) . '">';
        $o .= '</span>';
        return $o;
    }

    public static function Description($info, $index = null)
    {
        if (!is_array($info)) {
            $info = [$info];
        }
        $description = [];
        foreach ($info as $data) {
            if ($index != null) {
                $data = $data[$index];
            }
            $description[] = str_replace(
                [
                    "\r\n",
                    "\n",
                    "\r",
                    "\""
                ], [
                ' ',
                ' ',
                ' ',
                "'"
            ], $data
            );
        }
        $description = implode(', ', $description);
        return $description;
    }
}