﻿<?php session_start();

require_once 'core/autoload.php';

use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;
use core\component\Session;
use core\component\Route;
use core\component\tools\View;

use Cymbaline\Cymbalog\item\Cymbalog;


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
$route = new Route('/');


try {

    $r = $route->load();

    $controller = $app->load($r['controller']);
    $controller->init($session, $param, $request);

    $action = $r['action']."Action";
    $view = new View(null);



    if(isset($r['args'])) {
        $view = $controller->$action($r['args']);
    } else {

        $view = $controller->$action();
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
} catch(\Exception $e) {

    echo $e->getMessage();die;
}