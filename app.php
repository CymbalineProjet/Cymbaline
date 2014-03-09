<?php

require_once 'core/autoload.php';

use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;
use core\component\Session;
use core\component\Route;

//ajout pour authentification des membres
use source\User\SecurityBox\item\Authentification;
use source\User\SecurityBox\service\AuthentificationService;
use core\component\exception\CoreException;
// fin

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

$r = $route->load();
$controller = $app->load($r['controller']);
$controller->init($session, $param, $request);
$action = $r['action']."Action";

if(isset($r['args'])) {
    $view = $controller->$action($request,$r['args']);
} else {
    $view = $controller->$action($request);
}

//ajout pour authentification des membres
try {
    if($session->_is_register("user")) {
        try {
            $authentification = new Authentification($session->get('user'));
            $authentification->authentification_process();
            $sAuth = new AuthentificationService();

            if(!$sAuth->is_authentified()) {
                throw new CoreException('Error authentification denied');
            }

            if(!$sAuth->is_granted()) {
                throw new CoreException('Error authentification not granted');
            }
        } catch (CoreException $e) {
            $e->display();
        }
    } else {
        throw new CoreException('Access denied, not register.');
    }
} catch (CoreException $exception) {
    $exception->display();
}
//FIN

include("source/".$r['template'].".php");
exit;