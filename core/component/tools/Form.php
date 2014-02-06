<?php

namespace core\component\tools;

use core\component\tools\ArrayToObject;

/**
 * Description of Form
 *
 * @author Thibault
 */
class Form {

    private $method;
    private $action;
    private $name;
    private $class;
    private $enctype;
    
    private $attr;
    private $fields;
    private $labels;

	public function __construct() {
		$this->fields = array();
        $this->enctype = "";
	}
	
	public function add($name, $type = "text", array $attributs = NULL, array $label = NULL, array $choices = NULL) {
        
        switch ($type) {
            case 'text':
                $this->createTypeText($name,$attributs,$label);
            break;
        
            case 'password':
                $this->createTypePwd($name,$attributs,$label);
            break;
        
            case 'radio':
                $this->createTypeRadio($name,$attributs,$label,$choices);
            break;
        }

    }
    
    public function createTypeText($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='text' name='".$this->name."[$name]' $attr />";
        if($label == NULL || !isset($label['for'])) {
            $label['for'] = $name;
            $this->addLabels($label);
        } else if($label == NULL) {
            $this->addLabels(array('for' => $name));
        } 
        else {
            $this->addLabels($label);
        }
    }
    
    public function createTypePwd($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='password' name='".$this->name."[$name]' $attr />";
        if($label == NULL || !isset($label['for'])) {
            $label['for'] = $name;
            $this->addLabels($label);
        } else if($label == NULL) {
            $this->addLabels(array('for' => $name));
        } 
        else {
            $this->addLabels($label);
        }
    }
    
    public function createTypeRadio($name,array $attributs,array $label, array $choices) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = array();
        foreach($choices as $choice) {
            $this->fields["$name"][] = "<input type='radio' name='".$this->name."[$name]' $attr value='".$choice."' /> ".$choice." ";
        }
        
        
        if($label == NULL || !isset($label['for'])) {
            $label['for'] = $name;
            $this->addLabels($label);
        } else if($label == NULL) {
            $this->addLabels(array('for' => $name));
        } 
        else {
            $this->addLabels($label);
        }
    }

    public function addLabels(array $attributs) {
        $attr = "";
        foreach ($attributs as $a => $v) {
            if($a != "value")
                $attr .= "$a='$v' ";
        }
        $this->labels[$attributs['for']] = "<label $attr>".ucfirst($attributs['value'])." :</label>";
    }
    
    public function getField($ref) {
        
        echo $this->fields["$ref"];
    }
    
    public function getChoices($ref, $index = NULL) {
        if($index != NULL) {
            return $this->fields["$ref"][$index];
        } else {
            $array = new ArrayToObject($this->fields["$ref"]);
            return $array->convert();
        }
    }
    
    public function getLabel($ref) {
        return $this->labels["$ref"];
    }
    
    public function open() {
        echo "<form action='$this->action' method='$this->method' id='$this->name' name='$this->name' class='$this->class' $this->enctype >";
    }
    
    public function close() {
        return "</form>";
    }
    
    public function setClass($class) {
        $this->class = $class;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function setMethod($methode) {
        $this->method = $methode;
        return $this;
    }
    
    public function setAction($action) {
        $this->action = $action;
        return $this;
    }
    
    public function getAction($action) {
        $this->action = $action;
        return $this;
    }
    
    public function setEnctype($enctype = "enctype='multipart/form-data'") {
        $this->enctype = $enctype;
        return $this;
    }
    
    public function getEnctype() {
        return $this->enctype;
    }
	
	
}


