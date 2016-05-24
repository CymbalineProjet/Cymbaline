<?php

namespace Cymbaline\Tools\ToolBar\controller;

use core\component\tools\View;
use core\component\tools\Flag;
use core\component\Request;
use core\component\Controller;
use core\component\Session;


class ToolBarController extends Controller {

	public function indexAction() {
	
		$session = new Session();
		$member = $this->community()->member();
	
		return new View(array(
			'member' => $member,
		));
	}
}