<?php
const ROOT = './';
const ROOT_BUILD = ROOT . 'build';
include_once ROOT .'src/Application.php';
include_once ROOT .'src/Template.php';

const ROOT_VENDOR = ROOT . 'vendor/';
const ROOT_VENDOR_AUTOLOAD = ROOT_VENDOR . 'autoload.php';
include_once ROOT_VENDOR_AUTOLOAD;

\P3x\Application::Boot();


