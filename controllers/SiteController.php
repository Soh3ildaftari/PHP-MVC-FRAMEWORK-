<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
/**
 * Summary of SiteController
 * @author MasterMute <soheilsoheili1113@gmail.com>
 * @copyright (c) 2023
 */
class SiteController extends Controller{
    
    /**
     * Summary of home
     * @return array|string
     */
    public function home(Request $request)
    {
        $params=["name"=>"MasterMute",
    ];
        return $this->render('home',$params);
        
    }

    /**
     * Summary of contact
     * @return array|string
     */
    public function contact()
    {
        return $this->render('contact');
}
public function handleContact($request)
{
    echo '<pre>';
    var_dump($request->getBody());
    echo '</pre>';
}

}