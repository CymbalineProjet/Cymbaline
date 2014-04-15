<?php

namespace source\User\SecurityBox\service;


/**
 * Description of AuthentificationService
 *
 * @author Thibault
 */
class AuthentificationService extends \core\component\Service {
    
    public function is_authentified() {
        $session = $this->getSession();
        
        if($session->_is_register('security.user')) {
            $auth = $session->get('security.user');
            if($auth['is_secured']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
	
	public function is_anonymous() {
        $session = $this->getSession();
        
        if($session->_is_register('security.user')) {
            $auth = $session->get('security.user');
            if($auth['is_anonymous']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function is_granted() {
        $session = $this->getSession();
        
        if($session->_is_register('security.user')) {
            $auth = $session->get('security.user');
            
            if($auth['is_granted']) {
                return true;
            } else {
                return false;
            }
        } else {
          
            return false;
        }
    }
    
}
