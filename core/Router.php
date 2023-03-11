<?php
namespace app\core;
use app\controllers\SiteController;

class Router
{
    //set pathes of requset and their Method by a nasted array
    protected array $routes= [ [ 'get' => [     ] , 'post' => [    ] ] ] ;
    //Creat prop request and assign it inside contructor
    public Request $request; 
    // create constructor that passes Requset as arrg
    public Response $response;
    //
    public function __construct(Request $request){
        $this->request = $request;
        $this->response = new Response();




    }
    //set func get to save callback funcs for get method on path
    public function get($path,$callback){
        $this -> routes ['get'] [$path] = $callback ;
    }   
    //
    public function post($path,$callback){
        $this -> routes ['post'] [$path] = $callback ;
    }   
    //

    //creat func to render view for given path 
    public function renderView($view,$params =[]){
      
        $layoutContant = $this->layoutContent();
        $viewContent = $this->rendreOnlyView($view,$params);
        return str_replace('{{content}}', $viewContent, $layoutContant);
    }


    protected function layoutContent(){
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";   
        return ob_get_clean();
    }
    public function rendreOnlyView($view,$params){
        foreach ($params as $key => $value) {
            $$key = $value;
        }   
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
    //resolve
    public function resolve() {
        $path = $this->request->getPath();

        $method = $this->request->getMethod();
        
        $callback = $this->routes[$method][$path] ?? false;
        
        if ($callback === false) {
            //Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
            }

        if (is_string($callback)) {
            return $this->renderView($callback);
            }
        if (is_array($callback)) {
            $callback[0]= new $callback[0]; 
        }
        
        return call_user_func($callback, $this->request);
    }
}