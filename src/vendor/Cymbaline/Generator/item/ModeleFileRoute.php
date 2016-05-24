<?php

namespace Cymbaline\Generator\item;

use core\component\tools\ArrayToObject;
use core\component\tools\File;

/**
 * Description of ModeleFileRoute
 *
 * @author Thibault
 */
class ModeleFileRoute extends ModeleFile {
    
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
            $this->modele = file_get_contents(__DIR__."/../template/modele/modele-route-crud-yml.txt");
        } else {
            $this->modele = file_get_contents(__DIR__."/../template/modele/modele-route-yml.txt");
        }
    }
    
    public function hydrate() {
        $this->modele = str_replace("#template#", "template/".ucfirst($this->attributs->name), $this->modele);
        $this->modele = str_replace("#path#", $this->attributs->path, $this->modele);
        $this->modele = str_replace("#name#", $this->attributs->name, $this->modele);
        $this->modele = str_replace("#namelower#", strtolower($this->attributs->name), $this->modele);
    }
    
    public function save() {
        $file = new File(__DIR__.'/../../../../source/'.$this->attributs->path.'/config/routes.yml');
        if($file->exists()) {
            $content = $file->getContent();
            $pos = strpos($content, $this->modele);
            if($pos === false) {
                $this->modele = $this->modele."\n\n".$content;
                $file->ecrire($this->modele, __DIR__.'/../../../../source/'.$this->attributs->path.'/config/routes.yml');
            } 
        } else {
            $file->ecrire($this->modele, __DIR__.'/../../../../source/'.$this->attributs->path.'/config/routes.yml');
        }
        
        
    }
    
    
}
