<?php

require_once 'core/autoload.php';

use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;
use core\component\Session;
use core\component\security\SecurityUser;

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




/*if($controller->_session()->_is_register("membre")) {
    
    $security = new SecurityUser($controller->_session()->get('membre'));
    if($security->is_granted()) {
        var_dump('is granted to be here');
    } else {
        die('denied');
    }
    
} else {

    if(strtolower($_SERVER['REQUEST_URI']) == strtolower('/alcafram/cdm/prono/defaut'))
        echo "login";
    //else
       // die('denied2');
            
}*/

$routes = array("/login" => array(
                    "_template"   => "Cdm/PronoBox/template/index",
                    "_controller" => "Cdm/PronoBox/Defaut",
                    "_action"     => "index",
                    "_method"     => "get",
                    "_args"       => array('id' => 1),
                ),
                "/home" => array(
                    "_template"   => "Cdm/PronoBox/template/home/index",
                    "_controller" => "Cdm/PronoBox/Home",
                    "_action"     => "index",
                    "_method"     => "get",
                    "_args"       => array('id' => 1),
                ),
                "/utilisateur/edit/@id" => array(
                    "_template"   => "Cdm/UtilisateurBox/template/edit",
                    "_controller" => "Cdm/UtilisateurBox/Utilisateur",
                    "_action"     => "edit",
                    "_method"     => "get",
                    "_args"       => array('id'),
                ),
                "/utilisateur/@id" => array(
                    "_template"   => "Cdm/UtilisateurBox/template/utilisateur",
                    "_controller" => "Cdm/UtilisateurBox/Utilisateur",
                    "_action"     => "obtenir",
                    "_method"     => "get",
                    "_args"       => array('id'),
                ));


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
                var_dump($url);
                var_dump($r);
                $end_r = str_replace("@","",end($r));
                $_args[$end_r] = end($url);

                $routes[$route]['_args'] = $_args;
                
                $rrr = $routes[$route];
                //var_dump($args);
                $true = true;
            } else {
                $true = true;
            }
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
    
    var_dump($route['_args']);
    
    $action = $route['_action']."Action";
    
    if(true) {
        $view = $controller->$action($request,$route['_args']);
    } else {
        $view = $controller->$action($request);
    }
  
    $template = $route["_template"];
    
   // header("Status: 200 OK", false, 200);
    include("source/".$route['_template'].".php");
} else {
    var_dump('error');
}