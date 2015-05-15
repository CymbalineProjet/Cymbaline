<?php

namespace source\Demo\DemoBox\form;

use core\component\tools\Form;

use source\Demo\DemoBox\Test\item\Test;

/**
 * Description of TestForm
 *
 * @author jaxx
 */
class TestEditForm extends Form {
    
    public function __construct(Test $item) {
        $this->setItem($item);
        $this->setName('form_edit_test');
        $this->build();
    }
    
    public function build() {        
        
        $this->add('label', 'text', array(
            "class" => "span4",
            "value" => $this->getItem()->getLabel(),
        ), array(
            "value" => "Label",
            "class"    => "control-label",
        ));
       
    }
}
