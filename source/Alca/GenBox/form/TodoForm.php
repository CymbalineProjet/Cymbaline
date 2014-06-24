<?php

namespace source\Alca\GenBox\form;

use core\component\tools\Form;
use source\Alca\GenBox\item\Todo;

/**
 * Description of TodoForm
 *
 * @author Thibault
 */
class TodoForm extends Form {
    
    

    public function __construct() {
        $this->setName('form_todo');
        $this->build();
    }
    
    public function build() {        
        
        $this->add('content', 'text', array(
            "class" => "span4",
        ), array(
            "value" => "Contenu",
            "class"    => "control-label",
			"required" => "required",
        ));
        
        $this->add('flag','radio', array(
		),array(
            "value" => "Traité",
            "class"    => "control-label",
			"required" => "required",
        ), array(
            "1" => "oui",
            "0" => "non",
        ));
        
        
    }
}
