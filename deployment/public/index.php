<?php

error_reporting(-1);
ini_set('display_errors', 'On');

const ROOT = '..' . DIRECTORY_SEPARATOR;
include ROOT . 'boot.php';
P3x\Application::Run(Config\Config::GetDefaultRoute());
