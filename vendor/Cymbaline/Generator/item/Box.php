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
       
        if (is_dir('source/'.$this->zone.'/'.$this->name.'/') && !mkdir('source/'.$this->zone.'/'.$this->name.'/', 0777, true)) {
            die("erreur create dir box $this->zone/$this->name ");
        } else {
            mkdir('source/'.$this->zone.'/'.$this->name.'/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/control/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/form/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/item/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/loader/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/ressources/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/ressources/css/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/ressources/images/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/ressources/js/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/service/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/template/', 0777, true);
            mkdir('source/'.$this->zone.'/'.$this->name.'/template/base/', 0777, true);
        }
    }
    
}
