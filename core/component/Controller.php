<?php

namespace core\component;

use core\component\Parametrage;
use core\AppAlca;
use core\component\dbmanager\Dbmanager;
use core\component\Route;
use core\component\Service;
use core\component\exception\CoreException;


/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class Controller extends AppAlca {
    
    public $post;
    private $get;
    private $session;
    private $parametre;
    private $role;
    public  $retour;
    public $dbmanager;
    public $request;
    
    public function init($requestSession, Parametrage $param, Request $request) {
        
        $this->session = $requestSession;
        $this->parametre = $param;
        $this->retour = new \stdClass();
        $this->role = $this->registerRole();
        $this->dbmanager = new Dbmanager();
        $this->request = $request;
        
        
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
        
        return $this->session;
    }

    public function path($name) {
        $route = new Route('/');
        $path = $route->createPath($name);
        
        return $path;
    }
    
    /**
     * Retourne un controller grace au nom de l'item
     * @param string $item
     */
    public function load($item) {
        //$controller = parent::registerController();
        $path = explode("/", $item);
       
        $control = "source\\".$path[0]."\\".$path[1]."\\control\\".$path[2]."Controller";
        $c = new $control();
        
        return $c;
    }
    

}
