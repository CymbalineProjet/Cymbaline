<?php

namespace source\Cdm\UtilisateurBox\loader;

use source\Cdm\UtilisateurBox\item\Utilisateur;
use core\component\Loader;

/**
 * Description of UtilisateurLoader
 *
 * @author Thibault
 */
class UtilisateurLoader extends Loader {
    //put your code here
    
    
    
    public function load(Utilisateur $utilisateur) {
       
        $m = $this->getManager();
        
        $m->load($utilisateur);
        $utilisateur = new Utilisateur();
        $utilisateur = $m->getBy();
        
        return $utilisateur;
    }
}
