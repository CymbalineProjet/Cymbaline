<?php

namespace source\User\SecurityBox\item;


/**
 * Description of User
 * 
 *
 * @author Thibault Jaxx Floyd Jeannet
 */
class User {
    
    /**
     * #type=int#
     * #name=id#
     */
    private $id;
    
    /**
     * #type=string#
     * #name=username#
     */
    private $username;
    
    /**
     * #type=string#
     * #name=password#
     */
    private $password;
    
    /**
     * #type=string#
     * #name=mail#
     */
    private $mail;
    
    /**
     * #type=datetime#
     * #name=nodate_register#
     */
    private $date_register;
    
    /**
     * #type=datetime#
     * #name=date_last_activity#
     */
    private $date_last_activity;
    
    private $_granted;
    private $_anonymous;


    public function __construct() {
         //do something
         $this->date_last_activity = new \DateTime();
         $this->date_register = new \DateTime();
        
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($pwd) {
        $this->password = $pwd;
        return $this;
    }
    
    public function getGranted() {
        return $this->granted;
    }
    
    public function setGranted($granted) {
        $this->granted = $granted;
        return $this;
    }
    
    public function getRoles() {
        return array("user");
    }
    
    public function setAnonymous($anonymous) {
        $this->anonymous = $anonymous;
        return $this;
    }
    
    public function getAnonymous() {
        return $this->anonymous;
    }
    
    public function getDateRegister() {
        return $this->date_register;
    }
    
    public function setDateRegister($date) {
        $this->date_register = $date;
        return $this;
    }
    
    public function getDateLastActivity() {
        return $this->date_last_activity;
    }
    
    public function setDateLastActivity($date) {
        $this->date_last_activity = $date;
        return $this;
    }
    
    public function getMail() {
        return $this->mail;
    }
    
    public function setMail($mail) {
        $this->mail = $mail;
        return $this;
    }
    
}
