<?php

use PHPUnit\Framework\TestCase;

use P3x\View;

class ViewTest extends TestCase
{
    public function testRemoveEmpty()
    {
        $view = new View('view');
        $view->updateContent('TEST');
        $result = $view->render();
        $this->assertEquals('OK-TEST-OK', $result);
    }
}
