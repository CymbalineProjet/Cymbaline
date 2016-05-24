<?php

namespace Cymbaline\Community\Tools;

use core\component\Session;

class Community {

	const MEMBER  = "community.member";
	const MANAGER = "community.manager";

	private $session;
	private $data;
	
	public function __construct() {
		$this->session = new Session($_SESSION);
	}
	
	public function exists($type = Community::MEMBER) {
		return $this->session->_is_register($type);
	}
	
	public function member() {
		return unserialize($this->session->get(Community::MEMBER));
	}
	
	public function manager() {
		return unserialize($this->session->get(Community::MANAGER));
	}
	
	

}