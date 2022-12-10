<?php

namespace estore\app\controllers;

class IndexController extends AbstractController
{
    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('index.default');
        $this->_view();
    }

    public function addAction()
    {
        $this->_view();
    }
}