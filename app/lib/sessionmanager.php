<?php
namespace estore\app\lib;

class SessionManager extends \SessionHandler
{

    private $sessionName = SESSION_NAME;
    private $sessionMaxLifetime = SESSION_LIFE_TIME;
    private $sessionSSL = false;
    private $sessionHTTPOnly = true;
    private $sessionPath = '/';
    private $sessionDomain = '.estore-mvc.com/';
    private $sessionSavePath = SESSION_SAVE_PATH;

    private $sessionCipherAlgo = 'AES-128-ECB';
    private $sessionCipherKey = 'WYCRYPT0K3Y@2016';

    private $ttl = 30;

    public function __construct()
    {

        $this->sessionSSL = isset($_SERVER['HTTPS']) ? true : false;
        $this->sessionDomain = str_replace('www.', '', $_SERVER['SERVER_NAME']);
//
//        ini_set('session.use_cookies', 1);
//        ini_set('session.use_only_cookies', 1);
//        ini_set('session.use_trans_sid', 0);
//        ini_set('session.save_handler', 'files');
//
//        session_name($this->sessionName);
//
//        session_save_path($this->sessionSavePath);

//        session_set_cookie_params(
//            $this->sessionMaxLifetime, $this->sessionPath,
//            $this->sessionDomain, $this->sessionSSL,
//            $this->sessionHTTPOnly
//        );

//        session_set_save_handler($this, true);
    }

    public function __get($key) {
        if(isset($_SESSION[$key])) {
            $data = $_SESSION[$key];
            if($data === false) {
                return $_SESSION[$key];
            } else {
                return $data;
            }
        } else {
            trigger_error('No session key ' . $key . ' exists', E_USER_NOTICE);
        }
    }

    public function __set($key, $value) {
        if(is_object($value)) {
            $_SESSION[$key] = serialize($value);
        } else {
            $_SESSION[$key] = $value;
        }
    }

    public function __isset($key)
    {
        return isset($_SESSION[$key]) ? true : false;
    }

    public function __unset($key)
    {
        unset($_SESSION[$key]);
    }

    public function start()
    {
        if('' === session_id()) {
            if(session_start()) {
                $this->setSessionStartTime();
                $this->checkSessionValidity();
            }
        }
    }

}