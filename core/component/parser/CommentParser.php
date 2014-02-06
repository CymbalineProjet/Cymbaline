<?php

namespace core\component\parser;

use core\component\tools\ArrayToObject;

/**
 * Description of CommentParser
 *
 * @author Thibault
 */
class CommentParser {
    
    private $comment;
    private $attributs;
    
    public function __construct() {
        
    }
    
    public function getComment() {
        return $this->comment;
    }
    
    public function setComment($comment) {
        $this->comment = $comment;
        
        return $this;
    }
    
    public function parse() {
        
        $explode = explode("#", $this->comment);
        
        $i=0;
        
        foreach ($explode as $comment) {
            $j= $i%2;
            if($j == 0) {
                unset($explode[$i]);
            }
            //var_dump($j);
            //var_dump($i);
            $i++;
        }
        
        $array_return = array();
        
        foreach($explode as $comment) {
            $com = explode("=", $comment);
            $array_return["$com[0]"] = $com[1];
            
        }
        
        $array = new ArrayToObject($array_return);
        $this->attributs = $array->convert();
        
        //var_dump($this->attributs->type);die;
        
        return $this->attributs;
    }
    
}
