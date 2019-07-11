<?php

use Config\Icon;
use Operation\Html;
use Operation\Project;
use Operation\Resume;
use P3x\Language;
use P3x\Controller;
use P3x\Str;

$view_data = $data;
$current_tab = $view_data['downloadOrTab'];
if ($current_tab == null) {
    $current_tab = 1;
}
list($icon_employment_normal, $icon_employment_checked) = Resume::EmploymentCheckIcons();
if ($view_data['accordion'] == null) {
    $view_data['accordion'] = Str::ToUrl(array_keys((Project::Employment()))[0]);
};
$root = Language::RouteUrl('front/resume');
?>
<div id="resume-opening-title-position"></div>

<div class="effect-shine-vertical opening">
    <div id="resume-opening">
        <div id="resume-opening-bg"></div>
        <div id="resume-opening-block">
        </div>
        <div id="resume-opening-title">
            <?= html::UpdateSlogan('resume-opening-titlize', Language::Get('resume', 'title')); ?>
        </div>
        <?= P3x\template::render('slot/download-resume', false, false) ?>
    </div>
</div>


<div class="layout-content-text">

    <div id="resume-tab" data-tab-item-url="item/resume">
        <ul class="nav nav-pills nav-justified" role="tablist">
            <li class="<?= $current_tab == 1 ? 'active' : '' ?>">
                <?php
                $current_path = Language::Get('resume', 'tab-cover-id');
                ?>
                <a role="tab" data-toggle="tab" data-base-href="<?= $root ?>"
                   href="<?= $root . '/1/' . $current_path ?>#R1" data-bootstrab-tab="<?= $current_path ?>">
                    <i class="<?= Icon::ICON_RESUME_COVER ?> fa-lg"></i>
                    <?= Language::Get('resume', 'tab-cover') ?>
                </a>
            </li>
            <li class="<?= $current_tab == 2 ? 'active' : '' ?>">
                <?php
                $current_path = Language::Get('resume', 'tab-personal-id');
                ?>
                <a role="tab" data-toggle="tab" data-base-href="<?= $root ?>"
                   href="<?= $root . '/2/' . $current_path ?>#R2" data-bootstrab-tab="<?= $current_path ?>">
                    <i class="<?= Icon::ICON_RESUME_PERSONAL ?> fa-lg"></i>
                    <?= Language::Get('resume', 'tab-personal') ?>
                </a>
            </li>
            <li class="<?= $current_tab == 3 ? 'active' : '' ?>">
                <?php
                $current_path = Language::Get('resume', 'tab-skills-id');
                ?>
                <a role="tab" data-toggle="tab" data-base-href="<?= $root ?>"
                   href="<?= $root . '/3/' . $current_path ?>#R3" data-bootstrab-tab="<?= $current_path ?>">
                    <i class="<?= Icon::ICON_RESUME_SKILLS ?> fa-lg"></i>
                    <?= Language::Get('resume', 'tab-skills') ?>
                </a>
            </li>
            <li class="<?= $current_tab == 4 ? 'active' : '' ?>">
                <?php
                $current_path = Language::Get('resume', 'tab-education-id');
                ?>
                <a role="tab" data-toggle="tab" href="<?= $root . '/4/' . $current_path ?>#R4"
                   data-base-href="<?= $root ?>" data-bootstrab-tab="<?= $current_path ?>">
                    <i class="<?= Icon::ICON_RESUME_EDUCATION ?> fa-lg"></i>
                    <?= Language::Get('resume', 'tab-education') ?>
                </a>
            </li>
            <li class="<?= $current_tab == 5 ? 'active' : '' ?>">
                <?php
                $current_path = Language::Get('resume', 'tab-employment-id');
                ?>
                <a role="tab" data-toggle="tab" href="<?= $root . '/5/' . $current_path ?>#R5"
                   data-base-href="<?= $root ?>" data-bootstrab-tab="<?= $current_path ?>">
                    <i class="<?= Icon::ICON_RESUME_EMPLOYMENT ?> fa-lg"></i>
                    <?= Language::Get('resume', 'tab-employment') ?>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="R1" data-tab-loaded="<?= $current_tab == 1 ? 'true' : 'false' ?>"
                 class="tab-pane fade <?= $current_tab == 1 ? 'active in' : '' ?>">
                <?php if ($current_tab == 1) echo Resume::Cover() ?>
            </div>
            <div id="R2" data-tab-loaded="<?= $current_tab == 2 ? 'true' : 'false' ?>"
                 class="tab-pane fade <?= $current_tab == 2 ? 'active in' : '' ?>">
                <?php if ($current_tab == 2) echo Resume::Personal() ?>
            </div>
            <div id="R3" data-tab-loaded="<?= $current_tab == 3 ? 'true' : 'false' ?>"
                 class="tab-pane fade <?= $current_tab == 3 ? 'active in' : '' ?>">
                <?php if ($current_tab == 3) echo Resume::Skills() ?>
            </div>
            <div id="R4" data-tab-loaded="<?= $current_tab == 4 ? 'true' : 'false' ?>"
                 class="tab-pane fade <?= $current_tab == 4 ? 'active in' : '' ?>">
                <?php if ($current_tab == 4) echo Resume::Education() ?>
            </div>
            <div id="R5" data-tab-loaded="<?= $current_tab == 5 ? 'true' : 'false' ?>"
                 class="tab-pane fade <?= $current_tab == 5 ? 'active in' : '' ?>">
                <?php if ($current_tab == 5) echo Resume::Employment($view_data['accordion']) ?>
            </div>


        </div>
    </div>
    <script id="data-resume" type="application/json"><?= Controller::Json(
            [
                'root' => $root,
                'current_tab' => $current_tab,
                'icon_employment_normal' => $icon_employment_normal,
                'icon_employment_checked' => $icon_employment_checked,
                'root_addon' => 'E-',
                'view_data_accordion' => $view_data['accordion'],
                'root_accordion' => Resume::EmploymentAccordionRoot(),
            ]
        ) ?></script>
</div>
