<?php

require_once 'core/autoload.php';

use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;
use core\component\Session;
use core\component\Route;


session_start();

$session = new Session($_SESSION);
$request = new Request(array(
    'get' => $_GET,
    'post' => $_POST,
    'session' => $session,
    'cookie' => $_COOKIE,
    'server' => $_SERVER,
));

$param = new Parametrage();
$app   = new Controller();
$route = new Route('generator');
$r = $route->load();

$controller = $app->load($r['controller']);
$controller->init($session, $param, $request);
$action = $r['action']."Action";

if(isset($r['args'])) {
    $view = $controller->$action($request,$r['args']);
} else {
    $view = $controller->$action($request);
}

if(isset($r['ressources'])) {
    $view->ressources = $r['ressources'];
} else {
    $view->ressources = false;
}

if(file_exists("source/".$r['template'].".php")) {
    include("source/".$r['template'].".php");
    exit;
} else if(file_exists("vendor/".$r['template'].".php")) {
    include("vendor/".$r['template'].".php");
    exit;
} else {
    $message = "Aucun template valide pour cette page";
    throw new TemplateException($message);
    exit;
}