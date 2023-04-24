<?php
// use nameSpace
use app\core\Application;
//auto load 
require_once __DIR__.'/vendor/autoload.php';
//load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
$config = [
    'db'=>[
        'dsn'=>$_ENV['DB_DSN'],
        'username'=>$_ENV['DB_USER'],
        'password'=>$_ENV['DB_PASS']
    ]
]; 
//create an instance of Application
$app = new Application(__DIR__,$config);
$app->db->applyMigration();
?>