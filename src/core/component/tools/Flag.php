<?php

namespace core\component\tools;

use core\component\Session;

class Flag extends Session {
	
	const ERROR  = "flag.error";
	const RESULT = "flag.result";
	
	protected $type;
	protected $msg;
	
	
	public function __construct($type = Flag::ERROR) {
		$this->type = $type;
	}
	
	public function setMessage($msg) {
		$this->msg = $msg;
		return $this;
	}
	
	public function getMessage() {
		return $this->msg;
	}
	
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function get($name) {
	
		if($this->exists()) {
			$session = $_SESSION[$this->type];
			
			if(isset($session[$name])) {
				return $session[$name];
			}
		}
		
		return false;
	}
	
	public function send($name) {
	
		if($this->exists()) {
	
			$session = $_SESSION[$this->type];
			$array = array();
			$array['run'] = 1;
			$array['response'] = $this->msg;
			$session[$name] = $array;
			
			$this->_register($this->type, $session);
		} else {
		
			$array = array();
			$array[$name]['run'] = 1;
			$array[$name]['response'] = $this->msg;
			$this->_register($this->type, $array);
		}

	}
	
	public function exists() {
		$return = $this->_is_register($this->type);
		return $return;
	}
	
	public function delete() {
		$this->_unregister($this->type);
	}
	
	static function _delete($type) {
	
		if(isset($_SESSION[$type])) {
		
			foreach($_SESSION[$type] as $id =>$flag) {
				if($flag['run'] == 1) {
					$_SESSION[$type][$id]['run'] = 2;
				} else {
					unset($_SESSION[$type]);
				}
			}	
			
		}
		
	}
}