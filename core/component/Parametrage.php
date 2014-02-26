<?php

namespace core\component;

use core\component\parser\XmlParser;
use core\component\tools\ArrayToObject;
use core\component\exception\PDOException;

/** 
 * Class de paramétrage du site
 * -- connexion BDD
 * -- routes
 * On préfixe les variables avec "_" car variable de param
 */
class Parametrage {

    private $_connexion;
    private $_param;
    private $_parser;


    /**
     * Initialise la connexion et les routes
     */
    public function __construct() {
        //var_dump($_SERVER);die;
        $xml = file_get_contents("http://".$_SERVER['HTTP_HOST']."/core/config/parameters.xml");
        $this->_parser = new XmlParser($xml); 
        $arraytoobject = new ArrayToObject($this->_parser->array,TRUE);
        $this->_param = $arraytoobject->convert();
        //$this->initConnexion();
        
    }
    
    /**
     * initConnexion() initialise les variables de connexion
     * et créé la connexion dans l'attribut _connexion
     */
    public function initConnexion() {
        try {
            if($this->_parser->parse_error) {
                new \Exception($this->_parser->get_xml_error()); 
            }

            $db = ("dev" == $this->_param->parameters->env) ? 0 : 1;

            if($this->_connexion = new \PDO('mysql:host='.$this->_param->parameters->database[$db]->host.';port='.$this->_param->parameters->database[$db]->port.';dbname='.$this->_param->parameters->database[$db]->dbname, $this->_param->parameters->database[$db]->dbuser, $this->_param->parameters->database[$db]->dbpass)) {
                
            } else {
                throw new PDOException('Parametrage::initConnexion : impossible de se connecter.');
            }

        } catch (PDOException $e) {
            $e->display();
        }
        
    }
    
    /**
     * Retourne une connexion PDO
     * 
     * @return PDO
     */
    public function getConnexion() {
        return $this->_connexion;
    }
    
    /**
     * Retourne l'url de base du fichier de config
     * 
     * @return string
     */
    public function getBaseUrl() {
        return $this->_param->parameters->baseurl;
    }
    
    /**
     * Retourne le titre
     * 
     * @return string
     */
    public function getBaseTitle() {
        return $this->_param->parameters->basetitle;
    }
    
    /**
     * Retourne le controller par default
     * 
     * @return string
     */
    public function getBaseController() {
        return $this->_param->parameters->controllerdefault;
    }
    
    public function getParam() {
        return $this->_param;
    }
    
            
}





