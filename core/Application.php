<?php
namespace app\core;
/**
 * Summary of Application
 * @author MasterMute
 * @copyright (c) $CURRENT_YEAR
 */
class Application
{
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public static string $ROOT_DIR;
    /**
     * Summary of __construct
     * @param mixed $rootPath
     */
    public function __construct($rootPath)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
    }
    public function run()
    {
        echo $this->router->resolve();
    }
}
