<?php

namespace Cymbaline\Community\Member\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\tools\File;

use Cymbaline\Community\Member\form\LoginForm;
use Cymbaline\Community\Member\item\Member;
use core\component\dbmanager\factory\FactoryQuery;

use Cymbaline\Tools\Upload\item\Upload;

class MemberController extends Controller {

    public function loginAction() {
	
        $this->_session()->_unregister("community.member");
        $this->_session()->_unregister("security.community.member");
		
		$form = new LoginForm();
        $form->setMethod('post');
        $form->setAction($this->path('index'));

        if(isset($this->request->get('post')->access)) {

            try {

                $member = new Member();
				$exists = false;
				
				$member->loadByFilters(array(
                    "mail"     => $this->request->get('post')->email,
                ));
				
				if($member->exists()) {
					$exists = true;
				} 
				
				$member = new Member();
				
                $member->loadByFilters(array(
                    "forename" => $this->request->get('post')->forename,
                    "lastname" => $this->request->get('post')->lastname,
                    "mail"     => $this->request->get('post')->email,
                    "password" => md5($this->request->get('post')->password),
                ));
				
				if(!$member->exists() && !$exists) {
					
					if($_FILES['avatar']['size'] != 0) {
					
						$param = $this->getParam();
						
						$dir = $param->getParam()->parameters->community->member->upload->dir;
						
						$upload = new Upload('avatar');
						$upload->useParameters = true;
						$upload->setDir($dir);
						
					}
				
					$member->set('forename',$this->request->get('post')->forename);
					$member->set('lastname',$this->request->get('post')->lastname);
					$member->set('mail',$this->request->get('post')->email);
					$member->set('password',md5($this->request->get('post')->password));
					$member->set('role','user');
					$member->set('dateRegister',date('Y-m-d H:i:s'));
					$member->set('dateLastActivity',date('Y-m-d H:i:s'));
					$member->set('username',ucfirst($this->request->get('post')->forename).".".ucfirst(substr($this->request->get('post')->lastname,0,1)));					
					$member->save();
					
					
					if(!$member->_isExecuted) {
						return new View(array(
							'error' => "Erreur lors de l'enregistrement du membre.",
						), array(
							'form' => $form,
						));
					}
					
					$upload->setName("member_".$member->getId());
					$upload->upload();
					
						
					if($upload->error) {
						$this->flag()->setMessage($upload->errorMessage)->send('upload');
					}
					
					$member = serialize($member);
					$this->_session()->_register("community.member", $member);
					$this->redirect($this->path('home'));
				
				} else {
					
					return new View(array(
						'error' => "L'utilisateur existe déjà",
					), array(
						'form' => $form,
					));
				}
				
				

                
            } catch (\Exception $e) {
                cb_debug($e);
            }
        }
		
        return new View(array(

        ), array(
            'form' => $form,
        ));
    }
	
	public function logAction() {
		
        $this->_session()->_unregister("community.member");
        $this->_session()->_unregister("security.community.member");        

        $form = new LoginForm();
        $form->setMethod('post');
        $form->setAction($this->path('home'));

        return new View(array(

        ), array(
            'form' => $form,
        ));
    }

    public function indexAction() {
        return new View(array(

        ), array(

        ));
    }
}