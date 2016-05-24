<?php

namespace source\Prono\PronoBox\item;

use core\component\dbmanager\factory\Factory;

class Equipe extends Factory {

	public $_table = "equipes";
	
	protected $id;
	protected $name;
	protected $iso;
	protected $point;
	protected $poule;
	
	public function __construct() {
		parent::__construct();
	}

}