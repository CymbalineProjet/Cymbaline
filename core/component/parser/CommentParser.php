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

    /**
     * @return mixed
     */
    public function parseDBManager() {
        $explode = explode("*", $this->comment);

        foreach($explode as $id => $comment) {
            $pos = strpos($comment, "DBManager");
            if($pos === false) {
                unset($explode[$id]);
            }
        }

        $dbcomment = end($explode);
        $dbcomment = str_replace("*","",$dbcomment);
        $dbcomment = str_replace("/","",$dbcomment);
        $dbcomment = str_replace("DBManager","",$dbcomment);
        $dbcomment = str_replace("(","",$dbcomment);
        $dbcomment = str_replace(")","",$dbcomment);
        $dbcomment = trim($dbcomment);

        $com = explode(";", $dbcomment);
        foreach($com as $attr) {
            $c = explode("=", $attr);
            $array_return["$c[0]"] = $c[1];
        }

        $array = new ArrayToObject($array_return);
        $this->attributs = $array->convert();


        return $this->attributs;
    }

    public function parseForm() {
        $explode = explode("*", $this->comment);

        foreach($explode as $id => $comment) {
            $pos = strpos($comment, "Form");
            if($pos === false) {
                unset($explode[$id]);
            }
        }

        $dbcomment = end($explode);
        $dbcomment = str_replace("*","",$dbcomment);
        $dbcomment = str_replace("/","",$dbcomment);
        $dbcomment = str_replace("DBManager","",$dbcomment);
        $dbcomment = str_replace("(","",$dbcomment);
        $dbcomment = str_replace(")","",$dbcomment);
        $dbcomment = trim($dbcomment);

        $com = explode(";", $dbcomment);
        foreach($com as $attr) {
            $c = explode("=", $attr);
            $array_return["$c[0]"] = $c[1];
        }

        $array = new ArrayToObject($array_return);
        $this->attributs = $array->convert();


        return $this->attributs;
    }
    
}
