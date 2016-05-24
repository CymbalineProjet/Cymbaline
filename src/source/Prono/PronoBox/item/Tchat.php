<?php

namespace source\Prono\PronoBox\item;

use core\component\dbmanager\factory\Factory;

class Tchat extends Factory {

	public $_table = "tchat";
	
	protected $id;
	protected $content;
	protected $date;
	protected $member;
	
	public function __construct() {
		parent::__construct();
	}

}