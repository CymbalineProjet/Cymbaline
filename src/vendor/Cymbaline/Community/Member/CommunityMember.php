<?php

namespace Cymbaline\Community\Member;

use Cymbaline\Community\Authentification\item\Authentification;
use Cymbaline\Community\Authentification\service\AuthentificationService;
use Cymbaline\Community\Member\item\Member;
use core\component\exception\CoreException;
use core\component\exception\DeniedException;
use core\component\exception\TemplateException;
use core\component\Route;
use core\component\Parametrage;
use Cymbaline\Cymbalog\item\Cymbalog;

class CommunityMember {

    static function authentification($session,$request) {

	
		$route = new Route($request->get('get')->url);
		$param = new Parametrage();
		
		$exclude = $param->getParam()->parameters->community->member->authentification->exclude;
		
		if(!in_array($route->getName(),$exclude)) {
		
			if(!$session->_is_register("community.member") && isset($request->get('post')->access)) {

				$user = new Member();
				$user->setAnonymous(true);
				$session->_register("community.member", $user);
			}

			if($session->_is_register("community.member")) {
			
				$authentification = new Authentification($session->get('community.member'));
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