<?php

namespace core;


class AppAlca {
    
    
    public function registerController() {

        $controllers = array(
            "Alca" => array (
                "DemoBox" => array(
                    "Defaut" => new \source\Alca\DemoBox\control\DefautController(),
                ),
                "GenBox" => array(
                    "Defaut" => new \source\Alca\GenBox\control\DefautController(),
                ),
            ),
            "Cdm" => array(
                "PronoBox" => array(
                    "Defaut" => new \source\Cdm\PronoBox\control\DefautController(),
                    "Home"   => new \source\Cdm\PronoBox\control\HomeController(),
                ),
                "UtilisateurBox" => array(
                    "Utilisateur" => new \source\Cdm\UtilisateurBox\control\UtilisateurController(),
                ),
            ),
            
        );
        
        return $controllers;
    }
    
    static function registerRole() {
        $roles = array(
            "/login"      => array("anonymous","user","admin"),
            "/home"      => array("user", "admin"),
            "/admin" => array("admin"),
        );
        
        return $roles;
    }
}

