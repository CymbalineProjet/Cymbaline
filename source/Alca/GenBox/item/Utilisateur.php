<?php

namespace Entity;
/**
 * Description of Utilisateur
 *
 * @author tjeannet
 */
class Utilisateur {
    
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $code;
    private $date;
    
    public function getId() {
        return $this->id;
    }
    
    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }
    
    public function getPrenom() {
        return $this->prenom;
    }
    
    public function setMail($mail) {
        $this->mail = $mail;
        return $this;
    }
    
    public function getMail() {
        return $this->mail;
    }
    
    public function setCode($code) {
        $this->code = $code;
        return $this;
    }
    
    public function getCode() {
        return $this->code;
    }
    
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }
    
    public function getDate() {
        return $this->date;
    }
    
}
