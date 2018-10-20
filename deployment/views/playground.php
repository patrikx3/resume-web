<?php
use P3x\language;
use P3x\Controller;
use Operation\Html;

$str = Language::Get('playground', 'title');
$title = preg_split('//u', $str, null, PREG_SPLIT_NO_EMPTY);
$new_title = [];
$random_index = array_rand($title);
foreach ($title as $index => $title_item) {
    $new_char = '<div style="position: static; display: inline;" class="';
    $new_char .= 'playground-title-char';
    if ($random_index == $index) {
        $new_char .= ' playground-titlize';
    }
    $new_char .= '">' . $title_item . '</div>';
    $new_title[] = $new_char;
}
$title_left_default = 20;
?>
<div class="effect-shine-vertical opening" id="playground-opening-shine">
    <div id="playground-opening">
        <div id="playground-opening-title">
            <div style="position: absolute; top: 120px; left: <?= $title_left_default ?>px">
                <?= implode($new_title) ?>
            </div>
        </div>
        <?= P3x\Template::Render('slot/download-resume', false, false) ?>
    </div>
</div>


<?php
$playground = Language::Get('playground', 'playground');


$tooltip_placement = 'top';
$root_addon = 'PG';
$key_id = count($playground);
$root_accordion = Language::RouteUrl('front/playground');
?>
<div class="layout-content-text">

    <div class="panel-group" id="playground-accordion" role="tablist" aria-multiselectable="true" data-accordion-item-url="item/playground">
        <?php foreach ($playground as $key => $game) : ?>
            <?php
            $id = $key_id--;
            $accordion_id_name = 'PG' . $id; //\mb::generate_url_id($game['title']);
            $tab_id = $accordion_id_name;
            $tab_id_heading = $tab_id . '-heading';
            $tab_id_content = $tab_id;
            $accordion_title = $game['id'];
            ?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="<?= $tab_id_heading ?>">
                    <div class="panel-title">
                        <div class="pull-right">
                            <?php if (isset($game['image'])) : ?>
                                <i class="playground-tooltip <?= \Config\Icon::ICON_IMAGE ?>" data-toggle="tooltip" data-placement="<?= $tooltip_placement ?>" title="<?= htmlentities(language::get('playground', 'title-image')) ?>"></i>
                            <?php endif; ?>
                            <?php if (isset($game['url'])) : ?>
                                <i class="playground-tooltip <?= \Config\Icon::ICON_LINK ?>" data-toggle="tooltip" data-placement="<?= $tooltip_placement ?>" title="<?= htmlentities(language::get('playground', 'title-url')) ?>"></i>
                            <?php endif; ?>
                            <?php if (isset($game['flash'])) : ?>
                                <i class="playground-tooltip <?= \Config\Icon::ICON_FLASH ?>" data-toggle="tooltip" data-placement="<?= $tooltip_placement ?>" title="<?= htmlentities(language::get('playground', 'title-flash')) ?>"></i>
                            <?php endif; ?>
                        </div>

                        <a role="button" data-toggle="collapse" data-parent="#playground-accordion" data-base-href="<?= $root_accordion ?>" href="<?= $root_accordion . '/' . $id . '/' . $accordion_title ?>#<?= $tab_id_content ?>" aria-controls="<?= $tab_id_content ?>"><?= Html::Country($game['country'], $tooltip_placement, 'playground-tooltip') ?><?= $game['year'] ?>
                            - <?= $game['title'] ?>
                        </a>
                    </div>
                </div>
                <?php
                $loaded = $id == $data['accordion'];
                ?>
                <div id="<?= $tab_id_content ?>" data-bootstrap-accordion="<?= $accordion_title; ?>" class="panel-collapse collapse <?= $loaded ? 'active in' : '' ?>" role="tabpanel" aria-labelledby="<?= $tab_id_heading ?>" data-accordion-loaded="<?= $loaded ? 'true' : 'false' ?>">
                    <?php if ($loaded) echo \Operation\PlayGround::ItemFull($key) ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>


<script id="data-playground" type="application/json"><?= Controller::Json(
        [
            'data-root-accordion' => $root_accordion,
            'data-root-addon' => $root_addon,
            'data-accordion' => $data['accordion'],
            'data-title-left-default' => $title_left_default,
        ]
    ) ?></script>