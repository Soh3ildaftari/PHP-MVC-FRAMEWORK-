<?php
namespace app\controllers;
use app\core\Application;
use app\core\Controller;
class SiteController extends Controller{
    
    // public static SiteController $_SC;
    
    // public function __construct()
    // {
    //    self::$_SC = $this;
    // }

    public function home()
    {
        $params=["name"=>"MasterMute",
    ];
        return $this->render('home',$params);
        
    }
    public function handleContact()
    {
        $body = Application::$app->request->getBody();
        return  var_dump($body);
    }

    public function contact()
    {
        return Application::$app->router->renderView('contact');
    }

}