<?php

namespace source\User\SecurityBox\form;

use core\component\tools\Form;


/**
 * Description of ParametersForm
 *
 * @author Thibault
 */
class UserForm extends Form {
    
    

    public function __construct() {
        $this->setName('form_user');
        $this->build();
    }
    
    public function build() {        
        
        $this->add('baseurl', 'text', array(
            "class" => "span4",
        ), array(
            "value" => "Base url",
            "class"    => "control-label",
        ));
        
        $this->add('basetitle','text', array(
            "class" => "span4",          
        ), array(
            "value" => "Titre par d&eacute;faut",
            "class"    => "control-label",
        ));
        
        $this->add('controllerdefault','text', array(
            "class" => "span4",          
        ), array(
            "value" => "Controller par d&eacute;faut",
            "class"    => "control-label",
        ));
        
        $this->add('env','radio', array(
                     
        ), array(
            "value" => "Environnement",
            "class"    => "control-label",
        ), array(
            "dev" => "dev",
            "prod" => "prod",
        ));
        
        
    }
}
