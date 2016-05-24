<?php

namespace core\component\dbmanager;

use core\component\dbmanager\PDOConfig;
use core\component\exception\CoreException;
use core\component\tools\ArrayToObject;
use Cymbaline\Administration\item\Tasks;

/**
 * Description of SqlCommand
 *
 * @author Thibault
 */
class SqlCommand {

    /**
     * @var String
     */
    private $class;
    /**
     * @var String
     */
    private $query;
    /**
     * @var String
     */
    private $select;
    /**
     * @var String
     */
    private $from;
    /**
     * @var String
     */
    private $_from;
    /**
     * @var String
     */
    private $where;
    /**
     * @var String
     */
    private $orderby;
    /**
     * @var String
     */
    private $order;
    /**
     * @var String
     */
    private $groupby;
    /**
     * @var String
     */
    private $having;
    /**
     * @var String
     */
    private $subquery;
    
    public function __construct($class) {
        
        $this->query = "";
        $this->class = $class;
        $this->_from = strtolower(basename(get_class($class)));
        $this->from = null;
        
    }

    /**
     * @return $this
     */
    public function build() {
        if($this->from == null) {
            $this->query = $this->select." FROM ".$this->_from." ".$this->where." ".$this->orderby." ".$this->order." ".$this->groupby;
        } else {
            $this->query = $this->select." ".$this->from." ".$this->where." ".$this->orderby." ".$this->order." ".$this->groupby;
        }
        return $this;
    }

    /**
     * @return array|item
     */
    public function execute() {
        try {
            $connexion = new PDOConfig();
            $pdo = $connexion->getPdo();
            $query = $pdo->prepare($this->query);
            $query->execute();
            $all = $query->fetchAll($pdo::FETCH_OBJ);
            $path = $this->class;
            $item = new $path();

            /*if(sizeof($all) == 1) {
                $all = $this->hydrate($all[0]);
            } else {
                foreach($all as $id => $object) {
                    $all[$id] = $this->hydrate($object);
                }
            }*/

            return $all;
        } catch (CoreException $e) {
            $e->display();
        }
    }

    /**
     * @param $datas
     * @param bool $all
     * @return mixed
     */
    public function hydrate($datas, $all = false) {
        $item = $this->class;

        if($all) {
            $stdClass = new \stdClass();

            foreach($datas as $attr => $value) {

                foreach($value as $id => $valeur) {

                    if(!is_int($id)) {
                        $stdClass->{$id} = $valeur;
                    }

                }
                $datas[$attr] = $this->hydrate($stdClass);
                unset($stdClass);
                $stdClass = new \stdClass();
            }

            return $datas;

        } else {
            $_e = new $item();
            foreach($datas as $attr => $value) {

                $attribut = "set".ucfirst($attr);
                $_e->$attribut($value);

            }

            return $_e;
        }

    }

    /**
     * @return String
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * @param $class
     * @return $this
     */
    public function setClass($class) {
        $this->class = $class;
        return $this;
    }

    /**
     * @return String
     */
    public function getQuery() {
        $this->build();
        return $this->query;
    }

    /**
     * @param $query
     * @return $this
     */
    public function setQuery($query) {
        $this->query = $query;
        return $this;
    }

    /**
     * @return String
     */
    public function getSelect() {
        return $this->select;
    }

    /**
     * @param $select
     * @return $this
     */
    public function setSelect($select) {
        $this->select = "SELECT $select";
        return $this;
    }

    /**
     * @return null|String
     */
    public function getFrom() {
        return $this->from;
    }

    /**
     * @param $from
     * @return $this
     */
    public function setFrom($from) {
        $this->from = "FROM $from";
        return $this;
    }

    /**
     * @return String
     */
    public function getWhere() {
        return $this->where;
    }

    /**
     * @param $where
     * @return $this
     */
    public function setWhere($where) {
        $this->where = "WHERE $where";
        return $this;
    }

    /**
     * @param $where
     * @return $this
     */
    public function addWhere($where) {
        $this->where .= " AND $where";
        return $this;
    }

    /**
     * @return String
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * @param $order
     * @return $this
     */
    public function setOrder($order) {
        $this->order = $order;
        return $this;
    }

    /**
     * @return String
     */
    public function getOrderBy() {
        return $this->orderby;
    }

    /**
     * @param $orderby
     * @return $this
     */
    public function setOrderBy($orderby) {
        $this->orderby = "ORDER BY $orderby";
        return $this;
    }

    /**
     * @return String
     */
    public function getGroupBy() {
        return $this->groupby;
    }

    /**
     * @param $groupby
     * @return $this
     */
    public function setGroupBy($groupby) {
        $this->groupby = "GROUP BY $groupby";
        return $this;
    }

    /**
     * @return String
     */
    public function getHaving() {
        return $this->having;
    }

    /**
     * @param $having
     * @return $this
     */
    public function setHaving($having) {
        $this->having = "HAVING $having";
        return $this;
    }

    /**
     * @param $subquery
     * @return String
     */
    public function getSubquery($subquery) {
        return $this->subquery;
    }

    /**
     * @param $subquery
     * @return $this
     */
    public function setSubquery($subquery) {
        $this->subquery = $subquery;
        return $this;
    }
    
}
