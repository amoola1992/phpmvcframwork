<?php

namespace phpcodemvc/phpmvcframwork;

use phpcodemvc/phpmvcframwork\db\Database;
use phpcodemvc/phpmvcframwork\db\DbModel;

class Application{
    public static string $ROOT_DIR;

    public string $layout='main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public  Response $respone;
    public Session $session;
    public  Database $db;
    public static Application $app;
    public ?Controller $controller=null;
    public ?DbModel $user;
    public View $view;


    public function __construct($rootPath , array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->respone = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request,$this->respone);
        $this->view = new View();
        $this->db = new Database($config['db']);
        $primaryValue = $this->session->get('user');
        if($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue ]);
        }else{
            $this->user = null;
        }
     
        
    }

    public static function isGuest()
    {
        return !self::$app->user;
    } 

    public function run(){
        try{
            echo  $this->router->resolve();
        }catch(\Exception $e){
            $this->respone->setStatusCode($e->getCode());
            echo $this->view->renderView('_error',[
                'exception' => $e
            ]);

        }
    }

    public function getController(){
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
         $this->controller;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        Application::$app->session->set('user',$primaryValue);
        return true;
    }

    public function logout()
    {
        $this -> user = null;
        $this->session->remove('user');
    }
}
