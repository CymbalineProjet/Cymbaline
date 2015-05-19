<?php

require_once 'core/autoload.php';

use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;
use core\component\Session;
use core\component\Route;
use core\component\tools\View;

//ajout pour authentification des membres
use source\User\SecurityBox\item\Authentification;
use source\User\SecurityBox\service\AuthentificationService;
use core\component\exception\CoreException;
use core\component\exception\DeniedException;
use core\component\exception\TemplateException;

session_start();

if(isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    $url = "/";
}

$route   = new Route($url);
$param   = new Parametrage();
$app     = new Controller();
$session = new Session($_SESSION);
$request = new Request(array(
    'get' => $_GET,
    'post' => $_POST,
    'session' => $session,
    'cookie' => $_COOKIE,
    'server' => $_SERVER,
));

//ajout pour authentification des membres
/*
if(!$session->_is_register("user") && isset($request->get('post')->access)) {   
    $user = new source\Cdm\UtilisateurBox\item\Utilisateur();
    $user->setAnonymous(true);
    $session->_register("user", $user);   
}

if($session->_is_register("user")) {
        $authentification = new Authentification($session->get('user'));
        $authentification->authentification_process();
        $sAuth = new AuthentificationService();
        if($sAuth->is_anonymous()) {
            throw new DeniedException('Error authentification denied anonymous');
        }

        if(!$sAuth->is_authentified() && isset($request->get('post')->identifiant)) {
            throw new DeniedException('Error authentification denied');
        }

        if(!$sAuth->is_granted()) {
            throw new DeniedException('Error authentification not granted !');
        }      
} else {
    throw new DeniedException('Error authentification denied no session');
}
*/
//FIN



$r = $route->load();

$controller = $app->load($r['controller']);

$controller->init($session, $param, $request);
$action = $r['action']."Action";
$view = new View(null);
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
