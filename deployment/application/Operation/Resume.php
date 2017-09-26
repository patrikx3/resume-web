<?php
namespace Operation;

use Config\Icon;
use Config\Route;
use P3x\Analytics;
use P3x\File;
use P3x\File\Mime;
use P3x\Language;
use P3x\Str;
use P3x\View;
use P3x\Template;

class Resume
{
    public static function ResumeDownloadUrl()
    {
        $filename = static::ResumeFilename();
        $download_url = Language::RouteUrl('front/resume/download/' . $filename);
        if (DEBUG) {
            $download_url .= '?debug';
        }
        return $download_url;
    }

    public static function ResumeFilename()
    {
        $filename = str_replace(' ', '-', Language::Get('layout', 'title') . '-' . Language::Get('layout', 'language-current') . '-' . Language::Get('resume', 'title') . '.pdf');

        $filename = Str::RemoveAccents($filename);
        return $filename;
    }

    public static function Execution()
    {
        Analytics::Track();

        if (HOST == 'www.patrikx3.com' || HOST == 'patrikx3.com' || isset($_REQUEST['old'])) {
            $template = View::Get('resume/pdf-template');
        } else {
            $template = Template::Render('resume/pdf-template');
        }

        if (isset($_REQUEST['raw'])) {
            echo $template;
            return;
        }

        $filename = static::ResumeFilename();

//        $actual_dir = ROOT . 'public/files/resume/';
        $actual_dir = ROOT_BUILD . 'resume/';
        $actual_file = $actual_dir . $filename;
        $redirect = WEB_ROOT . 'files/resume/' . $filename;

        $send = function() use ($actual_file, $redirect) {
            File::StreamFile($actual_file, mime::PDF);
//            \P3x\Router::Redirect($redirect );
        };

        File::EnsureDirectory($actual_dir);
        if (is_file($actual_file)) {
            $actual_file_file = filemtime($actual_file);
            $root_mod = GIT_DATE;
//            echo 'All change: ' . date('r', $root_mod) . '<br/>';
//            echo 'File: ' . date('r', $actual_file_file) . '<br/>';
            if (!DEBUG && $root_mod <= $actual_file_file) {
                $send();
                return;
            }
        }
        unset($_SERVER['HTTPS']);
        $letter = Language::$Language == 'hu' ? 'A4' : 'LETTER';
        // ($mode = '', $format = 'A4', $default_font_size = 0, $default_font = '', $mgl = 15, $mgr = 15, $mgt = 16, $mgb = 16, $mgh = 9, $mgf = 9, $orientation = 'P')
        error_reporting(E_ERROR | E_PARSE);
        $mpdf = new \mPDF('utf-8', $letter, '', '', '10', '10', '22', '16');
        $mpdf->showImageErrors = true;
        $mpdf->WriteHTML($template);
        $mpdf->Output($actual_file, 'F');
        $send();
        return;
    }

    public static function Cover()
    {
        $output = Template::GetContent(
            function () {
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="resume-profile-picture">
                            &nbsp;</div>
                        <?= Language::Get('resume', 'tab-data-cover') ?>
                    </div>
                    <div class="panel-footer"></div>
                </div>
                <?php
            }
        );
        return $output;
    }

    public static function Personal()
    {
        $output = Template::GetContent(
            function () {
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php foreach (Language::Get('resume', 'tab-data-personal') as $data) : ?>
                            <?= Html::Item($data['field'], $data['content'], array_key_exists('type', $data) ? $data['type'] : null) ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="panel-footer"></div>
                </div>
                <?php
            }
        );
        return $output;
    }

    public static function Skills()
    {
        $output = Template::GetContent(
            function () {
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="clear: both;"></div>
                        <?php foreach (
                            Language::Get('resume', 'tab-data-skills') as $data
                        ) : ?>
                            <?= Html::Item($data['field'], $data['content'], array_key_exists('type', $data) ? $data['type'] : null) ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="panel-footer"></div>
                </div>
                <?php
            }
        );
        return $output;
    }

    public static function Education()
    {
        $output = Template::GetContent(
            function () {
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php
                        $first = true;
                        ?>
                        <?php foreach (
                            Language::Get('resume', 'tab-data-education') as $data
                        ) :
                            echo '<div>';
                            if ($first == false) {
                                echo '<div style="margin-top: 20px;"></div>';
                            }
                            echo '<div class="label label-info label-fix">';
                            echo $data['name'];
                            echo '</div>';
                            echo '<div>';
                            echo $data['faculty'];
                            echo '</div>';
                            echo '<div>';
                            if (array_key_exists('date-start', $data)) {
                                echo '<span class="label label-default label-fix">' . $data['date-start'] . '</span> - ';
                            }
                            echo '<span class="label label-default label-fix">' . $data['date-end'] . '</span>';
                            echo '</div>';
                            echo '</div>';
                            $first = false;
                        endforeach;
                        ?>

                    </div>
                    <div class="panel-footer"></div>
                </div>
                <?php
            }
        );
        return $output;
    }

    public static function Employment($accordion = null)
    {
        $output = Template::GetContent(
            function () use ($accordion) {
                $root = Language::RouteUrl('front/resume');
                $employment = Project::Employment();
                list($icon_employment_normal, $icon_employment_checked) = Resume::EmploymentCheckIcons();
                $root_accordion = \Operation\Resume::EmploymentAccordionRoot();
                ?>
                <div class="panel-group" id="employment-accordion" role="tablist" aria-multiselectable="true" data-accordion-item-url="item/employment">
                    <?php foreach ($employment as $employer => $data) : ?>
                        <?php
                        $employer_id = Str::ToUrl($employer);
                        $accordion_id_name = 'E-' . $employer_id;
                        $tab_id = $accordion_id_name;
                        $tab_id_heading = $tab_id . '-heading';
                        $tab_id_content = $tab_id;
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="<?= $tab_id_heading ?>">
                                <div class="panel-title">
                                    <div class="pull-right">
                                        <?php
                                        echo '&nbsp;' . $data['duration'] . '&nbsp;';
                                        if (!isset($data['end'])) {
                                            echo '<i class="' . \Config\Icon::ICON_PROGRESS . '"></i>';
                                        } else {
                                            echo '<i class="' . \Config\Icon::ICON_CALENDAR . '" aria-hidden="true"></i>';
                                        }
                                        ?>
                                    </div>
                                    <a class="resume-link" role="button" data-toggle="collapse"
                                       data-parent="#employment-accordion"
                                       data-base-href="<?= $root ?>"
                                       href="<?= $root_accordion . '/' . $employer_id ?>#<?= $tab_id_content ?>"
                                       aria-controls="<?= $tab_id_content ?>"
                                       >
                                        <i class="fa <?= $employer_id == $accordion ? $icon_employment_checked : $icon_employment_normal ?>"
                                           style="margin-right: 5px;" aria-hidden="true"></i><?= $employer ?>
                                    </a>
                                </div>
                            </div>
                            <?php
                            $loaded = $accordion !== null && $employer_id == $accordion;
                            ?>
                            <div id="<?= $tab_id_content ?>"
                                 class="panel-collapse collapse <?= $loaded ? 'active in' : '' ?>"
                                 role="tabpanel" aria-labelledby="<?= $tab_id_heading ?>"
                                 data-accordion-loaded="<?= $loaded ? 'true' : 'false' ?>">
                                <?php if ($loaded) echo \Operation\Resume::ItemEmployment($employer) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
                <?php
            }
        );
        return $output;
    }

    public static function EmploymentCheckIcons()
    {
        //$icon_employment_normal = ;
        //$icon_employment_checked = ;
        return [
            Icon::ICON_RESUME_EMPLOYMENT_CHECKED,
            Icon::ICON_RESUME_EMPLOYMENT_UNCHECKED
        ];
    }

    public static function EmploymentAccordionRoot()
    {
        return Language::RouteUrl('front/resume/5/employer');
    }

    public static function ItemEmployment($employer_key)
    {
        $employment = Project::Employment();
        $data = $employment[$employer_key];
        $current_accordion_url = Language::RouteUrl('front/projects');

        $output = '';
        $output .= '<div class="panel-body">';
        $output .= '<div style="float: right;">';
        $output .= '<div class="label label-default label-badge">';
        $output .= '&nbsp;<span class="">' . $data['start']->format(Language::Get('projects', 'format-date')) . '</span>';
        $output .= ' - ';
        if (isset($data['end'])) {
            $output .= '<span class="">' . $data['end']->format(Language::Get('projects', 'format-date')) . '</span>';
        } else {
            $output .= '<i class="' . \Config\Icon::ICON_PROGRESS . '"></i>';
        }
        $output .= '</div>';
        $output .= '</div>';

        $output .= Resume::Info($employer_key, $data);

        $output .= '<div style="clear:both;"></div>';
        $output .= '<span class="label label-default label-badge">' . Language::Get('projects', 'title') . ':</span>&nbsp;';
        $project_first = false;
        foreach ($data['projects'] as $project_data) {
            $project_item = Project::Get($project_data['era'], $project_data['index']);
            $url = Project::Url($project_data['era'], $project_data['index']);
            if ($project_first) {
                $output .= PROJECT_DIVIDER;
            }
            $output .= '<a p3x-ajax-href="' . $current_accordion_url . '" href="' . $url . '">';
            $output .= Html::Country($project_item['country'], 'top', 'resume-tooltip');
            $output .= $project_item['project'];
            $output .= '</a>';
            $project_first = true;
        }
        $output .= '</div>';
        return $output;
    }

    public static function Info(&$employer, &$data)
    {
        $employment_info = Language::Get('resume', 'company-info');
        $output = '';
        $employer_id = Str::ToUrl($employer);

        if (count($data['projects']) == 1) {
            $project_data = $data['projects'][0];
            $project_item = Project::Get($project_data['era'], $project_data['index']);
            $output .= Project::Info($project_item, 'role');
            $output .= Project::Info($project_item, 'tasks');
            $output .= Project::Info($project_item, 'task-normal');
            $output .= Project::Info($project_item, 'summary');
        }
        if (isset($employment_info[$employer_id]['info'])) {
            $output .= $employment_info[$employer_id]['info'];
        }
        return $output;
    }
}