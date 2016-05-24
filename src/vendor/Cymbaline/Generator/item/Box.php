<?php

namespace Cymbaline\Generator\item;


/**
 * Description of Box
 * 
 *
 * @author Thibault Jaxx Floyd Jeannet
 */
class Box {

    private $name;
    private $zone;


    public function __construct($name, $zone) {
         $this->name = $name;
         $this->zone = $zone;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function getZone() {
        return $this->zone;
    }
    
    public function setZone($zone) { 
        $this->zone = $zone;
        return $this;
    }
    
    public function create() {
       
        if (is_dir('source/'.$this->zone.'/'.$this->name.'Box/') && !mkdir('source/'.$this->zone.'/'.$this->name.'Box/', 0777, true)) {
            die("erreur create dir box $this->zone/$this->name ");
        } else {
            mkdir(__DIR__.'/../../../../source/'.$this->zone.'/'.$this->name.'Box/', 0777, true);
            mkdir(__DIR__.'/../../../../source/'.$this->zone.'/'.$this->name.'Box/controller/', 0777, true);
            mkdir(__DIR__.'/../../../../source/'.$this->zone.'/'.$this->name.'Box/form/', 0777, true);
            mkdir(__DIR__.'/../../../../source/'.$this->zone.'/'.$this->name.'Box/item/', 0777, true);
            mkdir(__DIR__.'/../../../../source/'.$this->zone.'/'.$this->name.'Box/service/', 0777, true);
            mkdir(__DIR__.'/../../../../source/'.$this->zone.'/'.$this->name.'Box/template/', 0777, true);
            mkdir(__DIR__.'/../../../../source/'.$this->zone.'/'.$this->name.'Box/config/', 0777, true);
        }
    }
    
}
