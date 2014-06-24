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

    public function exist(Utilisateur $utilisateur, $attr = 'username') {
        
        $this->getManager()->load($utilisateur);
        $user = $this->getManager()->getBy($attr);
        if(empty($user)) {
            return false;
        } else {
            return true;
        }
        
    }
    
    public function count() {
        $m = $this->getManager();
        $m->load(new Utilisateur());
        $users = Utilisateur::hydrateAll($m->get());
        
        return sizeof($users);
    }
    
    public function get_classement(Utilisateur $utilisateur = null) {
        
        $sqlcommand = new SqlCommand('Cdm/Utilisateur/Utilisateur');
        $sqlcommand->setSelect("*")
                   ->setOrderBy('point DESC, username ASC')
                   ->build();
        $data = $sqlcommand->execute();
        
        if(is_null($utilisateur)) {
            return $data;
        } else {
            foreach($data as $id => $user) {
                if($user->getId() == $utilisateur->getId()) {
                    $utilisateur->classement = $id+1;
                    break;
                }
            }
            return $utilisateur;
        }
    }
    
    public function get_publication() {
        $utilisateur = new Utilisateur();
        $m = $this->getManager();
        $m->load($utilisateur);
        $users = Utilisateur::hydrateAll($m->get());
        
        return $users;
    }
    
}
