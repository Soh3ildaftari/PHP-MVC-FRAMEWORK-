<?php
namespace app\core;
/**
 * Summary of View
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) CURRENT_YEAR
 */
class View
{
    public function renderView($view,$params =[],$layout = 'main'){
      
        $layoutContant = $this->layoutContent($layout);
        $viewContent = $this->rendreOnlyView($view,$params);
        return str_replace('{{content}}', $viewContent, $layoutContant);
    }


    protected function layoutContent($layout){
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";   
        return ob_get_clean();
    }
    /**
     * Summary of rendreOnlyView
     * @param mixed $view
     * @param mixed $params
     * @return bool|string
     */
    public function rendreOnlyView($view,$params = []){
        foreach ($params as $key => $value) {
            $$key = $value;
        }   
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}








?>