<?php

use P3x\Language;

$text = Language::Get(
    'layout', 'construction'
);
?>

<div class="layout-content-text">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="<?= \Config\Icon::ICON_UNDER_CONSTRUCTION ?>" aria-hidden="true"></i><?= $text ?>
            </div>
        </div>
        <div class="panel-body">
            <?= Language::Get('layout', 'construction-content'); ?>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>
