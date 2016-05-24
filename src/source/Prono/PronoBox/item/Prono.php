<?php

namespace source\Prono\PronoBox\item;

use core\component\dbmanager\factory\Factory;

class Prono extends Factory {

	public $_table = "pronos";
	
	protected $id;
	protected $match;
	protected $member;
	protected $scoreDom;
	protected $scoreExt;
	protected $penalties;
	
	protected $_result;
	protected $_point;
	
	public function __construct() {
		parent::__construct();
	}

}