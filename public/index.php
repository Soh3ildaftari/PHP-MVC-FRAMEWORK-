<?php
//auto load 
require_once __DIR__.'/../vendor/autoload.php';
// use class Aplication with no nameSpace
use app\core\Application;
//
use app\controllers\SiteController;
use app\controllers\AuthController  ;
//creat an instance of Application
$app = new Application(dirname(__DIR__));
//Call the get Func of current path
$app->router->get('/',[SiteController::class , 'home']);
$app->router->get('/contact',[SiteController::class, 'contact']);
$app->router->get('/register',[AuthController::class , 'register']);
$app->router->get('/login',[AuthController::class , 'login']);
$app->router->post('/register',[AuthController::class , 'register']);
$app->router->post('/login',[AuthController::class , 'login']);
$app->router->post('/contact',[SiteController::class, 'handleContact']);
//run the app
$app->run();

