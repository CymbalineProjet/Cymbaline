<?php

namespace source\Prono\PronoBox\item;

use core\component\dbmanager\factory\Factory;

class Poule extends Factory {

	public $_table = "poules";
	
	protected $id;
	protected $name;
	
	public function __construct() {
		parent::__construct();
	}

}