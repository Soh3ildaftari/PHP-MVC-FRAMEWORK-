<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;
/**
 * Summary of AuthController
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) 2023
 */
class AuthController extends Controller {

    public function register(Request $request)
    {
    $this->setLayout('auth');
    $registerModel = new RegisterModel();
       if ($request->isGet()) {
            
         return $this->render('register',[ 'model' => $registerModel]);

       }    
       if ($request->isPost()) {
        $registerModel->loadData($request->getBody());
        if($registerModel->validate()){
         echo '<pre>';
         var_dump($request->getBody());
         echo '</pre>';
        }
        else{
         return $this->render('register',[ 'model' => $registerModel]);
        };

       }
    }
    public function login(Request $request)
    {
       if ($request->isGet()) {
        $this->setLayout('auth');
        return $this->render('login');
       }
       if ($request->isPost()) {
         return 'welcome to your home!';
       }
    }

}