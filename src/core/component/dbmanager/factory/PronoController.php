<?php

namespace source\Prono\PronoBox\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use Cymbaline\Community\Member\form\LoginForm;
use Cymbaline\Community\Member\item\Member;
use core\component\dbmanager\factory\FactoryQuery;
use source\Demo\DemoBox\item\Demo;
use Cymbaline\Cymbalog\item\Cymbalog;

class PronoController extends Controller {

    public function indexAction() {
	$_SESSION["user"] = null;
	
		$log = new Cymbalog();
		$log->log(" in ".__FUNCTION__." line ".__LINE__." : ".json_encode($_SESSION);
	
		//cb_debug($this->_session(),false);
		if(isset($this->request->get('post')->access)) {
		
				
            

                $user = new Member();
                $user->loadByFilters(array(
                    "lastname" => $this->request->get('post')->lastname,
                    "forename" => $this->request->get('post')->forename,
                    "password" => $this->request->get('post')->password,
                ));
				

                $this->_session()->_register("user", $user);
				$_SESSION["user"] = $user; 
				
				
				
                //$this->redirect($this->path('home'));
            
        }
	
		$log = new Cymbalog();
		$log->log(" in ".__FUNCTION__." line ".__LINE__." : ".json_encode($_SESSION);
	
        return new View(array(

        ), array(

        ));
    }
}