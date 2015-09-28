<?php

include '../../framework/App.php';
$app = \Framework\App::getInstance();

$db = new \Framework\DB\SimpleDB();
$a = $db->prepare('SELECT * FROM users')->execute()->fetchAllAssoc();
var_dump($a);

$app->run();