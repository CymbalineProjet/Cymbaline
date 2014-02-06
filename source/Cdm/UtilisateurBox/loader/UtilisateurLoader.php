<?php

namespace source\Cdm\UtilisateurBox\loader;

use source\Cdm\UtilisateurBox\item\Utilisateur;

/**
 * Description of UtilisateurLoader
 *
 * @author Thibault
 */
class UtilisateurLoader {
    //put your code here
    
    public function load(Utilisateur $utilisateur) {
        
        
        $utilisateur->setNom("Thibault");
        $utilisateur->setDateLastActivity(new \DateTime());
        $utilisateur->setDateRegister(new \DateTime());
        $utilisateur->setPassword("pwd");
        $utilisateur->setMail("test@test.com");
        $utilisateur->setAnonymous(false);
       
        
        //var_dump($utilisateur);
        
        return $utilisateur;
    }
}
