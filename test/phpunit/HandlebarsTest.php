<?php
use PHPUnit\Framework\TestCase;

use P3x\Debug;

use P3x\Language as l;
use P3x\Template;

class HandlebarsTest extends TestCase
{

    protected function setUp(): void
    {
        ApplicationTest::Init();
    }

    public function testDownloadResume() {
        $output = template::render('slot/download-resume');
        $this->assertNotEmpty($output);
        $output = template::render('slot/download-resume', false, true);
        $this->assertNotEmpty($output);
    }

    public function testAboutMe() {
        $output = Template::Render('about-me');
        $this->assertNotEmpty($output);
    }

    public function testContact() {
        $output = Template::Render('contact');
        $this->assertNotEmpty($output);
    }
}