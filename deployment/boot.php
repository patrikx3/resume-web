<?php
error_reporting(-1);
ini_set('display_errors', 'On');

/**
 *
 */
const ROOT_ARTIFACTS = ROOT . '../artifacts/';
/**
 *
 */
const ROOT_VENDOR = ROOT . 'vendor/';
/**
 *
 */
const ROOT_VENDOR_AUTOLOAD = ROOT_VENDOR . 'autoload.php';
/**
 *
 */
const ROOT_ARTIFACTS_RESUME_PDF_FONTS = ROOT_ARTIFACTS . 'resume-pdf-fonts/';
/**
 *
 */
const ROOT_VENDOR_MPDF = ROOT_VENDOR . 'mpdf/mpdf/';
/**
 *
 */
const ROOT_BUILD = ROOT . 'build/';

/**
 *
 */
const VERSION_FILE = ROOT . 'version.txt';
include_once ROOT_VENDOR_AUTOLOAD;


P3x\Application::Boot();

Config\Config::Define();
Config\Route::Define();
Config\Template::Define();


if (isset($_REQUEST['full'])) {
    setcookie('p3x-resume-full', true, 0, WEB_ROOT);
}
if (isset($_REQUEST['sygnus'])) {
    setcookie('p3x-resume-sygnus', true, 0, WEB_ROOT);
}
if (isset($_REQUEST['nuaxia'])) {
    setcookie('p3x-resume-nuaxia', true, 0, WEB_ROOT);
}
if (isset($_COOKIE['p3x-resume-full'])) {
    $_REQUEST['full'] = 1;
}
if (isset($_COOKIE['p3x-resume-sygnus'])) {
    $_REQUEST['sygnus'] = 1;
}
if (isset($_COOKIE['p3x-resume-nuaxia'])) {
    $_REQUEST['nuaxia'] = 1;
}

