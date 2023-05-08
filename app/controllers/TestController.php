<?php

namespace estore\app\controllers;

use estore\app\lib\Validate;

class TestController extends AbstractController
{
    use Validate;
    public function defaultAction()
    {
//        //var_dump($this->num(2));
//        //var_dump($this->alphanum('Aya99'));
//        //var_dump($this->min('ojop', 3));
//        var_dump($this->floatLike(397.55, 3, 2));
//        var_dump($this->vdate('2022-09-19'));
//        var_dump($this->email('aya@yahoo.com'));
//        var_dump($this->url('https://www.youtube.com'));
//        var_dump($this->_params);
//        var_dump('hi');

        $str  = 'الحقل %s يجب أن يحتوي على قيمة';
        $newString = sprintf($str,  'اسم المستخدم');
        echo $newString;


    }






}

