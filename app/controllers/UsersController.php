<?php

namespace estore\app\controllers;

use estore\app\lib\Validate;
use estore\app\models\User;
use estore\app\models\UserGroup;


class UsersController extends AbstractController
{
    use Validate;
    private $_createActionRoles =
    [
        'Username'              => 'req|alphanum|min(3)|max(12)',
        'Password'              => 'req|min(6)',
        'CPassword'             => 'req|min(6)',
        'Email'                 => 'req|email',
        'CEmail'                => 'req|email',
        'PhoneNumber'           => 'alphanum|max(15)',
        'GroupId'               => 'req|int',
    ];
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.default');

        $this->_data['users'] = User::getAll();

        $this->_view();
    }

    public function addAction()
    {
        $this->_view();
    }
    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.create');
        $this->language->load('users.labels');
        $this->language->load('validation.errors');

        $this->_data['groups'] = UserGroup::getAll();

        if (isset($_POST['submit'])) {
            $this->isValid($this->_createActionRoles, $_POST);
        }

        $this->_view();
    }
}