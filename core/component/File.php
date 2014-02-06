<?php

namespace core\component;

/**
 * Description of File
 *
 * @author Thibault
 */
class File {
    
    private $file;
    
    public function __construct($file = NULL) {
        $this->file = $file;
    }
    
    public function getFile() {
        return $this->file;
    }
    
    public function ecrire($text, $file) {
        $fichier = fopen($file, 'w+');

        fwrite($fichier, $text); 
        fclose($fichier);
    }
}
