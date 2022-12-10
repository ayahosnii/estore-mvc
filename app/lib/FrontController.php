<?php
namespace estore\app\lib;


class FrontController
{
    const NOT_FOUND_ACTION = 'NotFoundAction';
    const NOT_FOUND_CONTROLLER = 'estore\app\controllers\NotFoundController';

    private $_controller = 'index';
    private $_action = 'default';
    private $_params = array();

    private $_template;
    private $_language;

    //Dependency injection
    /*
     * Adding a new dependency is as easy as adding a new setter method,
     * which does not interfere with the existing code.
     * */
    public function __construct(Template $template, Language $language)
    {
        $this->_template = $template;
        $this->_language = $language;
        $this->_parseUrl();
    }

    private function _parseUrl()
    {
        $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

        if (isset($url[0]) && $url[0] != ''){
            $this->_controller = $url[0];
        }

        if (isset($url[1]) && $url[1] != ''){
            $this->_action = $url[1];
        }

        if (isset($url[2]) && $url[2] != '') {
            $this->_params = $url[2];
        }

    }

    public function dispatch()
    {
        $controllerClassName = 'estore\app\controllers\\'.ucfirst($this->_controller) . 'Controller';
        $actionName = $this->_action . 'Action';
        if(!class_exists($controllerClassName)){
            $controllerClassName = self::NOT_FOUND_CONTROLLER;
        }
        $controller = new $controllerClassName();
        if (!method_exists($controller, $actionName)){
            $this->_action = $actionName = self::NOT_FOUND_ACTION;
        }

        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setParams($this->_params);
        $controller->setTemplate($this->_template);
        $controller->setLanguage($this->_language);
        $controller->$actionName();
    }
}
