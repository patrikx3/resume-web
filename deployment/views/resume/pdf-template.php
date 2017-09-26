<?php
use P3x\Language;
use P3x\Str;
use Config\Icon;
use Operation\Html;
use Operation\Project;
use Operation\Resume;

$email = base64_decode(EMAIL);

$color_header_bg = '#1C1D21';
$color_header_font = 'white';
$color_footer_bg = '#1C1D21';
$color_footer_font = 'white';
$color_note = '#1C1D21';

$default_color = 'black';

$color_title = '#31353D';
$color_title_project = '#31353D';

$color_link = '#445878';
$color_project_item_icon = '#445878';

$color_hr = '#dddddd';
$color_era = '#dddddd';

$border_radius = '3px';

$employment = \Operation\Project::Employment();

$record = function ($title, $data, $item, $type = null, $additional = null) {
    if (!isset($data[$item])) {
        return;
    }

    if ($type == 'date') {
        $valign = 'middle';
    } else {
        $valign = 'top';
    }
    echo '<tr>';
    echo '<td align="right" valign="' . $valign . '"  nowrap width="1%">';
    echo '<div class="data-sub-title">' . $title . ':</div>';
    echo '</td>';
    echo '<td valign="' . $valign . '" width="99%">';
    switch ($type) {
    case 'date':

        echo $data[$item]->format($additional);

        echo ' - ';

        if (isset($data['date-end'])) {
            echo $data['date-end']->format($additional);
        } else {
            echo '<span class="fontawesome">' . \P3x\Template\Icon::Unicode(Icon::ICON_PROGRESS_RAW) . '</span>';
        }

        if (isset($data['date-end'])) {
            echo ' | <span style="font-weight: bold;">' . Language::GetDuration($data[$item], $data['date-end']) . '</span>';
        }
        break;

    case 'since':
        echo sprintf(Language::Get('projects', 'data-since'), $data[$item]);
        break;

    case 'image':
        if (!is_array($data[$item])) {
            $data[$item] = [$data[$item]];
        }
        $count = 0;
        foreach ($data[$item] as $url) {
            if ($count > 0) {
                echo ', ';
            }
            $url = URL . $url;
            $name = pathinfo($url);
            echo "<a target=\"_blank\" href=\"{$url}\">" . $name['filename'] . "</a>";
            $count++;
        }
        break;

    case 'flash':
        if (!is_array($data[$item])) {
            $data[$item] = [$data[$item]];
        }
        $count = 0;
        foreach ($data[$item] as $flash) {
            if ($count > 0) {
                echo ', ';
            }
            $url = Html::FlashUrl($flash);
            $name = pathinfo($flash[0]);
            echo "<a target=\"_blank\" href=\"{$url}\">" . $name['filename'] . "</a>";
            $count++;
        }
        break;

    case 'youtube':
    case 'url':
        if (!is_array($data[$item])) {
            $data[$item] = [$data[$item]];
        }
        $count = 0;
        foreach ($data[$item] as $url) {
            if ($count > 0) {
                echo ', ';
            }
            if ($type == 'image') {
                $url = 'files/projects/' . $url;
            }
            echo "<a target=\"_blank\" href=\"{$url}\">{$url}</a>";
            $count++;
        }
        break;
    default:
        echo $data[$item];
        break;
    }
    echo '</td>';
    echo '</tr>';
}
?>
<html>
<head>
    <title><?= Language::Get('layout', 'title') ?> <?=  Language::Get('resume', 'title') ?></title>
    <style>
        body {
            font-family: 'resume-font';
            color: <?= $default_color ?>;
        }

        .project-item {
            font-family: 'fontawesome';
            font-size: 22px;
            color: <?= $color_project_item_icon ?>;
        }

        .fontawesome {
            font-family: 'fontawesome';
        }

        hr {
            height: 2px;
            border-width: 0;
            color: <?= $color_hr ?>;
            background-color: <?= $color_hr ?>;
        }

        .profile-image {
            float: right;
            width: 25%;
            height: auto;
        }

        .header {
            font-weight: bold;
            text-align: center;
            font-size: 22px;
            background-color: <?= $color_header_bg ?>;
            color: <?= $color_header_font ?>;
            border-radius: <?= $border_radius ?>;
        }

        .footer {
            background-color: <?= $color_footer_bg ?>;
            font-size: 13px;
            color: <?= $color_header_font ?>;
            border-radius: <?= $border_radius ?>;
            opacity: 0.75;
        }

        .data-title {
            font-size: 25px;
            font-weight: bold;
            color: <?= $color_title ?>;
        }

        .data-title-era {
            font-size: 22px;
            font-weight: bold;
            text-align: right;
            background-color: <?= $color_era ?>;
            color: white;
            border-radius: <?= $border_radius ?>;
            padding-right: 5px;
        }

        .data-title-project {
            font-weight: bold;
            font-size: 22px;
            color: <?= $color_title_project ?>
        }

        .data-sub-title {
            font-weight: bold;
        }

        .break {
            margin-top: 20px;
        }

        .note {
            color: <?= $color_note ?>;
            font-size: 12px;
        }

        a {
            color: <?= $color_link ?>;
            text-decoration: underline;
        }

        a.transparent {
            color: <?= $color_header_font ?>;
            text-decoration: none;
        }

        a.text {
            text-decoration: none;
            color: <?= $default_color ?>;
        }

        /*
        table {
            page-break-inside:avoid;
        }
        */
    </style>
</head>
<body>

<htmlpageheader name="patrik-header">
    <div class="header">
        <span class="fontawesome"><?= \P3x\Template\Icon::Unicode(Icon::ICON_RESUME_RAW) ?></span>&nbsp;<?= Language::Get('layout', 'title') ?> <?= Language::Get('resume', 'title') ?>
    </div>
</htmlpageheader>

<htmlpagefooter name="patrik-footer">
    <div class="footer">
        <div style="float: left; width: 32%; margin-left: 10px;">
            V<?= VERSION ?><?php //= PROJECT_DIVIDER ?><?php //= date(Language::Get('layout', 'date-format')) ?>
        </div>
        <div style="float: right; width: 64%; text-align: right; margin-right: 10px;">
            <a target="_blank" class="transparent" href="<?= URL ?>"><?= URL ?></a>
            |
            <a target="_blank" class="transparent" href="tel:<?= PHONE ?>"><?= PHONE ?></a>
            |
            <a target="_blank" class="transparent" href="mailto:<?= $email ?>"><?= $email ?></a>
            |
            {PAGENO}/{nbpg}
        </div>
    </div>
</htmlpagefooter>

<sethtmlpageheader name="patrik-header" page="ALL" value="1" show-this-page="1"/>
<sethtmlpagefooter name="patrik-footer"/>

<img class="profile-image" src="<?= URL ?>images/profile-20170330.png"/>
<span class="fontawesome"><?= \P3x\Template\Icon::Unicode(Icon::ICON_RESUME_COVER_RAW) ?></span>
<?= trim(Language::Get('resume', 'tab-data-cover')) ?>

<hr/>

<div>
    <div class="data-title">
        <span class="fontawesome"><?= \P3x\Template\Icon::Unicode(Icon::ICON_RESUME_PERSONAL_RAW) ?></span>&nbsp;<?= Language::Get('resume', 'tab-personal') ?>
    </div>
    <table>
        <?php foreach ( Language::Get('resume', 'tab-data-personal') as $item) : ?>
            <tr>
                <td align="right" valign="middle">
                    <div class="data-sub-title">
                        <?= $item['field'] ?>
                        :
                    </div>
                </td>
                <td valign="middle">
                    <?php
                    $type = isset($item['type']) ? $item['type'] : '';
                    switch ($type) {
                    case 'url':
                        echo "<a href=\"{$item['content']}\">{$item['content']}</a>";
                        break;

                    case 'email':
                        echo "<a target='_blank' href=\"mailto:{$email}\">{$email}</a>";
                        break;

                    case 'since':
                        $years = date('Y') - $item['content'];
                        echo sprintf(Language::Get('resume', 'data-since-pdf'), $item['content'], $years);
                        break;

                    default:
                        echo $item['content'];
                        break;
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<hr/>

<div>
    <div class="data-title" style="float: left; width: 50%;">
        <span class="fontawesome"><?= \P3x\Template\Icon::Unicode(Icon::ICON_RESUME_SKILLS_RAW) ?></span>&nbsp;<?= Language::Get('resume', 'tab-skills') ?>
    </div>

    <div style="clear: both;"></div>

    <?php
    $skill_count = 0;
    ?>
    <?php foreach (Language::Get('resume', 'tab-data-skills') as $item) : ?>
        <div class="data-sub-title">
            <?= $item['field'] ?>
            :
        </div>
        <?= $item['content'] ?>

        <?php
        $skill_count++;
        ?>
        <?php if ($skill_count < count(Language::Get('resume', 'tab-data-skills'))) : ?>
            <div class="break"></div>
        <?php endif; ?>
    <?php endforeach ?>
</div>

<hr/>

<div>
    <div class="data-title">
        <span class="fontawesome"><?= \P3x\Template\Icon::Unicode(Icon::ICON_RESUME_EDUCATION_RAW) ?></span>&nbsp;<?= Language::Get('resume', 'tab-education') ?>
    </div>
    <?php
    $education_count = 0;
    ?>
    <?php foreach ( Language::Get('resume', 'tab-data-education')as $item) : ?>
        <div
            style="float: left; <?= $education_count % 2 == 1 ? 'text-align: right; border-left: 2px solid ' . $color_hr . ';width: 48.8%;' : 'width: 50%;' ?>">
            <div class="data-sub-title">
                <?= $item['name'] ?>
            </div>
            <div>
                <?= $item['faculty'] ?>
            </div>
            <div>
                <?= isset($item['date-start']) ? $item['date-start'] . ' - ' : '' ?>
                <?= $item['date-end'] ?>
            </div>
            <?php
            $education_count++;
            ?>
            <?php if ($education_count < count(Language::Get('resume', 'tab-data-education'))) : ?>
                <div class="break"></div>
            <?php endif; ?>

        </div>
    <?php endforeach ?>

    <!--
    <div class="note">
        <span class="fontawesome">< ? = \P3x\Template\Icon::Unicode(Icon::ICON_RESUME_EDUCATION_NOTE_RAW) ?></span>
        <span style="text-transform: capitalize;">
        < ? = Language::Get('layout', 'text-note') ?>
            :
        </span>
    </div>
    -->
</div>

<hr/>

<div>
    <div class="data-title">
        <span class="fontawesome"><?= \P3x\Template\Icon::Unicode(Icon::ICON_RESUME_EMPLOYMENT_RAW) ?></span>&nbsp;<?= Language::Get('resume', 'tab-employment') ?>
        <?php
        $employment_count = 0;
        ?>
        <table width="100%">
            <?php foreach ($employment as $employer => $data) : ?>
                <?php if ($employment_count > 0) : ?>
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td valign="top" style="font-weight: bold;">
                        <a class="text" name="employer-<?= Str::ToUrl($employer) ?>">
                            <?= $employer ?>
                        </a>
                    </td>
                    <td align="right" valign="top">
                        <?php
                        if (isset($data['end'])) {
                            echo $data['duration'] . ' | ';
                        } else {
                            echo '<span class="fontawesome">' . \P3x\Template\Icon::Unicode(Icon::ICON_PROGRESS_RAW) . '</span>&nbsp;';
                        }

                        echo '<span style="font-weight: bold;">';
                        echo $data['start']->format(Language::Get('projects', 'format-date'));

                        if (isset($data['end'])) {
                            echo ' - ';
                            echo $data['end']->format(Language::Get('projects', 'format-date'));
                        }
                        echo '</span>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?= Resume::Info($employer, $data); ?>
                        <div class="note" style="padding-top: 10px;">
                            <br/>
                            <span style="font-weight: bold;">
                        <?= Language::Get('projects', 'title') ?>
                                :
                        </span>
                            <?php
                            $project_first = false;
                            foreach ($data['projects'] as $project_data) {
                                $project_item = Project::Get($project_data['era'], $project_data['index']);
                                if ($project_first) {
                                    echo '<span class="font-weight: bold;">' . PROJECT_DIVIDER . '</span>';
                                }
                                echo '<a class="text" href="#' . $project_data['era'] . '-' . $project_data['index'] . '">';
                                echo $project_item['project'];
                                echo '</a>';
                                $project_first = true;
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php
                $employment_count++;
                ?>
            <?php endforeach ?>
        </table>
    </div>
</div>

<hr/>

<div>
    <div class="data-title">
        <span class="fontawesome"><?= \P3x\Template\Icon::Unicode(Icon::ICON_PROJECTS_RAW) ?></span>&nbsp;<?= Language::Get('projects', 'title') ?>
    </div>
    <div class="note"><?= Language::Get('projects', 'title-note') ?> </div>
    <?php foreach ( Language::Get('projects', 'projects') as $era_key => $era) : ?>
        <div class="data-title-era">
            <?= $era['title'] ?>
        </div>
        <?php
        $era_count = 0;
        $project_count = count($era['items']);
        ?>
        <?php foreach ($era['items'] as $project_item_index => $project_item) : ?>
            <table width="100%" border="0">
                <?php
                $employer_id = Project::GetEmployerId($project_item);
                ?>
                <tr>
                    <td valign="middle">
                        <a class="text" name="<?= $era_key . '-' . $project_item_index ?>"
                           href="#employer-<?= $employer_id ?>">
                            <?php if (isset($project_item['country'])) : ?>
                                <img align="absmiddle" style="margin-bottom: 2px;"
                                     src="<?= URL ?>images/famfamfam-flag-icons/<?= $project_item['country'] ?>.gif"/>
                            <?php endif; ?>
                            <span class="data-title-project">
                        <?= isset($project_item['company']) ? $project_item['company'] . PROJECT_DIVIDER : '' ?><?= $project_item['project'] ?>
                        </span>
                        </a>
                    </td>
                    <td valign="middle" align="right" class="project-item">
                        &nbsp;
                        <?php if (isset($project_item['image'])) : ?>
                            <?= \P3x\Template\Icon::Unicode(Icon::ICON_IMAGE_RAW); ?>
                        <?php endif; ?>
                        <?php if (isset($project_item['youtube'])) : ?>
                            <?= \P3x\Template\Icon::Unicode(Icon::ICON_YOUTUBE_PLAY_RAW); ?>
                        <?php endif; ?>
                        <?php if (isset($project_item['url'])) : ?>
                            <?= \P3x\Template\Icon::Unicode(Icon::ICON_LINK_RAW); ?>
                        <?php endif; ?>
                        <?php if (isset($project_item['flash'])) : ?>
                            <?= \P3x\Template\Icon::Unicode(Icon::ICON_FLASH_RAW); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <div style="clear: both;"></div>
            <table style="width: 100%;">
                <? //= $record(Language::Get('projects', 'title-company'), $project_item, 'company') ?>
                <?= $record(Language::Get('projects', 'title-location'), $project_item, 'location') ?>
                <?= $record(
                    Language::Get('projects', 'title-date'), $project_item, 'date-start', 'date', Language::Get('projects', 'format-date')
                ) ?>
                <?= $record(Language::Get('projects', 'title-role'), $project_item, 'role') ?>
                <?= $record(Language::Get('projects', 'title-task'), $project_item, 'tasks', 'badge') ?>
                <?= $record(Language::Get('projects', 'title-task'), $project_item, 'task-normal') ?>
                <?= $record(Language::Get('projects', 'title-technology'), $project_item, 'technology', 'badge') ?>
                <?= $record(Language::Get('projects', 'title-summary'), $project_item, 'summary') ?>
                <?= $record(Language::Get('projects', 'title-url'), $project_item, 'url', 'url') ?>
                <?= $record(Language::Get('projects', 'title-youtube'), $project_item, 'youtube', 'youtube') ?>
                <?= $record(Language::Get('projects', 'title-image'), $project_item, 'image', 'image') ?>
                <?= $record(Language::Get('projects', 'title-flash'), $project_item, 'flash', 'flash') ?>
                <?php
                $era_count++;
                ?>
                <?php if ($era_count < count($era['items'])) : ?>
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        <?php endforeach; ?>
    <?php endforeach; ?>

</div>


</body>
</html>

