<?php

require_once 'core/autoload.php';

use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;
use core\component\Session;
use core\component\Route;

use source\User\SecurityBox\item\Authentification;
use source\User\SecurityBox\service\AuthentificationService;
use core\component\exception\CoreException;


session_start();

$session = new Session($_SESSION);

$request = new Request(array(
    'get' => $_GET,
    'post' => $_POST,
    'session' => $session,
    'cookie' => $_COOKIE,
    'server' => $_SERVER,
));

/**
 * TODO
 * faire une class pour chaque attributs de request
 * 
 * permettra de faire $controller->get('request')->get('post')->attr;
 */


$param = new Parametrage();
$app = new Controller();


if($session->_is_register("membre")) {
    try {
        //$granted = true;
        $authentification = new Authentification($session->get('membre'));
        $authentification->authentification_process();

        $sAuth = new AuthentificationService();

        if(!$sAuth->is_authentified()) {
            throw new CoreException('Error authentification denied');
        }

        if(!$sAuth->is_granted()) {
            $granted = false;
            throw new CoreException('Error authentification not granted');
        }
        
        
    } catch (CoreException $e) {
        $e->display();
    }
    
} 



if(isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    $url = "/";
}


$route = new Route($url);

$r = $route->load();

$controller = $app->load($r['controller']);
$controller->init($session, $param, $request);
$action = $r['action']."Action";



if(isset($r['args'])) {
    $view = $controller->$action($request,$r['args']);
} else {
    $view = $controller->$action($request);
}

$template = $r["template"];

include("source/".$template.".php");

exit;

/*********
 * TEST
 */

$url = explode("/",$_GET['url']);
$true = false;
foreach($routes as $route => $args) {
    
    
    $r = explode("/", $route);
    unset($r[0]);

    if(sizeof($url) == sizeof($r) /*and sizeof($url) != 1*/) {
        
        $test = strpos( $route, "/".$url[0]);

        if(is_int($test)) {
            if(sizeof($url) != 1) {
                /*unset($r[1]);
                unset($url[0]);*/
                $_args = array();
                //var_dump($url);
                //var_dump($r);
                $end_r = str_replace("@","",end($r));
                $_args[$end_r] = end($url);

                $routes[$route]['_args'] = $_args;
                
                $rrr = $routes[$route];
                //var_dump($args);
                $true = true;
            } /*else {
                $true = true;
            }*/
        }
    }
        
        
    
}


if(isset($routes[str_replace($param->getBaseUrl(),"","/".$_GET['url'])]) or $true)  {
   
    if($true) {
        $route = $rrr;

    } else {
        $route = $routes[str_replace($param->getBaseUrl(),"",$_SERVER['REQUEST_URI'])];
    }

    $controller = $app->load($route['_controller']);

    $controller->init($session, $param, $request);

    //var_dump($route['_args']);


    $action = $route['_action']."Action";

    
    
   
    if(true) {
        $view = $controller->$action($request,$route['_args']);
    } else {
        $view = $controller->$action($request);
    }
    $template = $route["_template"];
   
    //var_dump($route);

   // header("Status: 200 OK", false, 200);
    include("source/".$route['_template'].".php");
    
} else {
    include("source/Alca/ErrorBox/template/denied.php");
}

