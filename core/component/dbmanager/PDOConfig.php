<?php

namespace core\component\dbmanager;

use core\component\tools\ArrayToObject;
use core\component\parser\YamlParser;

/**
 * Description of PDOconfig
 *
 * @author Thibault Jeannet
 */
class PDOConfig  { 

    private $_param;
    private $_pdo;
    
    public function __construct(){ 
       
        $yml = file_get_contents(__DIR__."/../../config/parameters.yml");  
        $yaml = new YamlParser();
        $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
        $this->_param = $arraytoobject->convert();
        $db = $this->_param->parameters->env;
        try {
            $this->_pdo = new \PDO('mysql:host='.$this->_param->parameters->database->$db->host.';port='.$this->_param->parameters->database->$db->port.';dbname='.$this->_param->parameters->database->$db->dbname, $this->_param->parameters->database->$db->dbuser, $this->_param->parameters->database->$db->dbpass);
        } catch (\PDOException $ex) {
            $custom = new \core\component\exception\CoreException($ex->getMessage(),0,false);
            $c = $ex->getTrace();
            $custom->setTrace($c[0]);
            $custom->setFile(__DIR__."/PDOConfig.php");
            $custom->display();
        }

    } 
    
    public function getPdo() {
        return $this->_pdo;
    }
} 