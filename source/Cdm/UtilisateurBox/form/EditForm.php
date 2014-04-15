<?php

namespace source\Cdm\UtilisateurBox\form;

use core\component\tools\Form;


/**
 * Description of ParametersForm
 *
 * @author Thibault
 */
class EditForm extends Form {
    
    

    public function __construct() {
        $this->setName('form_edit');
        $this->build();
    }
    
    public function build() {        
        
        $this->add('nom', 'text', array(
            "class" => "span4",
            "required" => "required",
        ), array(
            "value" => "Nom",
            "class"    => "control-label",
        ));
        
        $this->add('prenom','text', array(
            "class" => "span4",          
            "required" => "required",
        ), array(
            "value" => "Pr&eacute;nom",
            "class"    => "control-label",
        ));
        
        $this->add('username','text', array(
            "class" => "span4",      
            "required" => "required",
        ), array(
            "value" => "Pseudo",
            "class"    => "control-label",
        ));
        
        
        
        
    }
}
