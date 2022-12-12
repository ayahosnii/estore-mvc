<?php

namespace estore\app\controllers;

class NotFoundController extends AbstractController
{
    public function notFoundAction()
    {
        $this->_language->load('template.common');
        $this->_view();
    }
}