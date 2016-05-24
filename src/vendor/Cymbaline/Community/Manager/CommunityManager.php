<?php

namespace Cymbaline\Community\Manager;

use Cymbaline\Community\Authentification\item\Authentification;
use Cymbaline\Community\Authentification\service\AuthentificationService;
use Cymbaline\Community\Manager\item\Manager;
use core\component\exception\CoreException;
use core\component\exception\DeniedException;
use core\component\exception\TemplateException;
use core\component\Route;
use core\component\Parametrage;
use Cymbaline\Cymbalog\item\Cymbalog;

class CommunityManager {

    static function authentification($session,$request) {

	
		$route = new Route($request->get('get')->url);
		$param = new Parametrage();
		
		$exclude = $param->getParam()->parameters->community->member->authentification->exclude;
		

		
		if(!in_array($route->getName(),$exclude)) {
		
			if(!$session->_is_register("community.manager") && isset($request->get('post')->access)) {

				$user = new Manager();
				$user->setAnonymous(true);
				$session->_register("community.manager", $user);
			}

			if($session->_is_register("community.manager")) {
			
				$authentification = new Authentification($session->get('community.manager'));
				$authentification->authentification_process();
				$sAuth = new AuthentificationService();
				if($sAuth->is_anonymous()) {
					throw new DeniedException('Error authentification denied anonymous');
				}

				if(!$sAuth->is_authentified() && isset($request->get('post')->identifiant)) {
					throw new DeniedException('Error authentification denied');
				}

				if(!$sAuth->is_granted()) {
					throw new DeniedException('Error authentification not granted !');
				}
			} else {
				throw new DeniedException('Error authentification denied no session');
			}

		}
    }
}