<?php

namespace Cymbaline\Community\Manager\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use Cymbaline\Community\Manager\form\LoginForm as Login;
use Cymbaline\Community\Manager\item\Manager;

class ManagerController extends Controller {

	public function loginAction() {
	
		$this->_session()->_unregister("community.manager");
        $this->_session()->_unregister("security.community.manager");
		
		$form = new Login();
		$form->action = $this->path('log_manager');
		
		
		return new View(array(

        ), array(
            'form' => $form->create(),
        ));
	}
	
	public function logAction() {
	
		$form = new Login();
		
		if($form->isValid()) {
			$manager = new Manager();
				
			$manager->loadByFilters(array(
				"mail"     => $this->request->get('post')->form_manager->mail,
				"password" => md5($this->request->get('post')->form_manager->password),
			));
			
			if($manager->exists()) {			
				$smanager = serialize($manager);
                $this->_session()->_register("community.manager", $smanager);
				$this->redirect($this->path('login'));
			}
			
		}		
		
	}
}