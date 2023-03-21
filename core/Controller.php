<?php
namespace app\core;
class Controller{
    public $layout = 'main';
    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }
    public function render($view,$params = [])
    {
       return Application::$app->router->view->renderView($view,$params,$this->layout);
    }
}
