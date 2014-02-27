<?php

namespace core;


class AppAlca {
    
    
    public function registerController() {

        $controllers = array(
            "Alca" => array (
                "GenBox" => array(
                    "Defaut" => new \source\Alca\GenBox\control\DefautController(),
                ),
                "ErrorBox" => array(
                    "Error" => new \source\Alca\ErrorBox\control\ErrorController(),
                ),
            ),
            "Cdm" => array(
                "PronoBox" => array(
                    "Defaut" => new \source\Cdm\PronoBox\control\DefautController(),
                    "Home"   => new \source\Cdm\PronoBox\control\HomeController(),
                    "Equipe"   => new \source\Cdm\PronoBox\control\EquipeController(),
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

