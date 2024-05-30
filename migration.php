<?php

use framework\core\Application;

require_once __DIR__ . "/vendor/autoload.php";
$path = __DIR__;
$dotenv = \Dotenv\Dotenv::createImmutable($path);
$dotenv->load();

$config = [
    'db' => [
        "dsn" => "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}",
        "user" => $_ENV['DB_USER'],
        "pass" => $_ENV['DB_PASS']
    ]
];

//Application::dnd($config);

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();