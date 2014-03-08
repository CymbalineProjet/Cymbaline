<?php

namespace source\User\SecurityBox\service;

use core\component\Session;

/**
 * Description of AuthentificationService
 *
 * @author Thibault
 */
class AuthentificationService extends \core\component\Service {
    
    public function is_authentified() {
        $session = new Session();
        
        if($session->_is_register('security.auth')) {
            $auth = $session->get('security.auth');
            if($auth['is_secured']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function is_granted() {
        $session = new Session();
        
        if($session->_is_register('security.auth')) {
            $auth = $session->get('security.auth');
            if($auth['is_secured'] && $auth['is_granted']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
}
