<?php

namespace Cymbaline\Generator\item;

use core\component\tools\ArrayToObject;
use core\component\tools\File;

/**
 * Description of ModeleFileTemplate
 *
 * @author Thibault
 */
class ModeleFileTemplate extends ModeleFile {
    
    private $modele;
    private $templates = array("index","new","edit");
    private $attributs;
    
    public function __construct(array $attributs) {

        $array = new ArrayToObject($attributs);
        $this->attributs = $array->convert();
        $this->create_folder();
        foreach($this->templates as $template) {
            $this->load($template);
          
            $this->hydrate();
            $this->save($template);
        }
        
    }

    public function create_folder() {
        if(!is_dir('source/'.$this->attributs->path.'/template/'.strtolower($this->attributs->name).'/')) {
            mkdir(__DIR__.'/../../../../source/'.$this->attributs->path.'/template/'.strtolower($this->attributs->name).'/', 0777, true);  
        }
    }
    
    public function load($template) {
        
        $this->modele = file_get_contents(__DIR__."/../template/modele/modele-template-$template.txt");
    }
    
    public function hydrate() {
        
        $this->modele = str_replace("#name#", $this->attributs->name, $this->modele);
        $this->modele = str_replace("#namelower#", strtolower($this->attributs->name), $this->modele);
        $this->modele = str_replace("#attr_head#", $this->get_attr_head(), $this->modele);
        $this->modele = str_replace("#attr#", $this->get_attr(), $this->modele);

    }
    
    public function save($template) {
        $file = new File();
        $file->ecrire($this->modele, __DIR__.'/../../../../source/'.$this->attributs->path.'/template/'.strtolower($this->attributs->name).'/'.$template.'.php');
    }    

    public function get_attr() {
        $attributs = "";
        $i = 0;
        $n = sizeof($this->attributs->attr)-1;
         
        foreach($this->attributs->attr as $attr) {

            if($i != 0 && $n != $i) {
                $attributs .= "\techo \"<td>\" ".'.$item->get'.ucfirst($attr)."(). \"</td>\";\n";
            } else if ($n == $i) {
                $attributs .= "\techo \"<td>\" ".'.$item->get'.ucfirst($attr)."(). \"</td>\";";
            } else {
                $attributs .= "echo \"<td>\" ".'.$item->get'.ucfirst($attr)."(). \"</td>\";\n";
            }
            $i++;
        }

        return $attributs;
    }

    public function get_attr_head() {
        $attributs = "";
        $i = 0;
        $n = sizeof($this->attributs->attr)-1;

        foreach($this->attributs->attr as $attr) {
            if($i != 0 && $n != $i) {
                $attributs .= "\t\t<td>$attr</td>\n";
            } else if ($n == $i) {
                $attributs .= "\t\t<td>$attr</td>";
            } else {
                $attributs .= "<td>$attr</td>\n";
            }
            $i++;
        }

        return $attributs;
    }
    
}
