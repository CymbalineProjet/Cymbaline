<?php

namespace core\component\dbmanager;

use ReflectionClass;
use core\component\exception\VarException;
use core\component\dbmanager\DbQuery;
use core\component\parser\CommentParser;

/**
 * Description of Dbmanager
 *
 * @author Thibault
 */
class Dbmanager {
    
    private $entity;
    private $class;
    private $item;

    
    public function __construct() {

    }
    
    public function load($entity) {
        $class = get_class($entity);
        $pos = strpos($class, "\item");
        $this->class = substr($class, $pos+6);  

        $this->item = $class;
        $reflectionClass = new ReflectionClass(get_class($entity));
        $comment = new CommentParser();
        
        $array_entity = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array_entity[$property->getName()]['value'] = $property->getValue($entity);
            $comment->setComment($property->getDocComment());
            $comments = $comment->parse();
            
            if($comments != NULL) {
                $array_entity[$property->getName()]['type'] = $comments->type;
            }
            $property->setAccessible(false);
        }
        
        $parent = $reflectionClass->getParentClass();
        
        if($parent) {
            foreach ($parent->getProperties() as $property) {
                $property->setAccessible(true);
                $array_entity[$property->getName()]['value'] = $property->getValue($entity);
                $comment->setComment($property->getDocComment());
                $comments = $comment->parse();
                if($comments != NULL) {
                    $array_entity[$property->getName()]['type'] = $comments->type;
                }
                $property->setAccessible(false);
            }
        }
        
        foreach ($array_entity as $attr => $value) {
            $var = substr($attr,0,1);
            if($var == "_") {
                unset($array_entity[$attr]);
            }
        }
        unset($array_entity['id']);
        $this->entity = $array_entity;

        return $this;
    }
    
    public function push() {
        $query = new DbQuery($this->class, $this->entity);
        $query->save();
    }
    
    public function update($id) {
        $this->entity['id']['value'] = $id;
        $this->entity['id']['type'] = "int";
        //var_dump($this->entity);
        $query = new DbQuery($this->class, $this->entity);
        $query->_update();
        return $this->getById($id);
    }
    
    public function delete($id) {
        $this->entity['id']['value'] = $id;
        $this->entity['id']['type'] = "int";
        //var_dump($this->entity);
        $query = new DbQuery($this->class, $this->entity);
        $query->_delete();
    }
    
    public function get() {
        $query = new DbQuery($this->class, $this->entity);
        $all = $this->hydrate($query->all(),true);
        
        return $all;
    }
    
    public function getById($id) {
        try {
            if($id == 0 or $id == NULL) {
                throw new VarException('error getbyid id null or = 0');
            }
            
            $this->entity['id']['value'] = $id;
            $query = new DbQuery($this->class, $this->entity);
            $o = $query->one();
            $i = $this->hydrate($o);
            
            return $i;
            
        } catch (VarException $e) {
            $e->display();
        } 
    }
    
    public function getBy($attributs = NULL) {
        try {
            if($attributs == NULL) {
                throw new VarException("La variable de la fonction getBy est nulle.");              
            }

            $query = new DbQuery($this->class, $this->entity);
            $o = $query->by($attributs);
            if($o) {
                $i = $this->hydrate($o);
                return $i;
            } else {
                return false;
            }
            
        } catch (VarException $e) {
            $e->display();  
        } 
        
    }
    
    public function getAllBy($attributs = NULL) {
        try {
            if($attributs == NULL) {
                throw new VarException("La variable de la fonction getBy est nulle.");              
            }

            $query = new DbQuery($this->class, $this->entity);
            $o = $query->allby($attributs);
            if($o) {
                $i = $this->hydrate($o, true);
                return $i;
            } else {
                return false;
            }
            
        } catch (VarException $e) {
            $e->display();  
        } 
        
    }

    public function hydrate($datas, $all = false) {
        $item = $this->item;

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
    
    
}
