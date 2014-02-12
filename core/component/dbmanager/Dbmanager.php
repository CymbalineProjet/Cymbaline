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
        
        $this->item = "\source\Cdm\UtilisateurBox\item\ ".$this->class;
        $this->item = str_replace(" ", "", $this->item);
        
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
    }
    
    public function push() {
        $query = new DbQuery($this->class, $this->entity);
        $query->save();
    }
    
    public function get() {
        $query = new DbQuery($this->class, $this->entity);
        $query->all();
    }
    
    public function getById($id) {
        try {
            if($id == 0 or $id == NULL) {
                throw new VarException('error getbyid id null or = 0');
            }
            
            $item = new $this->item();
            $this->entity['id']['value'] = $id;
            $query = new DbQuery($this->class, $this->entity);
            $o = $query->one();
            $i = $item->hydrate($o);
            
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

            $item = new $this->item();
            $query = new DbQuery($this->class, $this->entity);
            $o = $query->by($attributs);
            $i = $item->hydrate($o);
            return $i;
            
        } catch (VarException $e) {
            $e->display();  
        } 
        
    }
    
    
}
