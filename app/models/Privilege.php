<?php
namespace estore\app\models;

class Privilege extends AbstractModel
{
    public $GroupId;
    public $GroupName;


    protected static $tableName = 'app_users_privileges';

    protected static $tableSchema = array(
        'PrivilegeId'         => self::DATA_TYPE_INT,
        'Privilege'           => self::DATA_TYPE_STR,
        'PrivilegeTitle'           => self::DATA_TYPE_STR,
    );

    protected static $primaryKey = 'PrivilegeId';


}