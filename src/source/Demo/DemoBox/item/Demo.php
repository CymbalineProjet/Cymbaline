<?php

namespace source\Demo\DemoBox\item;

use core\component\dbmanager\factory\Factory;

/**
 * Description of Demo
 * 
 *
 * @author Thibault Jeannet
 */
class Demo extends Factory {

	public $_table = "demo";

	protected $id;
	protected $date;
	protected $label;
	protected $flag;

}
