<?php

namespace Cymbaline\Community\Manager\item;

use core\component\dbmanager\factory\Factory;

class Manager extends Factory {

	public $_table = "managers";

	protected $id;
	protected $username;
	protected $password;
	protected $mail;
	protected $role;
	protected $dateRegister;
	protected $dateLastActivity;
	protected $forename;
	protected $lastname;
	protected $_granted;
	protected $_anonymous;

	public function __construct() {
		//do something
		parent::__construct();
		$this->dateLastActivity = new \DateTime();
		$this->dateRegister = new \DateTime();

	}

	public function getGranted() {
		return $this->_granted;
	}

	public function setGranted($granted) {
		$this->_granted = $granted;
		return $this;
	}

	public function setAnonymous($anonymous) {
		$this->_anonymous = $anonymous;
		return $this;
	}

	public function getAnonymous() {
		return $this->_anonymous;
	}
	
	public function exists() {
		if(is_null($this->id))
			return false;
			
		return true;
	}

}