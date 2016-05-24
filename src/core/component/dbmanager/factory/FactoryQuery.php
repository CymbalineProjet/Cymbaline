<?php

namespace core\component\dbmanager\factory;

use core\component\dbmanager\PDOConfig;
use core\component\exception\PDOException;
use Cymbaline\Cymbalog\item\Cymbalog;


class FactoryQuery {

	const UNIQ_QUERY  = 1;
	const MULTI_QUERY = 2;
	const ORDER_DESC  = "DESC";
	const ORDER_ASC   = "ASC";
 
	protected $_query;
	protected $_connexion;
	protected $_datas;
	protected $_idGenerated;
	public $_isExecuted;

	public function __construct() {
	
		$this->_connexion = PDOConfig::connect();
		$this->_isExecuted = false;
	}
	
	public function getDatas() {
		return $this->_datas;
	}
	
	public function countDatas() {
		return sizeof($this->_datas);
	}
	
	/**
	* to kill the connexion
	*
	*/
	public function kill() {
		$this->_connexion = null;
	}
	
	/**
	* reload the connexion
	*
	*/
	public function reload() {
		$this->kill();
		$this->_connexion = PDOConfig::connect();
		/*if(is_null($this->_connexion)) {
			$this->_connexion = PDOConfig::connect();
		}*/
	}

	/**
	* for insert
	*
	*/
	protected function doInsertQuery() {
	
	
		$this->reload();
	
		try { 
	        $query = $this->_connexion->prepare($this->_query);
	        $this->_connexion->beginTransaction();
	        $query->execute();
	        $this->_idGenerated = $this->_connexion->lastInsertId();
	        $this->_connexion->commit();
			$this->_isExecuted = true;
			
	    } catch(\PDOException $e) {
			$this->kill();
	        $this->_connexion->rollback();
			$log = new Cymbalog();
			$log->set('message',"Error in ".__FUNCTION__." : ".$e->getMessage());
			$log->log();
			$this->displayError($e);
	    } 
		
		
	}

	/**
	* for delete and update
	*
	*/
	protected function doQuery() {
	
	
		$this->reload();

		try {
			$this->_connexion->beginTransaction();
			$this->_connexion->query($this->_query);
			$this->_connexion->commit();
			$this->_datas = null;
			$this->_isExecuted = true;
		} catch(\PDOException $e) {
			$this->kill();
	        $this->_connexion->rollback();
			$log = new Cymbalog();
			$log->set('message',"Error in ".__FUNCTION__." : ".$e->getMessage());
			$log->log();
			$this->displayError($e);
	    }         
		
	}

	/**
	* for select one
	*/
	protected function fetchQuery() {
	
		$this->reload();
			
		
		try {

	        $query = $this->_connexion->prepare($this->_query);
			$query->execute();
			$pdo = $this->_connexion;
	        $this->_datas = $query->fetch($pdo::FETCH_OBJ);

	        foreach ($this->_datas as $key => $value) {

	        	$this->$key = $value; 
	        }
			
			$this->_isExecuted = true;


        } catch(\PDOException $e) {
			$this->kill();
			$log = new Cymbalog();
			$log->set('message',"Error in ".__FUNCTION__." : ".$e->getMessage());
			$log->log();
			$this->displayError($e);
	    } 
		
	}

	/**
	* for select all
	*/
	protected function fetchAllQuery() {

		$this->reload();
		
		try { 
	        $query = $this->_connexion->prepare($this->_query);
	        $query->execute();
	        $pdo = $this->_connexion;
	        $this->_datas  = $query->fetchAll($pdo::FETCH_OBJ);

	        foreach ($this->_datas as $key => $value) {

	        	$this->$key = $value; 
	        }
			
			$this->_isExecuted = true;
			
	    } catch(\PDOException $e) {
			$this->kill();
			$log = new Cymbalog();
			$log->set('message',"Error in ".__FUNCTION__." : ".$e->getMessage());
			$log->log();
			$this->displayError($e);
	    } 
		
	}

	private function displayError($ex) {
		$custom = new \core\component\exception\CoreException($ex->getMessage(),0,false);
		$c = $ex->getTrace();
		$custom->setTrace($c[0]);
		$custom->setFile(__DIR__."/../PDOConfig.php");
		$custom->display();
	}

}