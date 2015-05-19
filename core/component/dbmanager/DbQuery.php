<?php

namespace core\component\dbmanager;

use core\component\dbmanager\PDOConfig;
use core\component\exception\PDOException;

/**
 * Description of DbQuery
 *
 * @author Thibault
 */
class DbQuery extends Dbmanager {

    /**
     * @var String
     */
    private $class;
    /**
     * @var Array
     */
    private $entity;
    /**
     * @var String
     */
    private $query;
    /**
     * @var String
     */
    private $order;
    
    public function __construct($class, array $entity, $order = NULL) {
        $this->class = $class;
        $this->entity = $entity;
        $this->order = $order;
    }
    
    public function save() {
        $class = strtolower($this->class);
        $attr = "(";
        foreach ($this->entity as $field => $v) {
            $attr .= "$field,";
        }
        $attr = substr($attr, 0, -1);
        $attr .= ")";
        
        $this->query = "INSERT INTO $class $attr VALUES (";
        
        foreach ($this->entity as $field => $v) {
            //var_dump($v['type']);
            
            switch($v['type']) {
                case 'string' :
                    $this->query .= "'".addslashes($v['value'])."',";
                break;
            
                case 'int' : 
                    if($v['value'])
                        $this->query .= $v['value'].",";
                    else
                        $this->query .= "0,";
                break;
            
                case 'bool' : 
                    
                    if($v['value'])
                        $this->query .= "1,";
                    else
                        $this->query .= "0,";
                    
                break;
            
                case 'datetime' :
                    
                    if(is_null($v['value'])) {
                        $v['value'] = new \core\component\tools\Date();
                    }
                    
                    $this->query .= "'".$v['value']->format('Y/m/d H:i:s')."',";
                break;
            }
            
        } 
        
        $this->query = substr($this->query, 0, -1);
        $this->query .= ")";
        $connexion = new PDOConfig();
        $connexion->getPdo()->query($this->query);
        /*var_dump($this->query);      
        /*var_dump($connexion->getPdo()->query($this->query));*/
    }
    
    public function all() {
        try {
            $class = strtolower($this->class);

            if(!is_null($this->order))
                $this->query = "SELECT * FROM $class ".$this->order;
            else
                $this->query = "SELECT * FROM $class";

            $connexion = new PDOConfig();
            $query = $connexion->getPdo()->prepare($this->query);
            $query->execute();
            $all = $query->fetchAll();
            
            /*if($all == null) {
                throw new PDOException("Aucune $this->class en base de données.");
            }*/
            
            return $all;
            
        } catch (PDOException $e) {
            $e->display();
        }
    }
    
    public function one() {
        try {
            $class = strtolower($this->class);
            $this->query = "SELECT * FROM $class WHERE id = ".$this->entity['id']['value'];
            
            $connexion = new PDOConfig();
            $query = $connexion->getPdo()->prepare($this->query);
            $query->execute();
            $pdo = $connexion->getPdo();
            $all = $query->fetch($pdo::FETCH_OBJ);

            if($all == null) {
                throw new PDOException("$this->class #".$this->entity['id']['value']." n'existe pas.");
            }

            return $all;
        } catch (PDOException $e) {
            $e->display();
        }
    }
    
    public function by($attributs) {
        //var_dump($this->entity["$attributs"]['value']);
        $class = strtolower($this->class);
        $this->query = "SELECT * FROM $class WHERE $attributs = '".$this->entity["$attributs"]['value']."'";
        $connexion = new PDOConfig();
        $pdo = $connexion->getPdo();
        $query = $pdo->prepare($this->query);
        $query->execute();
        $all = $query->fetch($pdo::FETCH_OBJ);
        //var_dump($all);
        return $all;
    }
    
    public function allby($attributs) {
        //var_dump($this->entity["$attributs"]['value']);
        $class = strtolower($this->class);
        $this->query = "SELECT * FROM $class WHERE $attributs = '".$this->entity["$attributs"]['value']."'";
        $connexion = new PDOConfig();
        $pdo = $connexion->getPdo();
        $query = $pdo->prepare($this->query);
        $query->execute();
        $all = $query->fetchAll();
        //var_dump($all);
        return $all;
    }
    
    function _update() { 
        $class = strtolower($this->class);
        $attr = "(";
        foreach ($this->entity as $field => $v) {
            $attr .= "$field,";
        }
        $attr = substr($attr, 0, -1);
        $attr .= ")";
        
        $this->query = "UPDATE $class  SET ";
        
        foreach ($this->entity as $field => $v) {
            //var_dump($v['type']);
            
            switch($v['type']) {
                case 'string' :
                    $this->query .= "$field = '".addslashes($v['value'])."',";
                break;
            
                case 'int' : 
                    if($v['value'])
                        $this->query .= "$field = ".$v['value'].",";
                    else
                        $this->query .= "$field = 0,";
                break;
            
                case 'bool' : 
                    
                    if($v['value'])
                        $this->query .= "$field = 1,";
                    else
                        $this->query .= "$field = 0,";
                    
                break;
            
                case 'datetime' :
                    //var_dump($v);
                    if(is_object($v['value'])) {
                        $this->query .= "$field = '".$v['value']->format('Y/m/d H:i:s')."',";
                    } else {
                        $this->query .= "$field = '".$v['value']."',";
                    }
                break;
            }
            
        } 
        
        $this->query = substr($this->query, 0, -1);
        $this->query .= " WHERE id = ".$this->entity['id']['value'];
        
        //var_dump($this->query);
        $connexion = new PDOConfig();
        $connexion->getPdo()->query($this->query);
        
    }
    
    public function _delete() {
        try {
            $class = strtolower($this->class);
            $this->query = "DELETE FROM $class WHERE id = ".$this->entity['id']['value'];
            
            $connexion = new PDOConfig();
            $connexion->getPdo()->query($this->query);

        } catch (PDOException $e) {
            $e->display();
        }
    }
    
}
