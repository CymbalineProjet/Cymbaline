<?php

namespace core\component\dbmanager;

use ReflectionClass;
use core\component\dbmanager\PDOConfig;
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
    

    
    public function __construct() {

    }
    
    public function load($entity) {
        $class = get_class($entity);
        $pos = strpos($class, "\item");
        $this->class = substr($class, $pos+6);  
        
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
    
    
}
