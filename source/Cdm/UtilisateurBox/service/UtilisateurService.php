<?php

namespace source\Cdm\UtilisateurBox\service;

use core\component\Service;
use source\Cdm\UtilisateurBox\item\Utilisateur;

use core\component\dbmanager\SqlCommand;

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
    
    public function get_classement() {
        $sqlcommand = new SqlCommand('Cdm/Utilisateur/Utilisateur');
        $sqlcommand->setSelect("*")
                   ->setOrderBy('point DESC, username ASC')
                   ->build();
        $data = $sqlcommand->execute();
        return $data;
    }
    
}
