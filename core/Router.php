<?php
namespace app\core;
/**
 * Summary of Router
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) $CURRENT_YEAR
 */
class Router
{
    //set pathes of requset and their Method by a nasted array
    protected array $routes= [ [ 'get' => [     ] , 'post' => [    ] ] ] ;
    //Creat prop request and assign it inside contructor
    public Request $request; 
    // create constructor that passes Requset as arrg
    public Response $response;
    //
    public View $view;
    public function __construct(Request $request){
        $this->request = $request;
        $this->response = new Response();
        $this->view = new View();
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

    //resolve
    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        
        if ($callback === false) {
            //Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            return $this->view->renderView('_404');
            }

        if (is_string($callback)) {
            return $this->view->renderView($callback);
            }
        if (is_array($callback)) {
            $callback[0]= new $callback[0]; 
        }
        
        return call_user_func($callback, $this->request);
    }
}