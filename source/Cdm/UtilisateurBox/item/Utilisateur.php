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
     * #type=string#
     * #name=message#
     */
    private $message;
    
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
    private $_classement;
    


    public function __construct() {
         //do something
         $this->complet = false;
         $this->point = 0;
         $this->valide = false;
         
    }
    
    public function setClassement($classement) {
        $this->_classement = $classement;
        return $this;
    }
    
    public function getClassement() {
        return $this->_classement;
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
    
    public function getPoint() {
        return $this->point;
    }
    
    public function setPoint($point) {
        $this->point = $point;
        return $this;
    }
    
    public function getValide() {
        return $this->valide;
    }
    
    public function setValide($valide) {
        $this->valide = $valide;
        return $this;
    }
    
    public function getComplet() {
        return $this->complet;
    }
    
    public function setComplet($complet) {
        $this->complet = $complet;
        return $this;
    }
    
    public function getMessage() {
        return $this->message;
    }
    
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }
    
    public function hydrate(\stdClass $user) {
        
        $utilisateur = new Utilisateur();
        
        foreach($user as $attr => $value) {
            
            $attribut = "set".ucfirst($attr);
            $utilisateur->$attribut($value);
          
        }
        
        return $utilisateur;
    }
    
    static function hydrateAll(array $users) {
        
        $user = new \stdClass();
        $e = new Utilisateur();
        
        foreach($users as $attr => $value) {
            
            foreach($value as $id => $valeur) {
                
                if(!is_int($id)) {
                    
                    $user->{$id} = $valeur;
                    //var_dump($equipe);
                }
                
            }
            //var_dump($equipe);
            $users[$attr] = $e->hydrate($user);
            unset($user);
            $user = new \stdClass();
        }
        
        return $users;
        
    }
    
    
}
