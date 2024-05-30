<?php

namespace app\controllers;

use app\models\ContactForm;
use framework\core\Application;
use framework\core\Controller;
use framework\core\Request;
use framework\core\Response;

class SiteController extends Controller
{


    public function home()
    {
        $params = [
            'name' => 'NIV Studios'
        ];

        return $this->render('home', $params);
    }


    public function contact(Request $request, Response $response)
    {
        $contactForm = new ContactForm();
        if($request->isPost()) {
            $contactForm->loadData($request->getRequestBody());
            if($contactForm->validate() && $contactForm->send()) {
                Application::$app->session->setFlash('success', 'Message sent successfully!');
            }
        }

        return $this->render('contact', ['model' => $contactForm]);
    }

}