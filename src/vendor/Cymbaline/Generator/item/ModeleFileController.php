<?php

namespace Cymbaline\Generator\item;

use core\component\tools\ArrayToObject;
use core\component\tools\File;

/**
 * Description of ModeleFileController
 *
 * @author Thibault
 */
class ModeleFileController extends ModeleFile {
    
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
        if($this->attributs->crud) {
            $this->modele = file_get_contents(__DIR__."/../template/modele/modele-controller-crud.txt");
        }
        else {
            $this->modele = file_get_contents(__DIR__."/../template/modele/modele-controller.txt");
        }
    }
    
    public function hydrate() {
        
        $attributs = "";
        $i = 0;
        foreach($this->attributs->attr as $attr) {
            if($i != 0) {
                $attributs .= "    "."private $".$attr.";\n";
            } else {
                $attributs .= "private $".$attr.";\n";
            }
            $i++;
        }
        
        $this->modele = str_replace("#name#", $this->attributs->name, $this->modele);
        $this->modele = str_replace("#namelower#", strtolower($this->attributs->name), $this->modele);
        $this->modele = str_replace("#author#", $this->attributs->author, $this->modele);
        $this->modele = str_replace("#namespace#", str_replace(" ","",str_replace("/",'\ ',$this->attributs->path)), $this->modele);
        $this->modele = str_replace("#namespacev#", str_replace(" ","",str_replace("/",'/ ',$this->attributs->path)), $this->modele);
        $this->modele = str_replace("#attribs#", $attributs, $this->modele);

    }
    
    public function save() {
        $file = new File();
        $file->ecrire($this->modele, __DIR__.'/../../../../source/'.$this->attributs->path.'/controller/'.$this->attributs->name.'Controller.php');
    }
    
    
}
