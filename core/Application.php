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
    public Session $session;
    public Router $router;
    public Database $db;
    public Request $request;
    public Response $response;
    public string $userClass;
    public ?Dbmodel $user = null;
    public static string $ROOT_DIR;
    /**
     * Summary of __construct
     * @param mixed $rootPath
     */
    public function __construct($rootPath,array $config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->userClass = $config['userClass'];
        $this->request = new Request();
        $this->session = new Session();
        $this->response = new Response();
        $this->router = new Router($this->request);
        $this->db = new Database($config['db']);
        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]) ?? null;
        }

    }
    public static function isGuest(): bool
    {
        return !self::$user;
    }
    public function run()
    {
        echo $this->router->resolve();
    }
    public function login(Dbmodel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user',$primaryValue);
        return true;
    }
    public function logout(): void
    {
        $this->user = null;
        $this->session->remove('user');
    }
}
