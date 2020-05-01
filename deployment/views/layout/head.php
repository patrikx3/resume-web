<?php

use P3x\Controller;
use Config\config;
use Config\Route;

list($folder_source, $folder_source_scripts, $folder_source_css, $folder_production, $folder_production_css, $folder_production_script) = Route::Folders();

list($default_theme, $orignal_themes, $light_themes, $dark_themes, $current_theme) = Config::GetThemes();
switch ($current_theme) {
    case 'bootstrap':
        $theme_url = 'bower_components/bootstrap/dist/css/bootstrap' . (DEBUG ? '' : '.min') . '.css';
        break;
    default:
        $theme_url = $folder_source . 'bootstrap-theme/bootstrap-' . $current_theme . '.theme.min.css';
        break;
}
?>

<link rel="stylesheet" id="bootstrap-theme" href="<?= $theme_url ?>">
<script type="application/json" id="layout-data-config"><?= Controller::Json(Config::GetConfig($data)) ?></script>

<?php if (DEBUG) : ?>
    <link rel="stylesheet" href="<?= $folder_source_css ?>all.css">
    <script type="text/javascript" src="<?= $folder_source_scripts ?>Boot.js"></script>
    <script type="text/javascript" src="<?= $folder_source_scripts ?>LayoutManager.js"></script>
    <script type="text/javascript" src="<?= $folder_source_scripts ?>views/slot/Social.js"></script>
    <script type="text/javascript" src="<?= $folder_source_scripts ?>views/AboutMe.js"></script>
    <script type="text/javascript" src="<?= $folder_source_scripts ?>views/Contact.js"></script>
    <script type="text/javascript" src="<?= $folder_source_scripts ?>views/PlayGround.js"></script>
    <script type="text/javascript" src="<?= $folder_source_scripts ?>views/Projects.js"></script>
    <script type="text/javascript" src="<?= $folder_source_scripts ?>views/Resume.js"></script>

<?php else : ?>
    <script>
        p3x = {
            Gui: {
                Bootstrap: {}
            }
        };
    </script>
    <link rel="stylesheet" href="<?= $folder_production_css ?>production.patrikx3.css">

    <!--
    <script defer type="text/javascript" src="<?= $folder_production ?>bower.js"></script>
    <script defer type="text/javascript" src="<?= $folder_production ?>p3x.resume.hbs.js"></script>
    <script defer type="text/javascript" src="<?= $folder_production ?>patrikx3.js"></script>
    -->

    <script defer type="text/javascript" src="<?= $folder_production_script ?>production.patrikx3.all.js"></script>

<?php endif; ?>


