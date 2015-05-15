<?php

namespace core\component;

use core\component\Parametrage;
use core\component\dbmanager\Dbmanager;
use core\component\Route;
use core\component\Service;
use core\component\exception\CoreException;
use core\component\Session;
use Cymbaline\Utils\Utils;


/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class Controller {
    
    public $post;
    private $get;
    private $session;
    private $parametre;
    private $role;
    public  $retour;
    public $dbmanager;
    public $request;
    public $utils;
    
    public function init($requestSession, Parametrage $param, Request $request) {
        
        $this->session = $requestSession;
        $this->parametre = $param;
        $this->retour = new \stdClass();
        //$this->role = $this->registerRole();
        $this->dbmanager = new Dbmanager();
        $this->request = $request;
        $this->utils = new Utils();
        
    }
    
    public function getManager() {
        return $this->dbmanager;
    }
    
    public function get($service = null) {
        try {
            
            if(is_null($service)) {
                throw new CoreException("Impossible de charger le service. Aucune service renseigné.");
            } else {
                $s = new Service();
                $service = $s->get($service);
               
                return $service;
            }
                        
        } catch (CoreException $e) {
            $e->display();
        }
    }
    
    public function initSecurity($ref) {
        var_dump($this->session->getSession($ref));
    }
    
    public function getParam() {
        return $this->parametre;
    }
    
    public function _session() {
        
        return new Session();
    }

    public function path($name,$args = null) {
        $route = new Route('/');
        $path = $route->createPath($name,$args);
        
        return $path;
    }
    
    public function redirect($url) {
        header("Location: $url");
        exit;
    }
    
    /**
     * Retourne un controller grace au nom de l'item
     * @param string $item
     */
    public function load($item) {
        $path = explode("/", $item);
        $path_end = end($path);
        $p = $path;
        array_pop($p);
        $p = implode("/",$p);

        $control = "source\\".$path[0]."\\".$path[1]."\\controller\\".$path[2]."Controller";
        $vendor = "vendor/".$path[0]."/".$path[1]."/controller/".$path[2]."Controller.php";
        $vendor2 = "vendor/".$p."/controller/".$path_end."Controller.php";
       
        if(file_exists(__DIR__."/../../".$control.".php")) {
            $c = new $control();
        } else if (file_exists(__DIR__."/../../".$vendor)) {
            $control = $path[0]."\\".$path[1]."\\controller\\".$path[2]."Controller";
            $c = new $control();
        } else if (file_exists(__DIR__."/../../".$vendor2)) {
            $control = $p."\\controller\\".$path_end."Controller";
            $c = new $control();
        }

        return $c;
    }
    
    public function dump($var, $die = false) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        
        if($die)
            die;
        
    }
}
