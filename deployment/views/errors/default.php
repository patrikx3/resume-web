<?php

use P3x\Router;

?>
<div class="layout-content-text">
    <h1 class="page-error">
    <span class="label label-info">
        <i class="<?= $data['icon'] ?>"></i>
        <?= $data['title'] ?>
    </span>
    </h1>
    <div>
        <span class="label label-danger"><?= $_SERVER['REQUEST_URI']; ?></span>
    </div>

    <br/>
    <div><?= isset($data['message']) ? $data['message'] : ''; ?></div>

    <?php if (DEBUG) : ?>
        <div style="text-align: left;">
            <?= Router::RequestInfo(); ?>
        </div>
    <?php endif; ?>

</div>
