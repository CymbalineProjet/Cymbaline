<?php

namespace source\Prono\PronoBox\service;

use core\component\Service;

use Cymbaline\Community\Member\item\Member;
use core\component\dbmanager\factory\FactoryQuery;

class PronoService extends Service {

	public function getClassementFromSession() {
	
		$session = $this->getSession();
		
		if($session->_is_register('community.member')) {
            $user = unserialize($session->get('community.member'));
            
			$members = new Member();
			$members->all("point", FactoryQuery::ORDER_DESC);
			$i = 1;
			foreach($members->getDatas() as $member) {
				if($user->getId() == $member->id) {
					return $i;
					exit;
				}
				
				$i++;
			}
			
        } else {
            return false;
        }
	
	}

}