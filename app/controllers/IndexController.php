<?php

namespace estore\app\controllers;

class IndexController extends AbstractController
{
    public function defaultAction()
    {
        $this->messenger->add('hi');
        unset($this->session->messages);
        $this->session->messages = 'hi';
        var_dump($this->session->messages);
        $this->language->load('template.common');
        $this->language->load('index.default');
        $this->_view();
    }

    public function addAction()
    {
        $this->_view();
    }
}