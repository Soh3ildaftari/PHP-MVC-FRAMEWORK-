<?php
namespace app\controllers;
/**
 * Summary of Router
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) 2023
 */
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\contactForm;

class SiteController extends Controller
{
    public function home(Request $request)
    {
        $params = [];
        return $this->render('home', $params);

    }
    public function contact(Request $request)
    {
        $contact = new contactForm();
        if ($request->isGet()) {
            return $this->render('contact', ['model'=>$contact]);
        }
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->save()) {
                Application::$app->session->setFlash('success', 'Thanks For Your opinion');
                Application::$app->response->redirect('/');
            } else{
                return $this->render('contact',[ 'model' => $contact]);
               };
        }

    }
}