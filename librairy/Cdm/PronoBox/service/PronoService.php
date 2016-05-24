<?php

namespace source\Cdm\PronoBox\service;

use core\component\Service;
use source\Cdm\PronoBox\item\Prono;
use source\Cdm\PronoBox\item\Matchs;


use core\component\dbmanager\SqlCommand;

/**
 * Description of UtilisateurService
 *
 * @author Thibault
 */
class PronoService extends Service {

    public function calcul_point(Prono $prono) {

        $point = 0;
        
        $match = new Matchs();
        $this->getManager()->load($match);
        $m = $this->getManager()->getById($prono->getMatchs());
        
        if($m->getVainqueur() == $prono->getVainqueur()) {
            $point = $point + 3;
        } 
        
        if($m->getScoreDom() == $prono->getScoreDom() && $m->getScoreExt() == $prono->getScoreDom()) {
            $point = $point + 2;
        } else if($m->getScoreDom() == $prono->getScoreDom()) {
            $point = $point + 1;
        } else if($m->getScoreExt() == $prono->getScoreExt()) {
            $point = $point + 1;
        }
        
        return $point;  
    }
    
    public function exist(Prono $prono) {
        $sqlcommand = new SqlCommand('Cdm/Prono/Prono');
        $sqlcommand->setSelect("id")
                   ->setWhere("matchs = ".$prono->getMatchs())
                   ->addWhere("utilisateur = ".$prono->getUtilisateur())
                   ->build();
        $data = $sqlcommand->execute();
        
        if(empty($data)) {
            return false;
        } else {
            return true;
        }
        
    }
    
    public function getId(Prono $prono) {
        $sqlcommand = new SqlCommand('Cdm/Prono/Prono');
        $sqlcommand->setSelect("*")
                   ->setWhere("matchs = ".$prono->getMatchs())
                   ->addWhere("utilisateur = ".$prono->getUtilisateur())
                   ->build();
        $data = $sqlcommand->execute();
        return $data->getId();
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
