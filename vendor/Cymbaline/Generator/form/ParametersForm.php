<?php

namespace Cymbaline\Generator\form;

use core\component\tools\Form;

/**
 * Description of ParametersForm
 *
 * @author Thibault
 */
class ParametersForm extends Form {
    
    

    public function __construct() {
        $this->setName('form_parameters');
        $this->build();
    }
    
    public function build() {        
        
        $this->add('baseurl', 'text', array(
            "class" => "span8",
        ), array(
            "value" => "Base url",
            "class"    => "control-label",
        ));
        
        $this->add('basetitle','text', array(
            "class" => "span8",          
        ), array(
            "value" => "Titre par d&eacute;faut",
            "class"    => "control-label",
        ));
        
        $this->add('controllerdefault','text', array(
            "class" => "span8",          
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
