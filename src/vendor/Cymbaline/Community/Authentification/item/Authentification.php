<?php

namespace Cymbaline\Community\Authentification\item;

use Cymbaline\Community\Member\item\Member;
use core\component\Session;
use core\component\Parametrage;

/**
 * Description of Authentification
 *
 * @author Thibault
 */
class Authentification {

    public $user;

    public function __construct(Member $user) {
        $this->user = unserialize($user);
    }

    public function authentification_process() {
	
        $username = $this->user->get('username');
        $password = $this->user->get('password');
        $roles = explode(",",$this->user->get('role'));
        $param = new Parametrage();

		$this->user->set('dateLastActivity',date('Y-m-d H:i:s'));
		$this->user->update();

        $access = $param->getParam()->parameters->roles;
        $access_role = false;

        foreach($access as $id => $a) {
			$pos = strpos($_GET['url'], $a);
			if(is_int($pos)) {
				$access_role = true;
			}
		}
		

        $hash = md5($username."".$password);
        $session = new Session();

        if($session->_is_register('security.community.member')) {
            $authentification = $session->get('security.community.member');

            if($authentification['securityContext'] == $hash) {
                $authentification['is_secured'] = true;
            } else {
                $authentification['is_secured'] = false;
            }

            if($authentification['securityContext'] == 'first') {
                $authentification['securityContext'] = $hash;
                $authentification['is_secured'] = true;

            }

            $authentification['is_granted'] = $access_role;


            $authentification['is_anonymous'] = false;
            $authentification['user'] = $this->user;
            //warning
            //$authentification['is_secured'] = true;
            $session->_unregister('security.community.member');
            $session->_register('security.community.member', $authentification);

        } else {
            $session->_register('security.community.member', array(
                "user" => $this->user,
                "roles" => $roles,
                "securityContext" => 'first',
                'is_secured' => true,
                'is_granted' => true,
                'is_anonymous' => false,
            ));
        }
		
		
    }

}
