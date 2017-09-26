<?php
use Operation\html;
use P3x\language;

class Controller extends \P3x\Controller
{
    public function __construct()
    {
        parent::__construct('layout/base');
    }

    static function GetTitle($title = null)
    {
        $root = language::get('layout', 'title');
        if ($title == null) {
            return $root;
        }
        return $title . ' - ' . $root;
    }

    protected function contentByType($type, $content_or_view, $data = [])
    {
        parent::contentByType($type, $content_or_view, $data);
        if (!static::IsLayoutDisabled()) {
            if (!isset($data['title'])) {
                $data['title'] = static::GetTitle();
            }
            $this->renderer->updateContent($data['title'], 'TITLE', $data);
            if (!isset($data['description'])) {
                $description = Html::Description(Language::Get('resume', 'tab-data-skills'), 'content');
            } else {
                $description_index = null;
                if (isset($data['description-index'])) {
                    $description_index = $data['description-index'];
                }
                $description = Html::Description($data['description'](), $description_index);
            }
            $this->renderer->updateContent($data['title'] . ', ' . $description, 'DESCRIPTION', $data);
        }
        echo $this->render($type, $data);
    }

}