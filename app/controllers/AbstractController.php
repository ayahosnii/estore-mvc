<?php

namespace estore\app\controllers;

use estore\app\lib\FrontController;
use estore\app\lib\Template;

class AbstractController
{
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_template;
    protected $_registry;

    protected $_data = [];

    public function __get($key)
    {
        return $this->_registry->$key;
    }

    public function notFoundAction()
    {
        echo $this->_view();
    }

    public function setController($controllerName)
    {
        $this->_controller = $controllerName;
    }

    public function setAction  ($actionName)
    {
        $this->_action = $actionName;
    }

    public function setParams ($paramsName)
    {
        $this->_params = $paramsName;
    }

    public function setTemplate ($template)
    {
        $this->_template = $template;
    }
    public function setRegistry ($registry)
    {
        $this->_registry = $registry;
    }

//    public function setLanguage ($language)
//    {
//        $this->_language = $language;
//    }

    protected function _view()
    {
        $view =  VIEW_PATH . $this->_controller . DS . $this->_action . '.view.php';

        if ($this->_action == FrontController::NOT_FOUND_ACTION || !file_exists($view)) {
            $view =  VIEW_PATH . 'notfound' . DS . 'notfound.view.php';
        }
        $this->_data = array_merge($this->_data, $this->language->getDictionary());
        $this->_template->setRegistry($this->_registry);
        $this->_template->setActionViewFile($view);
        $this->_template->setAppData($this->_data);
        $this->_template->renderApp();

        }
}