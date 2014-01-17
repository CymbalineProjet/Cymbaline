<?php

namespace Service;

use Entity\Utilisateur;
/**
 * Description of UtilisateurService
 *
 * @author tjeannet
 */
class UtilisateurService {
    
    private $connexion;
    
    public function __construct($connexion) {
        $this->connexion = $connexion;
    }
    
    public function dejaInscrit(Utilisateur $utilisateur) {
        $resultats = $this->connexion->query("SELECT count(*) as nbr FROM utilisateur WHERE nom = '".$utilisateur->getNom()."' and prenom = '".$utilisateur->getPrenom()."' and mail = '".$utilisateur->getMail()."' ");
        $ligne =  $resultats->fetch(\PDO::FETCH_OBJ);

        if($ligne->nbr == "0") {
            return false;
        } else {
            return true;
        }
        
    }
    
    public function codeExistant($code) {
        $resultats = $this->connexion->query("SELECT count(*) as nbr FROM utilisateur WHERE code = ".$code);
        $ligne =  $resultats->fetch(\PDO::FETCH_OBJ);

        if($ligne->nbr == "0") {
            return false;
        } else {
            return true;
        }
    }
    
    public function insert(Utilisateur $utilisateur) {
        $this->connexion->exec("INSERT INTO utilisateur VALUES ('', '".$utilisateur->getNom()."', '".$utilisateur->getPrenom()."', '".$utilisateur->getMail()."', ".$utilisateur->getCode().", now()) ");
    }
}
