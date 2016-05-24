<?php
session_start();

require_once 'core/autoload.php';

use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;
use core\component\Session;
use core\component\Route;
use core\component\tools\View;
use core\component\tools\Flag;

//ajout pour authentification des membres
use Cymbaline\Community\Member\CommunityMember;

use Cymbaline\Tools\ToolBar\item\ToolBar;


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
	
	//CommunityMember::authentification($session,$request);
	Flag::_delete(Flag::ERROR);
	
	if($param->getParam()->parameters->env == 'dev') {
		
		$toolbar = new ToolBar();
		
	}

    if(isset($r['ressources'])) {
        $view->ressources = $r['ressources'];
    } else {
        $view->ressources = false;
    }

    if(file_exists("source/".$r['template'].".php")) {
        include("source/".$r['template'].".php");
    } else if(file_exists("vendor/".$r['template'].".php")) {
        include("vendor/".$r['template'].".php");

    } else {
        $message = "Aucun template valide pour cette page";
        throw new TemplateException($message);
        exit;
    }
	
	exit;
	
} catch(\Exception $e) {

    echo $e->getMessage();die;
}