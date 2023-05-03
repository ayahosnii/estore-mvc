<?php

namespace estore\app\controllers;

use estore\app\lib\Helper;
use estore\app\lib\InputFilter;
use estore\app\models\Privilege;
use estore\app\models\User;
use estore\app\models\UserGroup;
use estore\app\models\UserGroupPrivilege;


class UsersGroupsController extends AbstractController
{

    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        var_dump($this->session->messages);

        $this->language->load('template.common');
        $this->language->load('usersgroups.default');


        $this->_data['groups'] = UserGroup::getAll();


        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('usersgroups.create');
        $this->language->load('usersgroups.labels');

        $this->_data['privileges'] = Privilege::getAll();


        if (isset($_POST['submit'])) {
            $group = new UserGroup();
            $group->GroupName = $this->filterString($_POST['GroupName']);
            if ($group->save())
            {
                if(isset($_POST['privileges']) && is_array($_POST['privileges'])) {

                    foreach ($_POST['privileges'] as $privilegeId) {
                        $groupPrivilege = new UserGroupPrivilege();
                        $groupPrivilege->GroupId = $group->GroupId;
                        $groupPrivilege->PrivilegeId = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
                $this->redirect('/usersgroups');
            }
        }

        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params);
        $group = UserGroup::getByPK($id);

        if ($group === false){
            $this->redirect('/usersgroups');
        }

        $this->language->load('template.common');
        $this->language->load('usersgroups.edit');
        $this->language->load('usersgroups.labels');

        $this->_data['group'] = $group;
        $this->_data['privileges'] = Privilege::getAll();
        $extractedPrivilegesIds = $groupPrivileges = UserGroupPrivilege::getBy(['GroupId' => $group->GroupId]);
        
        $extractedPrivilegesIds = [];
        if (false !== $groupPrivileges) {
            foreach ($groupPrivileges as $privilege) {
                $extractedPrivilegesIds[] = $privilege->PrivilegeId;
            }
        }
        $this->_data['groupPrivilege'] = $extractedPrivilegesIds;


        if (isset($_POST['submit'])) {
            $group->GroupName = $this->filterString($_POST['GroupName']);

            if ($group->save())
            {
                if(isset($_POST['privileges']) && is_array($_POST['privileges'])) {
                    $privilegeIdsToBeDeleted = array_diff($extractedPrivilegesIds, $_POST['privileges']);
                    $privilegeIdsToBeAdded = array_diff($_POST['privileges'], $extractedPrivilegesIds);

                    //Deleted the unwanted privileges
                    foreach ($privilegeIdsToBeDeleted as $deletedPrivileges) {
                        $unwantedPrivilege = UserGroupPrivilege::getBy(['PrivilegeId' => $deletedPrivileges, 'GroupId' => $group->GroupId]);
                        $unwantedPrivilege->current()->delete();
                    }

                    // Add the new privilege
                    foreach ($privilegeIdsToBeAdded as $privilegeId) {
                        $groupPrivilege = new UserGroupPrivilege();
                        $groupPrivilege->GroupId = $group->GroupId;
                        $groupPrivilege->PrivilegeId = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
                $this->redirect('/usersgroups');
            }
        }

        $this->_view();

    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params);
        $group = UserGroup::getByPK($id);

        if ($group === false){
            $this->redirect('/usersgroups');
        }

        $groupPrivileges = UserGroupPrivilege::getBy(['GroupId' => $group->GroupId]);
        var_dump($groupPrivileges);

        if (false !== $groupPrivileges) {
            foreach ($groupPrivileges as $groupPrivilege) {
                $groupPrivilege->delete();
            }
        }


        if ($group->delete()){
            echo 'success';

            $this->redirect('/usersgroups');

        }

    }



}