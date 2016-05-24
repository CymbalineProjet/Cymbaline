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
     * #type=string#
     * #name=role#
     */
    private $role;
    
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
        return $this->_granted;
    }
    
    public function setGranted($granted) {
        $this->_granted = $granted;
        return $this;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function setRole($roles) {
        $this->role = $roles;
        return $this;
    }
    
    public function setAnonymous($anonymous) {
        $this->_anonymous = $anonymous;
        return $this;
    }
    
    public function getAnonymous() {
        return $this->_anonymous;
    }
    
    public function getDate_register() {
        return $this->date_register;
    }
    
    public function setDate_register($date) {
        $this->date_register = $date;
        return $this;
    }
    
    public function getDate_last_activity() {
        return $this->date_last_activity;
    }
    
    public function setDate_last_activity($date) {
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
