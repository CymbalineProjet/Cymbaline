<?php

namespace core\component\tools;


/**
* Converti $array en objet
* 
* 
* $arraytoobject = new ArrayToObject($array,FALSE);
* 
* $converted = $arraytoobject->convert();
* 
* @param array $array
* @param boolean $return
* @return object
 * @author Thibault Jeannet thibault.jeannet@gmail.com
*/
class ArrayToObject {

    
    /**
     * 
     * @var array $array
     */
    private $array;
    
    /**
     *
     * @var object $object
     */
    public $object;

    
    public function __construct(array $array) {      
        $this->array = $array;
        $this->init();
        
    }
    
    private function init() {
        $this->object = json_decode(json_encode($this->array), FALSE);
    }
    
    public function convert() {
        return json_decode(json_encode($this->array), FALSE);
    }
    
}
