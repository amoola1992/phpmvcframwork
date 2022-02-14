<?php 

namespace phpcodemvc/phpmvcframwork\middlewares;

use phpcodemvc/phpmvcframwork\Application;
use phpcodemvc/phpmvcframwork\exceptions\ForbiddenException;

class AuthMiddleware extends BaseMiddleware 
{
    public array $actions = [];

    public function __construct($actions=[])
    {
        $this->actions = $actions;

    }
    public function execute()
    {
        if(Application::isGuest()){
            if(empty($this->actions) || in_array(Application::$app->controller->action , $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}
