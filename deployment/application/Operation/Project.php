<?php

namespace Operation;

use P3x\Str;
use P3x\Language;
use P3x\Template as tpl;

class Project
{

    private static $employment = null;

    static function Url($era, $index)
    {
        $project_item = static::Get($era, $index);
        $project_index = static::GetIndex($era, $index);
        $url = Language::RouteUrl('front/projects/' . $era . '/' . $project_index . '/' . Str::ToUrl($project_item['project'])) . '#' . $era . '-' . $project_index;
        return $url;
    }

    static function Get($era, $index)
    {
        return Language::Get('projects', 'projects')[$era]['items'][$index];
    }

    static function GetIndex($era, $index)
    {
        return count(Language::Get('projects', 'projects')[$era]['items']) - $index;
    }

    static function EmployerUrl(&$project)
    {
        $employer = isset($project['company']) ? $project['company'] : $project['project'];
        $employer_id = Str::ToUrl($employer);
        return Language::RouteUrl('front/resume/5/employer/') . $employer_id . '#E-' . $employer_id;
    }

    static function GetEmployerId(&$project)
    {
        return Str::ToUrl(static::GetEmployerName($project));
    }

    static function GetEmployerName(&$project)
    {
        $employer = isset($project['company']) ? $project['company'] : $project['project'];
        return $employer;
    }

    static function Employment()
    {
        if (static::$employment == null) {
            $projects = Language::Get('projects', 'projects');

            $employment = [];
            foreach ($projects as $era_key => $era) {
                foreach ($era['items'] as $project_index => $project) {

                    if (isset($project['full']) && $project['full'] === false) {
                        continue;
                    }


                    $employer = static::GetEmployerName($project);

                    if (!isset($employment[$employer])) {
                        $employment[$employer] = [
                            'start' => $project['date-start'],
                            'end' => isset($project['date-end']) ? $project['date-end'] : null,
                            'projects' => []
                        ];
                    } else {
                        if (isset($project['date-start']) && $project['date-start']->getTimestamp() < $employment[$employer]['start']->getTimestamp()) {
                            $employment[$employer]['start'] = $project['date-start'];
                        }
                        if (isset($project['date-end']) && $employment[$employer]['end'] != null && $project['date-end']->getTimestamp() > $employment[$employer]['end']->getTimestamp()) {
                            $employment[$employer]['end'] = $project['date-end'];
                        }
                    }
                    $project = [];
                    $project['era'] = $era_key;
                    $project['index'] = $project_index;
                    $employment[$employer]['projects'][] = $project;
                }
            }

            foreach ($employment as $employer => $employer_info) {
                $end = null;
                if ($employment[$employer]['end'] == null) {
                    $end = new \DateTime();
                    $end->setTime(23, 23, 59);
                } else {
                    $end = $employment[$employer]['end'];
                }
                $employment[$employer]['duration'] = Language::GetDuration($employment[$employer]['start'], $end);
            }
            static::$employment = $employment;
        }
        return static::$employment;
    }

    static function Info(&$data, $key)
    {
        if (!isset($data[$key])) {
            return;
        }
        $value = trim($data[$key]);
        if ($value[strlen($value) - 1] != '.') {
            $value .= '.';
        }
        return $value . '&nbsp;';
    }

    public static function ProjectEra($project_era, $data)
    {
        $output = tpl::GetContent(
            function () use ($project_era, $data) {
                $tooltip_placement = 'top';
                $root_tab = Project::ProjectEraTab();
                $tab_id = $project_era;
                $root_tab_project = $root_tab . '/' . $tab_id;
                $project = Language::Get('projects', 'projects')[$project_era];
                $items = $project['items'];
                $accordion_id = 'accordion-' . $project_era;
                if (count($items) == 0) {
                    echo View::Get('slot/under-construction');
                }
                $root_addon = $project_era . '-';
                ?>
                <div class="panel-group" id="<?= $accordion_id ?>" role="tablist"
                     aria-multiselectable="true"
                     data-accordion-item-url="item/project-era/<?= $project_era ?>">
                    <?php foreach ($items as $key => $project_item) : ?>
                        <?php
                        $id = (count($items) - $key);
                        $accordion_id_name = $root_addon . $id;
                        $tab_id = $accordion_id_name;
                        $tab_id_heading = $tab_id . '-heading';
                        $tab_id_content = $tab_id;
                        $accordion_title = Str::ToUrl($project_item['project']);

                        if (isset($project_item['full']) && $project_item['full'] === false) {
                            continue;
                        }

                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="<?= $tab_id_heading ?>">
                                <div class="panel-title">
                                    <div class="pull-right">
                                        <?php if (isset($project_item['image'])) : ?>
                                            <i class="project-tooltip <?= \Config\Icon::ICON_IMAGE ?>"
                                               data-toggle="tooltip"
                                               data-placement="<?= $tooltip_placement ?>"
                                               title="<?= htmlentities(Language::Get('projects', 'title-image')) ?>"></i>
                                        <?php endif; ?>
                                        <?php if (isset($project_item['youtube'])) : ?>
                                            <i class="project-tooltip <?= \Config\Icon::ICON_YOUTUBE_PLAY ?>"
                                               data-toggle="tooltip"
                                               data-placement="<?= $tooltip_placement ?>"
                                               title="<?= htmlentities(Language::Get('projects', 'title-youtube')) ?>"></i>
                                        <?php endif; ?>
                                        <?php if (isset($project_item['url'])) : ?>
                                            <i class="project-tooltip <?= \Config\Icon::ICON_LINK ?>"
                                               data-toggle="tooltip"
                                               data-placement="<?= $tooltip_placement ?>"
                                               title="<?= htmlentities(Language::Get('projects', 'title-url')) ?>"></i>
                                        <?php endif; ?>
                                        <?php if (isset($project_item['flash'])) : ?>
                                            <i class="project-tooltip <?= \Config\Icon::ICON_FLASH ?>"
                                               data-toggle="tooltip"
                                               data-placement="<?= $tooltip_placement ?>"
                                               title="<?= htmlentities(Language::Get('projects', 'title-flash')) ?>"></i>
                                        <?php endif; ?>
                                        <?php if (!isset($project_item['date-end'])) : ?>
                                            <i class="project-tooltip <?= \Config\Icon::ICON_PROGRESS ?>"
                                               data-toggle="tooltip"
                                               data-placement="<?= $tooltip_placement ?>"
                                               title="<?= htmlentities(Language::Get('projects', 'title-in-progress')) ?>"></i>
                                        <?php endif; ?>
                                    </div>
                                    <a role="button" data-toggle="collapse"
                                       data-parent="#<?= $accordion_id ?>"
                                       href="<?= $root_tab_project . '/' . $id . '/' . $accordion_title ?>#<?= $tab_id_content ?>"
                                       data-base-href="<?= $root_tab ?>"
                                       aria-controls="<?= $tab_id_content ?>">
                                        <?= Html::Country($project_item['country'], $tooltip_placement, 'project-tooltip') ?><?= isset($project_item['company']) ? $project_item['company'] . PROJECT_DIVIDER : '' ?><?= $project_item['project'] ?>
                                    </a>
                                </div>
                            </div>
                            <?php
                            $loaded = $data['tab'] == $project_era && $data['accordion'] == $id;
                            ?>
                            <div id="<?= $tab_id_content ?>"
                                 data-bootstrap-accordion="<?= $accordion_title ?>"
                                 class="panel-collapse collapse <?= $loaded ? 'active in' : '' ?>"
                                 role="tabpanel" aria-labelledby="<?= $tab_id_heading ?>"
                                 data-accordion-loaded="<?= $loaded ? 'true' : 'false' ?>">
                                <?php if ($loaded) echo \Operation\Project::ProjectContent($project_era, $key) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php
            }
        );
        return $output;
    }

    public static function ProjectEraTab()
    {
        $root_tab = Language::RouteUrl('front/projects');
        return $root_tab;
    }

    public static function ProjectContent($era, $index)
    {
        $projects = Language::Get('projects', 'projects');
        $project_item = $projects[$era]['items'][$index];


        $output = '';
        $output .= '<div class="panel-body">';
        $output .= static::ProjectItem(Language::Get('projects', 'title-company'), $project_item, 'project', 'company', $project_item);
        //<?php //= $item(Language::Get('projects', 'title-project'), $project_item, 'project') //? >
        $output .= static::ProjectItem(Language::Get('projects', 'title-location'), $project_item, 'location');
        $output .= static::ProjectItem(
            Language::Get('projects', 'title-date'), $project_item, 'date-start', 'date', [
                Language::Get('projects', 'format-date'),
                $project_item
            ]
        );
        $output .= static::ProjectItem(Language::Get('projects', 'title-role'), $project_item, 'role');
        $output .= static::ProjectItem(Language::Get('projects', 'title-task'), $project_item, 'tasks', 'badge');
        $output .= static::ProjectItem(Language::Get('projects', 'title-task'), $project_item, 'task-normal');
        $output .= static::ProjectItem(Language::Get('projects', 'title-technology'), $project_item, 'technology', 'badge');
        $output .= static::ProjectItem(Language::Get('projects', 'title-summary'), $project_item, 'summary');
        $output .= static::ProjectItem(Language::Get('projects', 'title-url'), $project_item, 'url', 'url');
        $output .= static::ProjectItem(Language::Get('projects', 'title-youtube'), $project_item, 'youtube', 'youtube');
        $output .= static::ProjectItem(Language::Get('projects', 'title-image'), $project_item, 'image', 'image');
        $output .= static::ProjectItem(Language::Get('playground', 'title-flash'), $project_item, 'flash', 'flash');
        $output .= '</div>';
        return $output;
    }

    public static function ProjectItem($title, $data, $item, $type = null, $additional = null)
    {
        if (array_key_exists($item, $data)) {
            return Html::Item(
                $title, $data[$item], $type, $additional
            );
        }
        return '';
    }
}
