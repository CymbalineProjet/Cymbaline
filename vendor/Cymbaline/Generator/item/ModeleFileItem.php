<?php

namespace Cymbaline\Generator\item;

use core\component\tools\ArrayToObject;
use core\component\tools\File;

/**
 * Description of ModeleFileItem
 *
 * @author Thibault
 */
class ModeleFileItem extends ModeleFile {
    
    private $modele;

    private $attributs;
    
    public function __construct(array $attributs) {
        $array = new ArrayToObject($attributs);
        $this->attributs = $array->convert();
        $this->load();
        $this->hydrate();
        $this->save();
    }
    
    public function load() {
        $this->modele = file_get_contents(__DIR__."/../template/modele/modele-item.txt");
    }
    
    public function hydrate() {
        $attributs = "";
        $i = 0;
        foreach($this->attributs->attr as $attr) {
            if($i != 0) {
                $attributs .= "\t"."/**\n\t*#type=int#\n\t*#name=attr#\n\t*/\n\tprivate $$attr;\n\n";
            } else {
                $attributs .= "/**\n\t*#type=int#\n\t*#name=attr#\n\t*/\n\tprivate $$attr;\n\n";
            }
            $i++;
        }
        
        $this->modele = str_replace("#name#", $this->attributs->name, $this->modele);
        $this->modele = str_replace("#author#", $this->attributs->author, $this->modele);
        $this->modele = str_replace("#namespace#", str_replace(" ","",str_replace("/",'\ ',$this->attributs->path)), $this->modele);
        $this->modele = str_replace("#attribs#", $attributs, $this->modele);
        $this->modele = str_replace("#getter#",$this->getter(),$this->modele);
        $this->modele = str_replace("#setter#",$this->setter(),$this->modele);

    }
    
    public function save() {
        $file = new File();
        $file->ecrire($this->modele, __DIR__.'/../../../../source/'.$this->attributs->path.'/item/'.$this->attributs->name.'.php');
    }

    public function getter() {
        $getter = "";
        $i = 0;
        foreach($this->attributs->attr as $attr) {
            if($i != 0) {
                $getter .= "\tpublic function get".ucfirst($attr)."() {\n\t\treturn ".'$this'."->$attr;\n\t}\n\n";
            } else {
                $getter .= "public function get".ucfirst($attr)."() {\n\t\treturn ".'$this'."->$attr;\n\t}\n\n";
            }
            $i++;
        }

        return $getter;
    }

    public function setter() {
        $setter = "";
        $i = 0;
        foreach($this->attributs->attr as $attr) {
            if($i != 0) {
                $setter .= "\tpublic function set".ucfirst($attr)."($$attr) {\n\t\t".'$this'."->$attr = $$attr;\n\t\treturn ".'$this'."->$attr;\n\t}\n\n";
            } else {
                $setter .= "public function set".ucfirst($attr)."($$attr) {\n\t\t".'$this'."->$attr = $$attr;\n\t\treturn ".'$this'."->$attr;\n\t}\n\n";
            }
            $i++;
        }

        return $setter;
    }
    
    
}
