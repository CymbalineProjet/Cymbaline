<?php

namespace core\component\validator;

/**
 * Description of Validator
 *
 * @author Thibault
 */
class Validator {
    //put your code here
    private $_valid;
    
    public function isValid() {
        return $this->_valid;
    }
    
    public function setValid($valid) {
        $this->_valid = $valid;
        return $this;
    }
}
