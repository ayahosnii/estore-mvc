<?php

namespace estore\app\controllers;

class UsersController extends AbstractController
{
    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('users.default');
        $this->_view();
    }

    public function addAction()
    {
        $this->_view();
    }
}