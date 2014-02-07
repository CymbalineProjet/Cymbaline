<?php

namespace core\component\dbmanager;

use core\component\tools\ArrayToObject;
use core\component\parser\XmlParser;

/**
 * Description of PDOconfig
 *
 * @author schizo_mind at hotmail dot com 
 * @link http://fr2.php.net/manual/fr/class.pdo.php description
 */
class PDOConfig  { 
    
    private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 
    
    private $_parser;
    private $_param;
    private $_pdo;
    
    public function __construct(){ 
        
        $xml = file_get_contents("http://alca.dev/AlcaFram/core/config/parameters.xml");
        $this->_parser = new XmlParser($xml);        
        $arraytoobject = new ArrayToObject($this->_parser->array,TRUE);
        $this->_param = $arraytoobject->convert();
        
        $db = ("dev" == $this->_param->parameters->env) ? 0 : 1;
        

        $this->_pdo = new \PDO('mysql:host='.$this->_param->parameters->database[$db]->host.';port='.$this->_param->parameters->database[$db]->port.';dbname='.$this->_param->parameters->database[$db]->dbname, $this->_param->parameters->database[$db]->dbuser, $this->_param->parameters->database[$db]->dbpass); 
        
        
    } 
    
    public function getPdo() {
        return $this->_pdo;
    }
} 