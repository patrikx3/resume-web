<?php
use P3x\Language;
use P3x\Router;
use P3x\Controller;
use Config\Route;

$id = uniqid();
$o = '';
$file = WEB_ROOT . $data[0];
$no_flash = language::get('layout', 'flash-no');
array_push($data, $id);

list($folder_source, $folder_source_scripts, $folder_source_css, $folder_production, $folder_production_css, $folder_production_script) = Route::Folders();

?>
<html>
<head>
    <base href="<?= WEB_ROOT ?>"/>
    <script type="text/javascript" src="bower_components/swfobject/swfobject/swfobject.js"></script>
</head>
<body>
<div id="<?= $id ?>"><?= $no_flash ?></div>
<script id="script-view-swf" type="application/json"><?= Controller::Json($data) ?></script>
<script src="<?= router::url($folder_source_scripts . 'views/slot/Swf.js'); ?>"></script>
</body>
</html>
