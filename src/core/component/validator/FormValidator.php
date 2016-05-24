<?php

namespace core\component\validator;

use core\component\Request;

/**
 * Description of ValidatorFrom
 *
 * @author Thibault
 */
class FormValidator extends Validator {

	const POST    = 'post';
	const COOKIE  = 'cookie';
	const GET     = 'get';

    public $name;
	public $method;
	public $action;
	
	private $request;
	
    public function __construct() {
        $this->request = new Request();
    }
	
	public function isValid() {
		$this->get();
		
		if(isset($this->request[$this->name]['form_validator'])) {
			if(md5($this->name) == $this->request[$this->name]['form_validator']) {
				return true;
			}
		}
		
		return false;
	}
	
	private function get() {
		switch($this->method) {
			case self::POST :
				$this->request = $_POST;
			break;
			
			case self::GET :
				$this->request = $_GET;
			break;
			
			case self::COOKIE :
				$this->request = $_COOKIE;
			break;
		}
	}
}
