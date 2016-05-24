<?php

namespace source\Prono\PronoBox\item;

use core\component\dbmanager\factory\Factory;

class Match extends Factory {

	public $_table = "matchs";
	
	protected $id;
	protected $scoreDom;
	protected $scoreExt;
	protected $penalties;
	protected $date;
	protected $city;
	protected $dom;
	protected $ext;
	protected $poule;
	
	protected $_result;
	protected $_point;
	
	public function __construct() {
		parent::__construct();
	}

}