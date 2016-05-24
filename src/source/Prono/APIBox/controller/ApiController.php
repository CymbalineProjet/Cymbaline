<?php

namespace source\Prono\APIBox\controller;

use core\component\Controller;
use core\component\Request;
use core\component\tools\View;
use core\component\dbmanager\factory\FactoryQuery;

use source\Prono\APIBox\API;
use Cymbaline\Community\Member\item\Member;

class ApiController extends Controller {

	private $api;
	private $response;
	
	public function __construct() {
		
		$this->api = new API();
		$json = json_encode(array('error' => 'no datas'));
		$this->response = $json;
		
	}
	
	
	public function indexAction() {
		
		$this->api->isAuthorized($this->request->get('post')->api,$this->request->get('post')->secret);
		if($this->api->_isAuthorized) {
			$mail = $this->request->get('post')->mail;
			$pwd = $this->request->get('post')->pwd;
			
			$user = new Member();
			$user->loadByFilters(array(
				"mail" => $mail,
				"password" => md5($pwd),
			));
			
			
			if($user->exists()) {
				echo json_encode(array('error' => false, 'user' => $user->getDatas()));
				exit;
			} 
			
			echo json_encode(array('error' => true));
			exit;
		} else {
			echo json_encode(array('error' => true));
			exit;
		}
	
		cb_debug($this->request->get('post'));
	 
		$get = json_encode($this->request->get('post'));
		echo $get;
		exit;
	}
	
	public function classementAction() {
	
		$this->api->isAuthorized("api_prono16",md5("prono16"));
		
		if($this->api->_isAuthorized) {
			$user = new Member();
			$user->all("point", FactoryQuery::ORDER_DESC);
			
			echo json_encode($user->getDatas());
			exit;
		} else {
		
		}
		
		echo json_encode(array('error' => 'not authorized'));
		exit;
	}
	
}