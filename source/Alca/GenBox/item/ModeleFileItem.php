<?php

namespace source\Alca\GenBox\item;

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
        $this->modele = file_get_contents("http://alca.dev/AlcaFram/source/Alca/GenBox/template/modele/modele-item.txt");
    }
    
    public function hydrate() {
        var_dump($this->attributs);
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
        $this->modele = str_replace("#author#", $this->attributs->author, $this->modele);
        $this->modele = str_replace("#namespace#", str_replace(" ","",str_replace("/",'\ ',$this->attributs->path)), $this->modele);
        $this->modele = str_replace("#attribs#", $attributs, $this->modele);
    }
    
    public function save() {
        $file = new File();
        $file->ecrire($this->modele, 'source/'.$this->attributs->path.'/item/'.$this->attributs->name.'.php');
    }
    
    
}
