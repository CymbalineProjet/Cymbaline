<?php

namespace Cymbaline\Administration\form;

use core\component\interfaces\IForm;
use core\component\tools\Form;

/**
 * Description of TodoForm
 *
 * @author Thibault
 */
class TasksForm extends Form implements IForm {
    
    

    public function __construct() {
        $this->setName('form_tasks');
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
        
        /*$this->add('flag','radio', array(
		),array(
            "value" => "Traité",
            "class"    => "control-label",
			"required" => "required",
        ), array(
            "1" => "oui",
            "0" => "non",
        ));*/
        
        
    }
}
