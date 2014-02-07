<?php

namespace source\Cdm\UtilisateurBox\service;

use source\Cdm\UtilisateurBox\item\Utilisateur;


/**
 * Description of UtilisateurService
 *
 * @author Thibault
 */
class UtilisateurService {

    
    public function exist(Utilisateur $utilisateur) {
        return true;
    }
}
