<?php

namespace source\Cdm\UtilisateurBox\item;


/**
 * Description of Utilisateur
 * 
 * 
 * @author Thibault Jaxx Floyd Jeannet
 */
class Utilisateur extends \source\User\SecurityBox\item\User {

    /**
     * #type=string#
     * #name=nom#
     */
    private $nom;
    
    /**
     * #type=string#
     * #name=prenom#
     */
    private $prenom;
    
    /**
     * #type=int#
     * #name=point#
     */
    private $point;
    
    /**
     * #type=bool#
     * #name=valide#
     */
    private $valide;
    
    /**
     * #type=bool#
     * #name=complet#
     */
    private $complet;
    private $_test;


    public function __construct() {
         //do something
         $this->complet = false;
         $this->point = 0;
         $this->valide = false;
         
    }
    
    
    
    public function getNom() {
        return $this->nom;
    }
    
    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }
    
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }
    
    public function getPrenom() {
        return $this->prenom;
    }
    
    

    
}
