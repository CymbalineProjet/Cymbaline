<?php

namespace source\User\SecurityBox\item;

use source\User\SecurityBox\item\User;
use core\component\Session;
use core\component\Parametrage;

/**
 * Description of Authentification
 *
 * @author Thibault
 */
class Authentification {
   
    public $user;
    
    public function __construct(User $user) {
        $this->user = $user;
    }
    
    public function authentification_process() {
        $username = $this->user->getUsername();
        $password = $this->user->getPassword();
        $roles = explode(",",$this->user->getRole());
        $param = new Parametrage();
        
        $access = $param->getRoles();
        $access_role = "*";
        
        if(is_array($access->role)) {     
            foreach($access->role as $id => $a) {
                $pos = strpos($_GET['url'], $a->attrib->path);
                if(is_int($pos)) {
                    $access_role = $access->role[$id]->attrib->permission;
                }
            }
        } else {
            foreach($access as $id => $a) {
                $pos = strpos($_GET['url'], $a->attrib->path);
                if(is_int($pos)) {
                    $access_role = $a->attrib->permission;
                }                
            }
        }
        
        $hash = md5($username."".$password);
        $session = new Session();
        
        if($session->_is_register('security.user') && !is_null($session->get('security.user')['user']->getId())) {
            $authentification = $session->get('security.user');
            
            if($authentification['securityContext'] == $hash) {
                $authentification['is_secured'] = true;
            } else {
                $authentification['is_secured'] = false;
            }
            
            $authentification['is_granted'] = false;
            foreach($roles as $role) {
                if($role == $access_role) {
                    $authentification['is_granted'] = true;
                }
            }
            
            if($access_role == "*") {
                $authentification['is_granted'] = true;
            }
            
            $authentification['is_anonymous'] = $this->user->getAnonymous();
            $authentification['user'] = $this->user;
            
            $session->_unregister('security.user');
            $session->_register('security.user', $authentification);
        } else {
            $session->_register('security.user', array(
                "user" => $this->user,
                "roles" => $roles,
                "securityContext" => $hash,
                'is_secured' => true,
                'is_granted' => true,
                'is_anonymous' => $this->user->getAnonymous(),
            ));
        }    
    }
    
}
