<?php

namespace Cymbaline\Administration;

use core\component\tools\ArrayToObject;
use core\component\parser\YamlParser;

class Administration {
	
	public $items;
	
	public function __construct() {
		$yml = file_get_contents(__DIR__."/../../../core/config/administration.yml");
		$yaml = new YamlParser();
		$arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
		$items = $arraytoobject->convert();
		$this->items = $items->items;
	}
}