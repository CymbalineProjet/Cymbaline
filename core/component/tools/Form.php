<?php

namespace core\component\tools;

use core\component\tools\ArrayToObject;

/**
 * Description of Form
 *
 * @author Thibault
 */
class Form {

    /**
     * @var String
     */
    private $method;
    /**
     * @var String
     */
    private $action;
    /**
     * @var String
     */
    private $name;
    /**
     * @var String
     */
    private $class;
    /**
     * @var String
     */
    private $enctype;
    /**
     * @var String
     */
    private $attr;
    /**
     * @var Array
     */
    private $fields;
    /**
     * @var Array
     */
    private $labels;

    /**
     * @var Item
     */
    private $item;

	public function __construct() {
		$this->fields = array();
        $this->enctype = "";
	}
	
	public function add($name, $type = "text", array $attributs = NULL, array $label = NULL, array $choices = NULL) {
        
        switch ($type) {
            case 'text':
                $this->createTypeText($name,$attributs,$label);
            break;
        
            case 'email':
                $this->createTypeEmail($name,$attributs,$label);
            break;
        
            case 'password':
                $this->createTypePwd($name,$attributs,$label);
            break;
        
            case 'radio':
                $this->createTypeRadio($name,$attributs,$label,$choices);
            break;
			
			//add thibault taff
			
			case 'file':
                $this->createTypeFile($name,$attributs,$label);
            break;
			
			case 'checkbox':
                $this->createTypeCheckbox($name,$attributs,$label,$choices);
            break;
			
			case 'color':
                $this->createTypeColor($name,$attributs,$label);
            break;
			
			case 'date':
                $this->createTypeDate($name,$attributs,$label);
            break;
			
			case 'time':
                $this->createTypeTime($name,$attributs,$label);
            break;
			
			case 'datetime':
                $this->createTypeDatetime($name,$attributs,$label);
            break;
			
			case 'datetime-local':
                $this->createTypeDatetimeLocal($name,$attributs,$label);
            break;
			
			case 'month':
                $this->createTypeMonth($name,$attributs,$label);
            break;
			
			case 'week':
                $this->createTypeWeek($name,$attributs,$label);
            break;
			
			case 'number':
                $this->createTypeNumber($name,$attributs,$label);
            break;
			
			case 'range':
                $this->createTyperange($name,$attributs,$label);
            break;
			
			case 'search':
                $this->createTypeSearch($name,$attributs,$label);
            break;
			
			case 'tel':
                $this->createTypeTel($name,$attributs,$label);
            break;
			
			case 'url':
                $this->createTypeUrl($name,$attributs,$label);
            break;
        
        
        }

    }
    
    public function createTypeEmail($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='email' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeFile($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='file' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeCheckbox($name,array $attributs,array $label, array $choices) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = array();
        foreach($choices as $choice) {
            $this->fields["$name"][] = "<input type='checkbox' name='".$this->name."[$name]' $attr value='".$choice."' /> ".$choice." ";
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
	
	public function createTypeColor($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='color' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeDate($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='date' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeTime($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='time' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeDatetime($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
            
            if(is_object($v))
                $attr .= "$a='".$v->format('d/m/Y H:i')."' ";
            else
                $attr .= "$a='$v' ";
                
        }
        $this->fields["$name"] = "<input type='datetime' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeDatetimeLocal($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='datetime-local' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeMonth($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='month' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeWeek($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='week' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeNumber($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='number' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeRange($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='range' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeSearch($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='search' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeTel($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='tel' name='".$this->name."[$name]' $attr />";
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
	
	public function createTypeUrl($name,array $attributs,array $label) {
        $attr = "";
        foreach ($attributs as $a => $v) {
                $attr .= "$a='$v' ";
        }
        $this->fields["$name"] = "<input type='url' name='".$this->name."[$name]' $attr />";
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
    
    public function getFields() {
        return $this->fields;
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
        echo $this->labels["$ref"];
    }
    
    public function getLabels() {
        return $this->labels;
    }
    
    public function open() {
        echo "<form action='$this->action' method='$this->method' id='$this->name' name='$this->name' class='$this->class' $this->enctype >";
    }
    
    public function close() {
        echo "</form>";
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

    public function setItem($item) {
        $this->item = $item;
        return $this;
    }

    public function getItem() {
        return $this->item;
    }
	
	
}


