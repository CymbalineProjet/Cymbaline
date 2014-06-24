<?php

namespace core\component\dbmanager;

use core\component\tools\ArrayToObject;
use core\component\parser\YamlParser;
use core\component\exception\CustomException;

/**
 * Description of PDOconfig
 *
 * @author Thibault Jeannet
 */
class PDOConfig  { 

    private $_param;
    private $_pdo;
    
    public function __construct(){ 
        try {
            $yml = file_get_contents(__DIR__."/../../config/parameters.yml");  
            $yaml = new YamlParser();
            $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
            $this->_param = $arraytoobject->convert();
            $db = $this->_param->parameters->env;
            $this->_pdo = new \PDO('mysql:host='.$this->_param->parameters->database->$db->host.';port='.$this->_param->parameters->database->$db->port.';dbname='.$this->_param->parameters->database->$db->dbname, $this->_param->parameters->database->$db->dbuser, $this->_param->parameters->database->$db->dbpass); 

        } catch (CustomException $e) {
            $e->display();
        }
    } 
    
    public function getPdo() {
        return $this->_pdo;
    }
} 