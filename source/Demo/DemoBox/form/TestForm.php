<?php

namespace source\Demo\DemoBox\form;

use core\component\tools\Form;

/**
 * Description of TestForm
 *
 * @author jaxx
 */
class TestForm extends Form {
    
    

    public function __construct() {
        $this->setName('form_test');
        $this->build();
    }
    
    public function build() {        
        
        $this->add('label', 'text', array(
            "class" => "span4",
        ), array(
            "value" => "Label",
            "class"    => "control-label",
        ));

        #build#
        
       
    }
}
