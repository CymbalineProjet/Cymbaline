<?php

namespace core\component;

use core\component\dbmanager\Dbmanager;

/**
 * Description of Service
 *
 * @author Thibault
 */
class Service {
    private $manager;
    
    public function __construct() {
        $this->manager = new Dbmanager();
    }
    
    public function getManager() {
        return $this->manager;
    }
}
