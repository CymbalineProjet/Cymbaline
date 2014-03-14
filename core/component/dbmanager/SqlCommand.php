<?php

namespace core\component\dbmanager;

use core\component\dbmanager\PDOConfig;
use core\component\exception\CoreException;
use core\component\tools\ArrayToObject;

/**
 * Description of SqlCommand
 *
 * @author Thibault
 */
class SqlCommand {
    
    private $class;
    private $query;
    private $select;
    private $from;
    private $_from;
    private $where;
    private $orderby;
    private $order;
    private $groupby;
    private $having;
    private $subquery;
    
    public function __construct($class) {
        
        $this->query = "";
        $this->class = $class;
        $_from = explode("/",$this->class);
        $this->_from = $_from[2];
        $this->from = null;
        
    }
    
    public function build() {
        if($this->from == null) {
            $this->query = $this->select." FROM ".$this->_from." ".$this->where." ".$this->orderby." ".$this->order." ".$this->groupby;
        } else {
            $this->query = $this->select." ".$this->from." ".$this->where." ".$this->orderby." ".$this->order." ".$this->groupby;
        }
        return $this;
    }
    
    public function execute() {
        try {
            $connexion = new PDOConfig();
            $pdo = $connexion->getPdo();
            $query = $pdo->prepare($this->query);
            $query->execute();
            $all = $query->fetchAll($pdo::FETCH_OBJ);
            $class = explode("/",$this->class);

            if(sizeof($class) != 3) {
                throw new CoreException("Item inconnu. Verifié le chemin passé dans le controller.");
            }

            $path = "source\\".ucfirst($class[0])."\\".ucfirst($class[1])."Box\\item\\".ucfirst($class[2]);
            $item = new $path();

            if(sizeof($all) == 1) {
                $all = $item->hydrate($all[0]);
            } else {
                foreach($all as $id => $object) {
                    $all[$id] = $item->hydrate($object);
                }
            }

            return $all;
        } catch (CoreException $e) {
            $e->display();
        }
    }
    
    public function getClass() {
        return $this->class;
    }
    
    public function setClass($class) {
        $this->class = $class;
        return $this;
    }
    
    public function getQuery() {
        $this->build();
        return $this->query;
    }
    
    public function setQuery($query) {
        $this->query = $query;
        return $this;
    }
    
    public function getSelect() {
        return $this->select;
    }
    
    public function setSelect($select) {
        $this->select = "SELECT $select";
        return $this;
    }
    
    public function getFrom() {
        return $this->from;
    }
    
    public function setFrom($from) {
        $this->from = "FROM $from";
        return $this;
    }
    
    public function getWhere() {
        return $this->where;
    }
    
    public function setWhere($where) {
        $this->where = "WHERE $where";
        return $this;
    }
    
    public function addWhere($where) {
        $this->where .= " AND $where";
        return $this;
    }
    
    public function getOrder() {
        return $this->order;
    }
    
    public function setOrder($order) {
        $this->order = $order;
        return $this;
    }
    
    public function getOrderBy() {
        return $this->orderby;
    }
    
    public function setOrderBy($orderby) {
        $this->orderby = "ORDER BY $orderby";
        return $this;
    }
    
    public function getGroupBy() {
        return $this->groupby;
    }
    
    public function setGroupBy($groupby) {
        $this->groupby = "GROUP BY $groupby";
        return $this;
    }
    
    public function getHaving() {
        return $this->having;
    }
    
    public function setHaving($having) {
        $this->having = "HAVING $having";
        return $this;
    }
    
    public function getSubquery($subquery) {
        return $this->subquery;
    }
    
    public function setSubquery($subquery) {
        $this->subquery = $subquery;
        return $this;
    }
    
}
