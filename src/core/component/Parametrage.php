<?php

namespace core\component;

use core\component\parser\YamlParser;
use core\component\tools\ArrayToObject;
use core\component\exception\PDOException;
use core\component\exception\CoreException;

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
        try {
            $yml = file_get_contents(__DIR__."/../config/parameters.yml");
            $yaml = new YamlParser($xml); 
            $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
            $this->_param = $arraytoobject->convert();

            if(isset($this->_param->import)) {
                $this->_param->parameters = null;
                $this->import();
            }

            $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
            $o = $arraytoobject->convert();

            $this->_param->parameters = array_merge((array)$this->_param->parameters, (array)$o->parameters);

        } catch(CoreException $e) {
            $e->display();
        }
        
    }

    public function import() {
       
        try {

            foreach ($this->_param->import as $file) {
                $yml = file_get_contents(__DIR__."/../..".$file->path);
                $yaml = new YamlParser();
                $param = $yaml->load($yml);

                
                $arraytoobject = new ArrayToObject((array)$param['parameters'],TRUE);
                $o = $arraytoobject->convert();
              
                if(is_null($this->_param->parameters)) {
                    $this->_param->parameters = $o;
                } else {
                    $this->_param->parameters = array_merge((array)$this->_param->parameters, (array)$o);
                }
                
                //$this->_param->parameters = array_replace($this->_param->parameters, (array)$o);
            }
                
        } catch (RouteException $e) {
            $e->display();
        }
    }
    
    /**
     * initConnexion() initialise les variables de connexion
     * et créé la connexion dans l'attribut _connexion
     */
    public function initConnexion() {
        try {

            $db = ("dev" == $this->_param->parameters->env) ? 0 : 1;

            if($this->_connexion = new \PDO('mysql:host='.$this->_param->parameters->database->$db->host.';port='.$this->_param->parameters->database->$db->port.';dbname='.$this->_param->parameters->database->$db->dbname, $this->_param->parameters->database->$db->dbuser, $this->_param->parameters->database->$db->dbpass)) {
                
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
        $arraytoobject = new ArrayToObject($this->_param,TRUE);
        $this->_param = $arraytoobject->convert();
        return $this->_param;
    }
    
    public function getRoles() {
        return $this->_param->parameters->roles;
    }
            
}





