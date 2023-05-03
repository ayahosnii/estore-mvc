<?php
namespace estore;

use estore\app\lib\FrontController;
use estore\app\lib\Messenger;
use estore\app\lib\Registry;
use estore\app\lib\SessionManager;
use estore\app\lib\template\Template;
use estore\app\lib\Language;
use mysql_xdevapi\Session;

session_start();

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
require_once '..' . DS . 'app' . DS . 'config'. DS . 'config.php';
require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';

$session = new SessionManager();
$session->start();
if (!isset($session->lang)) {
    $session->lang = APP_DEFAULT_LANGUAGE;
}

$template_parts = require_once '..' . DS . 'app' . DS . 'config'. DS . 'templateconfig.php';


$template = new Template($template_parts);

$language = new Language();

$messenger = Messenger::getInstance($session);


$registry = Registry::getInstance();
$registry->session = $session;
$registry->language = $language;
$registry->messenger = $messenger;


$frontController = new FrontController($template, $registry);
$frontController->dispatch();
