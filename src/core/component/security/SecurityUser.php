<?php

namespace core\component\security;

/**
 * Description of SecurityUser
 *
 * @author Thibault
 */
class SecurityUser extends Security {
    //put your code here
    private $user;
    private $user_role;
    private $_role_path;
    
    public function __construct($user) {
        $this->user = $user;
        
        $this->user_role = $user->getRoles();
    }
    
    public function setRole(array $roles) {
        $this->user_role = $roles;
        return $this;
    }
    
    public function getRole() {
        return $this->user_role;
    }
    
    public function is_granted() {
        $roles = \core\AppAlca::registerRole();
        
        foreach ($roles as $k => $role) {
            if($k != "/") {
                $pos = strpos($_SERVER['REQUEST_URI'],$k);
                if($pos !== false) {
                    $this->_role_path = $role;
                }
            }
        }
        
        $return = false;
        
        foreach ($this->user_role as $role) {
            if(in_array($role, $this->_role_path)) {
                $return = true;
            }
        }
        
        return $return;
    }
}
