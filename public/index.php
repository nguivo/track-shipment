<?php

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\models\User;
use framework\core\Application;
use framework\core\UserModel;

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

    $app->router->get('/', [SiteController::class, 'home']);
    $app->router->post('/', [SiteController::class, 'home']);
    $app->router->get('/home', [SiteController::class, 'home']);
    $app->router->post('/home', [SiteController::class, 'home']);

    $app->router->get('/contact', [SiteController::class, 'contact']);
    $app->router->post('/contact', [SiteController::class, 'contact']);

    $app->router->get('/register', [AuthController::class, 'register']);
    $app->router->post('/register', [AuthController::class, 'register']);

    $app->run();

