<?php
namespace Controller\Admin;

use Controller\Controller;

use P3x\Template;

class Index extends \Controller
{
    public function Index() {

        $this->renderer->updateContent(
            Template::Render('admin/index'),
            'ADMIN'
        );
        echo $this->renderer->render();
    }
}