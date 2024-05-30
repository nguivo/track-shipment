<?php

use app\models\User;
use framework\core\Application;

require_once dirname(__DIR__)."/vendor/autoload.php";

    $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    $config = [
        'db' => [
            'dsn' => "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}",
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASS']
        ],
        'userClass' => User::class
    ];

    $app = new Application(dirname(__DIR__), $config);

    echo "This is the entry point";
