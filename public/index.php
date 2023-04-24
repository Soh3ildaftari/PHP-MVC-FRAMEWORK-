<?php
// use nameSpace
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController  ;
//auto load 
require_once dirname(__DIR__).'/vendor/autoload.php';
//load .env file
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
$config = [
    'db'=>[
        'dsn'=>$_ENV['DB_DSN'],
        'username'=>$_ENV['DB_USER'],
        'password'=>$_ENV['DB_PASS']
    ],
    'userClass' => app\models\user::class

]; 
//create an instance of Application
$app = new Application(dirname(__DIR__),$config);
//Declare Routing
$app->router->get('/',[SiteController::class , 'home']);
$app->router->get('/contact',[SiteController::class, 'contact']);
$app->router->get('/register',[AuthController::class , 'register']);
$app->router->get('/login',[AuthController::class , 'login']);
$app->router->post('/register',[AuthController::class , 'register']);
$app->router->post('/login',[AuthController::class , 'login']);
$app->router->post('/contact',[SiteController::class, 'handleContact']);
//run the app
 $app->run();       
