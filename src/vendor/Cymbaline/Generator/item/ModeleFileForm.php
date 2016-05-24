<?php

namespace Cymbaline\Generator\item;

use core\component\tools\ArrayToObject;
use core\component\tools\File;

/**
 * Description of ModeleFileForm
 *
 * @author Thibault
 */
class ModeleFileForm extends ModeleFile {
    
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
        $this->modele = file_get_contents(__DIR__."/../template/modele/modele-form.txt");
    }
    
    public function hydrate() {

        $this->modele = str_replace("#name#", $this->attributs->name, $this->modele);
        $this->modele = str_replace("#author#", $this->attributs->author, $this->modele);
        $this->modele = str_replace("#namespace#", str_replace(" ","",str_replace("/",'\ ',$this->attributs->path)), $this->modele);

    }
    
    public function save() {
        $file = new File();
        $file->ecrire($this->modele, __DIR__.'/../../../../source/'.$this->attributs->path.'/form/'.$this->attributs->name.'Form.php');
    }
    
    
}
