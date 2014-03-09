<?php

namespace core\component;

use core\component\security\SecurityUser;

/**
 * Gère la variable $_SESSION
 *
 * @author Thibault Jeannet thibault.jeannet@gmail.com
 */
class Session {
    
    private $session;
	
	/**
	* Session constructeur
	*
	* @access public
	* @param  array  $_SESSION
	*/
	public function __construct($session = null) {
        
        $this->session = $_SESSION;
        
	}
    
    /**
     * Retourne la session
     * @return session
     */
    public function get($name = NULL) {
        $this->session = $_SESSION;
        
        if($name == NULL)
            return $_SESSION;
        else
            return $_SESSION[$name];
    }
	
	/**
	* Détruit une session
	*
	* @access public
	*/
	public function _destroy() {
		session_destroy();
	}
	
	/**
	* Détruit toutes les variables d'une session
	*
	* @access public
	*/
	public function _unset() {
		
	}
	
	/**
	* Supprime une variable de la session
	*
	* @access public
	* @param string $name
	*/
	public function _unregister($name) {
		//session_unregister($name);
        unset($_SESSION[$name]);
        unset($this->session[$name]);
	}
	
	/**
	* Enregistre une variable globale dans une session
	*
	* @access public
	* @param string $name
	* @param var $value
	*/
	public function _register($name,$value) {
		$_SESSION[$name] = $value;
        //var_dump($name);
        $this->session[$name] = $value;
	}
	
	/**
	* Vérifie si une variable est enregistrée dans la session
	*
	* @access public
	* @param string $name
	* @return boolean
	*/
	public function _is_register($name) {
		$retour = false;
		if(isset($this->session["$name"]) or isset($_SESSION[$name]))
			$retour = true;
		
		return $retour;
	}
	
	/**
	* Lit l'identifiant courant de session
	*
	* @access public
	* @return varchar
	*/
	public function _id() {
		return session_id();
	}
	
/**
	* Remplace l'identifiant de session courant par un nouveau
	*
	* @access public
	* @return varchar
	*/
	public function _regenerate_id() {
		return session_regenerate_id();
	}
}
