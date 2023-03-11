<?php
//auto load 
require_once __DIR__.'/../vendor/autoload.php';
// use class Aplication with no nameSpace
use app\core\Application;
//
use app\controllers\SiteController;
//creat an instance of Application
$app = new Application(dirname(__DIR__));
//Call the get Func of current path
$app->router->get('/',[SiteController::class , 'home']);
$app->router->get('/contact',[SiteController::class, 'contact']);
$app->router->post('/contact',[SiteController::class , 'handleContact']);
// $app->router->get('/contact',[SiteController::$_SC, 'contact']);
// $app->router->post('/contact',[SiteController::$_SC, 'handleContact']);
//run the app
$app->run();

