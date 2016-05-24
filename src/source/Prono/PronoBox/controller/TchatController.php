<?php

namespace source\Prono\PronoBox\controller;

use Cymbaline\Generator\interfaces\ControllerCRUD;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\dbmanager\factory\FactoryQuery;

use Cymbaline\Community\Member\item\Member;
use source\Prono\PronoBox\item\Tchat;

class TchatController extends Controller {

    public function newAction() {
	
		$tchat = new Tchat();
		$content = cb_esc_db($this->request->get('post')->content);
		$tchat->set('content',$content);
		$tchat->set('member',$this->community()->member()->getId());
		
		$date = new \DateTime();
		$tchat->set('date', $date->format('Y-m-d H:i:s'));
		$tchat->save();

		
		if($tchat->_isExecuted) {
			echo 1;
		} else {
			echo 2;
		}
	
		exit;
	}
	
	public function loadAction() {
		
		$tchat = new Tchat();
		$tchat->all('date', FactoryQuery::ORDER_DESC);
		$datas = array('lines' => $tchat->getDatas());

		if($tchat->countDatas() == 0)
			echo 0;
		else
			echo json_encode($datas);
		
		exit;
	}
}