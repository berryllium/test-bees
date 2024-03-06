<?php
session_start();

require_once '../classes/autoloader.php';

$app = new App();
$hit = $_POST['hit'] ?? false;

if($hit) {
    $result = $app->hitRandomBee();
} else {
    $result = $app->loadState();
}

die(json_encode($result));