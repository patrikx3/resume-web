<?php

use P3x\language;
use P3x\Controller;
use Operation\Project;

$root_tab = Project::ProjectEraTab();
?>
<div class="effect-shine opening">
    <div id="projects-opening">
        <div id="projects-opening-bg"></div>
        <div id="projects-bg-1"></div>
        <div id="projects-bg-2"></div>
        <div id="projects-title">
            <?= language::get('projects', 'title') ?>
        </div>
        <?= P3x\template::render('slot/download-resume', false, false) ?>
    </div>
</div>

<?php
$defaut_tab_id = $data['tab'];

$projects = language::get('projects', 'projects');

$year = date('Y');

$accordions_data = [];
?>
<div class="layout-content-text">

    <?php if (!isset($_REQUEST['full']) && !isset($_REQUEST['sygnus']) && !isset($_REQUEST['nuaxia'])): ?>

        <div class="warning">
            <?= language::get('projects', 'title-note'); ?>
        </div>
        <br/>
    <?php endif; ?>


    <div id="projects-tab" data-tab-item-url="item/project">
        <ul class="nav nav-pills nav-justified" role="tablist">
            <?php foreach ($projects as $project_era => $project) : ?>
                <?php
                $tab_id = $project_era;
                if (empty($defaut_tab_id)) {
                    $defaut_tab_id = $tab_id;
                }
                $root_tab_project = $root_tab . '/' . $tab_id;
                ?>
                <li class="<?= $defaut_tab_id == $tab_id ? 'active' : '' ?>">
                    <a role="tab" data-toggle="tab" href="<?= $root_tab_project ?>#<?= $tab_id ?>"
                       data-base-href="<?= $root_tab ?>">
                        <i class="<?= \config\Icon::ICON_PROJECTS_ERA ?>"></i>
                        <?= $project['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content">
            <?php foreach ($projects as $project_era => $project) : ?>
                <?php
                $tab_id = $project_era;
                $root_tab_project = $root_tab . '/' . $tab_id;
                $loaded = $defaut_tab_id == $tab_id;

                $accordion_id = 'accordion-' . $project_era;
                $root_addon = $project_era . '-';
                $accordions_data[] = [
                    'root' => $root_tab_project,
                    'current_accordion' => $project_era == $data['tab'] ? $data['accordion'] : '',
                    'accordion_id' => $accordion_id,
                    'root_addon' => $root_addon,
                ];
                ?>
                <div data-tab-loaded="<?= $loaded ? 'true' : 'false' ?>" id="<?= $tab_id ?>"
                     class="tab-pane fade <?= $loaded ? 'active in' : '' ?>">
                    <?php if ($loaded) echo \Operation\Project::ProjectEra($project_era, $data) ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<script id="data-projects" type="application/json"><?= Controller::Json(
        [
            'root_tab' => $root_tab,
            'current_tab' => $data['tab'],
            'accordions' => $accordions_data,
        ]
    ) ?></script>
