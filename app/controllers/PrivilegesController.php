<?php

namespace estore\app\controllers;

use estore\app\lib\inputFilter;
use estore\app\lib\Messenger;
use estore\app\models\Privilege;
use estore\app\lib\Helper;
use estore\app\models\UserGroupPrivilege;

class PrivilegesController extends AbstractController
{
    use inputFilter;
    use Helper;
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('privileges.default');

        $this->_data['privileges'] = Privilege::getAll();

        $this->_view();
    }

    // TODO: we need to implement csrf prevention

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('privileges.labels');
        $this->language->load('privileges.create');
        if (isset($_POST['submit'])) {
            $privilege = new Privilege();
            $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->filterString($_POST['Privilege']);
            if ($privilege->save())
            {
                $this->messenger->add('تم حفظ الصلاحية بنجاح');
                //$this->messenger->add('خطـ في حفظ الصلاحية', Messenger::APP_MESSAGE_ERROR);
                //$this->messenger->add('انتيه: الصلاحية موجودة من قبل', Messenger::APP_MESSAGE_WARNING);
                //$this->messenger->add('قم بعمل صلاحيات ملائمة للمستخدم', Messenger::APP_MESSAGE_INFO);
                //$this->redirect('/privileges');
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


        $this->language->load('template.common');
        $this->language->load('privileges.labels');
        $this->language->load('privileges.edit');

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

        $groupPrivileges = UserGroupPrivilege::getBy(['PrivilegeId' => $privilege->PrivilegeId]);
        if (false !== $groupPrivileges) {
            foreach ($groupPrivileges as $groupPrivilege) {
                $groupPrivilege->delete();
            }
        }



    if($privilege->delete())
    {
        $this->redirect('/privileges');
    }

        $this->_view();
    }

}