<?php

namespace core\component;

use core\component\dbmanager\Dbmanager;
use core\component\exception\CoreException;
use core\component\Session;

/**
 * Description of Service
 *
 * @author Thibault
 */
class Service {
    
    private $manager;
    private $name;
    
    public function __construct() {
        $this->manager = new Dbmanager();
    }
    
    public function getManager() {
        return $this->manager;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function get($service) {
        try {
            
            $services = explode("/",$service);

            if(sizeof($services) != 3) {
                throw new CoreException("Service invalide. Verifié le chemin passé dans le controller.");
            }

            $path = "source\\".ucfirst($services[0])."\\".ucfirst($services[1])."Box\\service\\".ucfirst($services[2])."Service";
            $_service = new $path();

            return $_service;

        } catch (CoreException $e) {
            $e->display();
        }
        
    }
    
    public function getSession() {
       return new Session();        
    }
    
}
