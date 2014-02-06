<?php

require_once 'core/autoload.php';

use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;
use core\component\Session;
use core\component\security\SecurityUser;

session_start();

$session = new Session($_SESSION);


//$session->_register("security", new SecurityUser());
$request = new Request(array(
    'get' => $_GET,
    'post' => $_POST,
    'session' => $session,
    'cookie' => $_COOKIE,
    'server' => $_SERVER,
));

$param = new Parametrage();

$app = new Controller();


//s'il y a des membres
//$app->initSecurity();

if(isset($_GET['controller'])) {
    $controller = $app->load(ucfirst($_GET['namespace']).'/'.ucfirst($_GET['box']).'Box/'.ucfirst($_GET['controller']));
} else {
    $controller = $app->load($param->getBaseController());
}

$controller->init($session, $param, $request);

if(isset($_GET['action'])) {
    $action = $_GET['action']."Action";
    $view = $controller->$action($request);
} else {
    $view = $controller->indexAction($request);
}

/*if($controller->_session()->_is_register("membre")) {
    
    $security = new SecurityUser($controller->_session()->get('membre'));
    if($security->is_granted()) {
        var_dump('is granted to be here');
    } else {
        die('denied');
    }
    
} else {
    //var_dump($_SERVER['REQUEST_URI']);
    if(strtolower($_SERVER['REQUEST_URI']) == strtolower('/alcafram/cdm/prono/defaut'))
        echo "login";
    //else
       // die('denied2');
            
}*/



var_dump($_SESSION);

//var_dump($controller->_session());
include($view->getPath());

