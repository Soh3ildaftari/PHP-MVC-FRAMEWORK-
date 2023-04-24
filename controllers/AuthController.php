<?php
namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\login;
use app\models\user;
/**
 * Summary of AuthController
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) 2023
 */
class AuthController extends Controller {

    public function register(Request $request)
    {
    $this->setLayout('auth');
    $registerModel = new user();
       if ($request->isGet()) {
            
         return $this->render('register',[ 'model' => $registerModel]);

       }    
       if ($request->isPost()) {
        $registerModel->loadData($request->getBody());
        if($registerModel->validate() && $registerModel->save()){
          Application::$app->session->setFlash('success', 'Thanks For Registration');
          Application::$app->response->redirect('/');
        }
        else{
         return $this->render('register',[ 'model' => $registerModel]);
        };

       }
    }
    public function login(Request $request)
    {
        $login = new login;
       if ($request->isGet()) {
        $this->setLayout('auth');
        return $this->render('login', ['model' => $login]);
       }
       if ($request->isPost()) {
          $login->loadData($request->getBody());
          if ($login->validate() && $login->login()) {
              Application::$app->response->redirect('/');   
            }
            else{
              $this->setLayout('auth');
              return $this->render('login', ['model' => $login]);
             }
          }

    }

}