<?php

namespace core\component\dbmanager;

use core\component\dbmanager\PDOConfig;

/**
 * Description of DbQuery
 *
 * @author Thibault
 */
class DbQuery extends Dbmanager {
    
    private $class;
    private $entity;
    private $query;
    private $error;
    
    public function __construct($class, array $entity) {
        $this->class = $class;
        $this->entity = $entity;
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
                    $this->query .= "'".$v['value']."',";
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
                    $this->query .= "'".$v['value']->format('Y/m/d H:i:s')."',";
                break;
            }
            
        } 
        
        $this->query = substr($this->query, 0, -1);
        $this->query .= ")";
        $connexion = new PDOConfig();
        
        var_dump($this->query);      
        var_dump($connexion->getPdo()->query($this->query));
    }
    
    public function all() {
        $class = strtolower($this->class);
        $this->query = "SELECT * FROM $class";
        $connexion = new PDOConfig();
        $query = $connexion->getPdo()->prepare($this->query);
        $query->execute();
        $all = $query->fetchAll();
        return $all;
    }
    
    public function one() {
        $class = strtolower($this->class);
        $this->query = "SELECT * FROM $class WHERE id = ".$this->entity['id']['value'];
        $connexion = new PDOConfig();
        $query = $connexion->getPdo()->prepare($this->query);
        $query->execute();
        $all = $query->fetch(PDO::FETCH_OBJ);
        
        return $all;
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
    
}