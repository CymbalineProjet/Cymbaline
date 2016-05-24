<?php

namespace core\component\dbmanager\factory;

use core\component\exception\PDOException;
use core\component\dbmanager\factory\FactoryQuery;


class Factory extends FactoryQuery { 

	public function __construct() {
		if(!isset($this->_table) || is_null($this->_table))
			throw new PDOException("Error in Factory::load => attribute _table is not set");


		parent::__construct();

	}

	public function getId() {
		return $this->id;
	}
	
	public function exists() {
		if(is_null($this->id))
			return false;
			
		return true;
	}

	public function set($attibute,$value) {
		$this->$attibute = $value;
		return $this;
	}

	public function get($attribute) {
		return $this->$attribute;
	}
	
	public function setQuery($query) {
		$this->_query = $query;
		return $this;
	}
	
	public function execute() {
		$this->fetchAllQuery();
	}

	public function load($id = NULL) {

		if(!is_null($id))
			$this->_query = "SELECT * FROM ".$this->_table." WHERE id = $id";
		else
			$this->_query = "SELECT * FROM ".$this->_table." LIMIT 1";

		$this->fetchQuery();
	}
	
	public function all($orderby = null,$order = FactoryQuery::ORDER_DESC) {
	
		$this->_query = "SELECT * FROM ".$this->_table." ";
	
		if(!is_null($order)) {
			$this->_query = "SELECT * FROM ".$this->_table." ORDER BY $orderby $order ";
		} 
		
		$this->fetchAllQuery();
		
		$this->kill();
	}

	public function loadByFilters(array $filters, $typeQuery = FactoryQuery::UNIQ_QUERY) {

		if(!is_array($filters) || is_null($filters) || empty($filters))
			throw new PDOException("Error in Factory::loadByFilters => array filters is not set");

		$this->_query = "SELECT * FROM ".$this->_table." WHERE ";

		$i = 0;
		foreach ($filters as $filter => $value) {
			if($i != 0)
				$this->_query .= " AND ";
				
				$this->set($filter,$value);

			$this->_query .= $filter." = '".$value."'";
			$i++;
		}

		
		
		if($typeQuery == FactoryQuery::UNIQ_QUERY) {
			$this->_query .= " LIMIT 1 ";
			$this->fetchQuery();
		} else {
			$this->fetchAllQuery();
		}

		$this->kill();

	}

	public function save() {
	
		$attributes = array();
		$keys       = array();

		foreach ($this as $key => $value) {
			if($key[0] != "_") {
				if($value == "" || is_null($value))
					$value = "";

				$attributes[$key] = "'$value'";
				$keys[] = $key;
			}
		}

		$values = implode(",",$attributes);
		$keys = implode(",",$keys);
		

		$this->_query = "INSERT INTO ".$this->_table." ($keys) VALUES ($values)";
		
		$this->doInsertQuery();

		$this->id = $this->_idGenerated;
		
		$this->kill();
	}

	public function delete() {

		$this->_query = "DELETE FROM ".$this->_table." WHERE id = ".$this->id;
		$this->doQuery();
		
		$this->kill();
	}

	public function update() {

		$attributes = array();

		foreach ($this as $key => $value) {
			if($key[0] != "_") {
				if($value == "" || is_null($value))
					$value = "";

				$attributes[$key] = "$value";
				$this->$key = $value;
			}
		}

		$this->_query = "UPDATE ".$this->_table." SET ";

		foreach ($attributes as $key => $value) {
			if($value != "")
				$this->_query .= "$key = '".addslashes($value)."',";
		}

		$this->_query = substr($this->_query, 0, -1);

		if(!is_null($this->id) && $this->id != "" && strlen($this->id) > 0)
			$this->_query .= " WHERE id = ".$this->id;
		else
			$this->_query .= " WHERE id = ".$this->_datas->id;

		$this->doQuery();
		
		$this->kill();

	}

}