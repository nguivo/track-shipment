<?php

use framework\core\Application;

require_once dirname(__DIR__)."/vendor/autoload.php";

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [];

$app = new Application(dirname(__DIR__), $config);

echo "This is the entry point";
