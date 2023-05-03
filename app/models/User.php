<?php
namespace estore\app\models;

class User extends AbstractModel
{
    public $Userid;
    public $Username;
    public $Password;
    public $SubscriptionDate;
    public $LastLogin;
    public $GroupId;


    protected static $tableName = 'app_users';

    protected static $tableSchema = array(
        'UserId'            => self::DATA_TYPE_INT,
        'Username'          => self::DATA_TYPE_STR,
        'Password'          => self::DATA_TYPE_STR,
        'Email'             => self::DATA_TYPE_STR,
        'PhoneNumber'       => self::DATA_TYPE_STR,
        'SubscriptionDate'  => self::DATA_TYPE_DATE,
        'LastLogin'         => self::DATA_TYPE_STR,
        'GroupId'           => self::DATA_TYPE_STR,
    );

    protected static $primaryKey = 'UserId';


}