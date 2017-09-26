<?php
const ROOT = '.' . DIRECTORY_SEPARATOR . 'deployment' . DIRECTORY_SEPARATOR;
$_SERVER['HTTP_HOST'] = 'patrikx3.com';

include_once ROOT .'boot.php';

$command = isset($argv[1]) ? $argv[1] : 'update';
switch($command) {
    case 'build':
        $run = new \Cli\Build();
        break;

    case 'mpdf':
    case 'install':
    $run = new \Cli\MPdf();
        break;

    default:
        echo(sprintf('Unknown command: %s', $command));
        exit;
}
$run->run();