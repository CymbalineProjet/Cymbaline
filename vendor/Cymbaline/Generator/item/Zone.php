<?php

namespace Cymbaline\Generator\item;


/**
 * Description of Zone
 * 
 *
 * @author Thibault Jaxx Floyd Jeannet
 */
class Zone {

    private $name;


    public function __construct($name = NULL) {
        if($name != NULL)
            $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function create() {
       
        if (is_dir(__DIR__.'/../../../../source/'.$this->name.'/') && !mkdir(__DIR__.'/../../../../source/'.$this->name.'/', 0777, true)) {
            die("erreur create dir zone $this->name ");
        } else {
            mkdir(__DIR__.'/../../../../source/'.$this->name.'/', 0777, true);
        }
        
    }
    
    public function getList() {
        $dir    = 'source';
        $repertoires = scandir($dir);
        
        foreach ($repertoires as $k => $v) {
            if($v == '.' || $v == '..') {
                unset($repertoires[$k]);
            }
        }
        //var_dump($repertoires);
        return $repertoires;
    }
}
