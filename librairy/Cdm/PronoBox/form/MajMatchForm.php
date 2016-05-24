<?php

namespace source\Cdm\PronoBox\form;

use core\component\tools\Form;
use source\Cdm\PronoBox\item\Matchs;


/**
 * Description of ParametersForm
 *
 * @author Thibault
 */
class MajMatchForm extends Form {
    
    

    public function __construct($item) {
        $this->setName('form_maj');
        if(is_null($item) || !isset($item)) {
            $this->build();
        } else {
            $this->build($item);
        }
    }
    
    public function build($item = null) {     
        
        if(is_null($item)) {
            $item = new Matchs();
        }
        
        
        
        $this->add('scoredom', 'number', array(
            "required" => "required",
            "value"    => $item->getScoredom(),
        ), array(
            "value" => "Score domicile",
        ));

        $this->add('scoreext','number', array(         
            "required" => "required",
            "value"    => $item->getScoreext(),
        ), array(
            "value" => "Score extérieur",
        ));

        
        
    }
}
