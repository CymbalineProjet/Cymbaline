<?php
namespace NBAData\controller;

use core\component\tools\View;
use core\component\Controller;
use core\component\Parametrage;

use NBAData\API\NBA_API;


class ApiController extends Controller {

	protected $_api;
	protected $_param;
	protected $_token;
	protected $_user_agent;

	public function __construct() {
		$this->initApi();
	}

	public function initApi() {
		$param = new Parametrage();
		$p = $param->getParam();
		$this->_param = $p->parameters;
		$this->_param_api = $p->parameters->nba_api;
		$this->_token = $this->_param_api->token;
		$this->_user_agent = $this->_param_api->user_agent;
		$this->_api = new NBA_API($this->_token,$this->_user_agent);
	}

	
}