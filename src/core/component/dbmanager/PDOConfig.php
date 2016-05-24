<?php

namespace core\component\dbmanager;

use core\component\tools\ArrayToObject;
use core\component\parser\YamlParser;
use Cymbaline\Cymbalog\item\Cymbalog;

/**
 * Description of PDOconfig
 *
 * @author Thibault Jeannet
 */
class PDOConfig  {

    /**
     * @var stdClass
     */
    private $_param;
    /**
     * @var PDO
     */
    private $_pdo;
    
    public function __construct(){ 
       
        $yml = file_get_contents(__DIR__."/../../config/parameters.yml");  
        $yaml = new YamlParser();
        $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
        $this->_param = $arraytoobject->convert();
        $db = $this->_param->parameters->env;

        try {
            
            $host = $this->_param->parameters->database->$db->host;
            $dbname = $this->_param->parameters->database->$db->dbname;
            $user = $this->_param->parameters->database->$db->dbuser;
            $pass = $this->_param->parameters->database->$db->dbpass;
            $this->_pdo = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);


        } catch (\PDOException $ex) {

            $log = new Cymbalog();
            $log->log("Error in ".__FUNCTION__." : ".$ex->getMessage());

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

    static function connect() {
	$pdo = null;
        $yml = file_get_contents(__DIR__."/../../config/parameters.yml");  
        $yaml = new YamlParser();
        $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
        $param = $arraytoobject->convert();
        $db = $param->parameters->env;


        try {
            
            $host = $param->parameters->database->$db->host;
            $dbname = $param->parameters->database->$db->dbname;
            $user = $param->parameters->database->$db->dbuser;
            $pass = $param->parameters->database->$db->dbpass;
			$pdo = null;
			$p = new \PDO();
            $pdo = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);


        } catch (\PDOException $ex) {

            $log = new Cymbalog();
            $log->log("Error in ".__FUNCTION__." : ".$ex->getMessage());

            $custom = new \core\component\exception\CoreException($ex->getMessage(),0,false);
            $c = $ex->getTrace();
            $custom->setTrace($c[0]);
            $custom->setFile(__DIR__."/PDOConfig.php");
            $custom->display();
        }

        return $pdo;
    }
} 