<?php

namespace source\Prono\APIBox;

class API {

	private $used;
	private $secret;
	private $identity;
	
	public $_isAuthorized;
	
	public function __construct() {
		$param = cb_param("api");
		$this->used  = $param->used;
		$this->secret  = $param->secret;
		$this->identity  = $param->identity;
		$this->_isAuthorized = false;
		
	}
	
	public function isAuthorized($identity,$secret) {
		if($identity == $this->identity && $secret == $this->secret) {
			$this->_isAuthorized = true;
		}
	}

}