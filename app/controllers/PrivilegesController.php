<?php

namespace estore\app\controllers;

use estore\app\lib\inputFilter;
use estore\app\models\Privilege;
use estore\app\lib\Helper;

class PrivilegesController extends AbstractController
{
    use inputFilter;
    use Helper;
    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('privileges.default');

        $this->_data['privileges'] = Privilege::getAll();

        $this->_view();
    }

    // TODO: we need to implement csrf prevention

    public function createAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('privileges.labels');
        $this->_language->load('privileges.create');
        if (isset($_POST['submit'])) {
            $privilege = new Privilege();
            $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->filterString($_POST['Privilege']);
            if ($privilege->save())
            {
                $this->redirect('/privileges');
            }
        }
        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $privilege = Privilege::getByPK($id);

        $this->_data['privilege'] = $privilege;


        if($privilege === false) {
            $this->redirect('/privileges');
        }


        $this->_language->load('template.common');
        $this->_language->load('privileges.labels');
        $this->_language->load('privileges.edit');

        if(isset($_POST['submit'])) {
            $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->filterString($_POST['Privilege']);
            if($privilege->save())
            {
                $this->redirect('/privileges');
            }
        }

        $this->_view();
    }
    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $privilege = Privilege::getByPK($id);

        if($privilege === false) {
            $this->redirect('/privileges');
        }



    if($privilege->save())
    {
        $this->redirect('/privileges');
    }

        $this->_view();
    }

}