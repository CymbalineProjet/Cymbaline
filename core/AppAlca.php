<?php

namespace core;


class AppAlca {
    
    static function registerRole() {
        $roles = array(
            "/login"      => array("anonymous","user","admin"),
            "/home"      => array("user", "admin"),
            "/admin" => array("admin"),
        );
        
        return $roles;
    }
}

