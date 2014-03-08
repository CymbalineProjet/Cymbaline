<?php

namespace source\User\SecurityBox\item;

use source\User\SecurityBox\item\User;
use core\component\Session;

/**
 * Description of Authentification
 *
 * @author Thibault
 */
class Authentification {
   
    private $user;
    private $auth;
    
    public function __construct(User $user) {
        $this->user = $user;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }
    
    public function  getAuth() {
        return $this->auth;
    }
    
    public function setAuth($auth) {
        $this->auth = $auth;
        return $this;
    }
    
    public function authentification_process() {
        $username = $this->user->getUsername();
        $password = $this->user->getPassword();
        $roles = explode(",",$this->user->getRole());
        
        $hash = md5($username."".$password);
        $session = new Session();
        if($session->_is_register('security.auth')) {
            $authentification = $session->get('security.auth');
            
            if($authentification['securityContext'] == $hash) {
                $authentification['is_secured'] = true;
            } else {
                $authentification['is_secured'] = false;
            }
            
            foreach($roles as $role) {
                if($role == "admin") {
                    $authentification['is_granted'] = true;
                } else {
                    $pos = strpos($_GET['url'], "admin");
                    if(is_int($pos)) {
                        $authentification['is_granted'] = false;
                    } else {
                        $authentification['is_granted'] = true;
                    }
                }
            }
            
            $session->_unregister('security.auth');
            $session->_register('security.auth', $authentification);
        } else {
            $session->_register('security.auth', array(
                "user" => $this->user,
                "roles" => $role,
                "securityContext" => $hash,
                'is_secured' => true,
                'is_granted' => true,
            ));
        }
        
    }
    
}
