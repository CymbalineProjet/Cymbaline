<?php

namespace source\Cdm\UtilisateurBox\service;


use core\component\Service;
use source\Cdm\UtilisateurBox\item\Utilisateur;



/**
 * Description of UtilisateurService
 *
 * @author Thibault
 */
class UtilisateurService extends Service {

    
    
    
    public function exist(Utilisateur $utilisateur) {
        
        $this->getManager()->load($utilisateur);
        $user = $this->getManager()->getBy('username');
        if(empty($user)) {
            return false;
        } else {
            return true;
        }
        
    }
}
