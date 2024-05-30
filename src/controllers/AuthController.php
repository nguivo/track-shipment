<?php

namespace app\controllers;

use app\models\User;
use app\models\LoginForm;
use framework\core\Application;
use framework\core\Controller;
use framework\core\middlewares\AuthMiddleware;
use framework\core\Request;
use framework\core\Response;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }


    public function login(Request $request, Response $response): string
    {
        $this->layout = "main";
        $loginForm = new LoginForm();

        if($request->isPost()) {
            $loginForm->loadData($request->getRequestBody());

            if($loginForm->validate() && $loginForm->login()) {
                Application::$app->session->setFlash('success', 'Welcome');
                $response->redirect('/');
            }
        }
        return $this->render('login', ['model' => $loginForm]);
    }


    public function register(Request $request): string
    {
        $this->setLayout("main");
        $user = new User();

        if($request->isPost()) {
            $user->loadData($request->getRequestBody());
            if($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', "Successfully registered");
                Application::$app->response->redirect('/');
            }

            return $this->render("register", ['model' => $user]);
        }

        return $this->render('register', ['model' => $user]);
    }


    public function profile()
    {
        Application::$app->view->title = "User Profile";
        return $this->render('profile');
    }


    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        Application::$app->response->redirect('login');
    }

}