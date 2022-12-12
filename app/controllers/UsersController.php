<?php

namespace estore\app\controllers;

use estore\app\models\User;


class UsersController extends AbstractController
{
    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('users.default');

        $this->_data['users'] = User::getAll();

        $this->_view();
    }

    public function addAction()
    {
        $this->_view();
    }
    public function createAction()
    {
        $this->_language->load('template.common');
        $this->_view();
    }
}