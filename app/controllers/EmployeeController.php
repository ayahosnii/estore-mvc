<?php

namespace estore\app\controllers;


use estore\app\models\Employee;
use estore\app\lib\Helper;
use  estore\app\lib\InputFilter;


class EmployeeController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('employee.default');
        $this->_data['employees'] = Employee::getAll();
        $this->_view();
    }

    public function addAction()
    {
        $this->_language->load('template.common');
        if(isset($_POST['submit'])){
            $emp = new Employee();
            $emp->name = $this->filterString($_POST['name']);
            $emp->age = $this->filterInt($_POST['age']);
            $emp->address = $this->filterString($_POST['address']);
            $emp->salary = $this->filterFloat($_POST['salary']);
            $emp->tax = $this->filterFloat($_POST['tax']);
            if ($emp -> save()) {
                $_SESSION['message'] = 'Employee, ' . $emp->name .' has saved successfully';
                $this->redirect('/employee');
            }
        }
        $this->_view();
    }

    public function editAction()
    {
        $id = filter_var($this->_params, FILTER_SANITIZE_NUMBER_INT);
        $emp = Employee::getByPK($id);
        if ($emp === false) {
            $this-> redirect('/employee');
        }

        $this->_language->load('template.common');

        $this->_data['employee'] = $emp;
        if(isset($_POST['submit'])){
            $emp = new Employee();
            $emp->name = $this->filterString($_POST['name']);
            $emp->age = $this->filterInt($_POST['age']);
            $emp->address = $this->filterString($_POST['address']);
            $emp->salary = $this->filterFloat($_POST['salary']);
            $emp->tax = $this->filterFloat($_POST['tax']);
            if ($emp -> save()) {
                $_SESSION['message'] = 'Employee, ' . $emp->name .' has saved successfully';
                $this->redirect('/employee');
            }
            var_dump($emp);
        }
        $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params);

        $emp = Employee::getByPK($id);
        if ($emp === false) {
            $this->redirect('/employee');
        }

        if ($emp->delete()) {
            $_SESSION['message'] = 'Employee, deleted successfully';
            $this->redirect('/employee');
        }
    }
}