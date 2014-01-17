<?php

namespace Config;

/** 
 * Class de paramétrage du site
 * -- connexion BDD
 * -- routes
 * On préfixe les variables avec "_" car variable de param
 */
class Parametrage {
    
    // -- connexion BDD
    private $_hote;
    private $_port;
    private $_nom_db;
    private $_utilisateur;
    private $_mot_passe;
    
    // -- routes
    private $_route_js;
    private $_route_css;
    private $_route_img;
    
    // -- autres
    private $_connexion;
    
    /**
     * Initialise la connexion et les routes
     */
    public function __construct() {
        $this->initConnexion();
        $this->initRoute();
    }
    
    /**
     * initConnexion() initialise les variables de connexion
     * et créé la connexion dans l'attribut _connexion
     */
    public function initConnexion() {
        $this->_hote        = 'localhost'; // le serveur
        $this->_port        = '';
        $this->_nom_db      = 'tirage'; // le nom de la base de données
        $this->_utilisateur = 'root'; // nom d'utilisateur 
        $this->_mot_passe   = ''; // mot de passe de l'utilisateur
        
        // on instancie un objet Connexion 
        $this->_connexion = new \PDO('mysql:host='.$this->_hote.';port='.$this->_port.';dbname='.$this->_nom_db, $this->_utilisateur, $this->_mot_passe);
    }
    
    /**
     * initRoute() initialise les routes pour les liens
     */
    public function initRoute() {
        $this->_route_js     = $_SERVER['HTTP_HOST']."/public/js/";
        $this->_route_css    = $_SERVER['HTTP_HOST']."/public/css/";
        $this->_route_img    = $_SERVER['HTTP_HOST']."/public/images/";
    }
    
    /**
     * Retourne le chemin absolu pour les fichiers JS/
     * @return string
     */
    public function getRouteJs() {
        return $this->_route_js;
    }
    
    /**
     * Retourne le chemin absolu pour les fichiers CSS/
     * @return string
     */
    public function getRouteCss() {
        return $this->_route_css;
    }
    
    /**
     * Retourne le chemin absolu pour les fichiers IMG/
     * @return string
     */
    public function getRouteImg() {
        return $this->_route_img;
    }
    
    /**
     * Retourne une connexion PDO
     * @return PDO
     */
    public function getConnexion() {
        return $this->_connexion;
    }
    
            
}





