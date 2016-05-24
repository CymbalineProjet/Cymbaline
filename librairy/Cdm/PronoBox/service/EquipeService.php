<?php

namespace source\Cdm\PronoBox\service;

use core\component\Service;
use source\Cdm\PronoBox\item\Equipe;
use source\Cdm\PronoBox\item\Poule;


use core\component\dbmanager\SqlCommand;

/**
 * Description of UtilisateurService
 *
 * @author Thibault
 */
class EquipeService extends Service {

    public function equipe_by_poule() {
        
        $m = $this->getManager();
        $m->load(new Poule());
        $poules = Poule::hydrateAll($m->get());
        $equipes = array();
        
        $i = 0;
        foreach($poules as $poule) {
            $e = new Equipe();
            $e->setPoule($poule->getId());
            $m->load($e);
            $equipes[$i]['equipes'] = $m->getAllBy('poule');
            $equipes[$i]['poule'] = $poule;
            $i++;
        }
      
        return $equipes;
    }

    
    /*public function get_classement() {
        $sqlcommand = new SqlCommand('Cdm/Utilisateur/Utilisateur');
        $sqlcommand->setSelect("*")
                   ->setOrderBy('point DESC, username ASC')
                   ->build();
        $data = $sqlcommand->execute();
        return $data;
    }*/
    
}
