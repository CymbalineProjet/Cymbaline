<?php

namespace core\component;

use core\component\dbmanager\Dbmanager;

/**
 * Description of Loader
 *
 * @author Thibault
 */
class Loader {
    
    private $item;
    
    public function __construct($item) {
        $this->item = $item;
    }
    
    
}
