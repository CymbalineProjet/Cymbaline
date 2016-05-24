<?php

namespace source\Prono\PronoBox\controller;

use Cymbaline\Generator\interfaces\ControllerCRUD;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use Cymbaline\Community\Member\form\LoginForm;
use Cymbaline\Community\Member\item\Member;
use core\component\dbmanager\factory\FactoryQuery;
use Cymbaline\Cymbalog\item\Cymbalog;

use core\component\tools\File;
use source\Prono\PronoBox\item\Match;
use source\Prono\PronoBox\item\Poule;
use source\Prono\PronoBox\item\Equipe;

class PronoController extends Controller {

    public function indexAction() {
	
		$error = null;
		
		if(isset($this->request->get('post')->access)) {

			if($this->flag()->exists()) {
				$error = $this->flag()->get('upload');
			}
		
			$user = new Member();
			$user->loadByFilters(array(
				"lastname" => $this->request->get('post')->lastname,
				"forename" => $this->request->get('post')->forename,
				"password" => md5($this->request->get('post')->password),
			));
			
			$member = serialize($user);
			$this->_session()->_register("community.member", $member);
			
			unset($user);
		}
				
		
		$user = new Member();
		$user->all("point", FactoryQuery::ORDER_DESC);
		
		$equipe = new Equipe();
		$equipe->all("id", FactoryQuery::ORDER_ASC);
		
		$match = new Match();
		
		$query = "  SELECT poules.name as poule, 
						   matchs.date, 
						   edom.name as equipeDom, 
						   eext.name as equipeExt,
						   edom.iso as isoDom,
						   eext.iso as isoExt
					FROM matchs, poules, equipes as edom, equipes as eext
					WHERE matchs.poule = poules.id
					AND matchs.dom = edom.id 
					AND matchs.ext = eext.id
					ORDER BY matchs.date ASC
		";
		
		$match->setQuery($query);
		$match->execute();
		
		//cb_debug($match);
		
	
        return new View(array(
			'error' => $error,
			'classement' => $user,
			'equipes' => $equipe,
			'matchs' => $match,
        ), array(
            //'form' => $form,
        ));
    }
	
	public function classementAction() {
	
		$user = new Member();
		$user->all("point", FactoryQuery::ORDER_DESC);
		
		return new View(array(
			'classement' => $user,
        ), array(
			//'form' => $form,
        ));
	}
	
	public function equipesAction() {
	
		$equipe = new Equipe();
		$equipe->all("id", FactoryQuery::ORDER_ASC);
		
		return new View(array(
			'equipes' => $equipe,
        ), array(
			//'form' => $form,
        ));
	}
	
	public function testAction() {
	
	
		return new View(array(
			'test' => 'test'
        ), array(
			//'form' => $form,
        ));
	}
}