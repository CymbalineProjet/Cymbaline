<?php

namespace core\component\tools;

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

    public function getContent() {
        return file_get_contents($this->file);
    }

    public function exists() {
        return file_exists($this->file);
    }
    
    public function ecrire($text, $file) {
        $fichier = fopen($file, 'w+');
        fwrite($fichier, $text);         
        fclose($fichier);
    }
    
    public function get_content_file_error_display($line,$start = false,$end = false) {
        $contenu = fread(fopen($this->file, "r"), filesize($this->file));
        $contenu_array = explode("\n",$contenu);
        $text = "";
        if($start && $end) {
            for($i=$start;$i<=$end;$i++) {
                if(isset($contenu_array[$i])) {
                    if($line == $i) {
                        $text .= "<p style='color:red;'>$i ".$contenu_array[$i]."</p>";
                    } else {
                        $text .= "<p>$i ".$contenu_array[$i]."</p>";
                    }   
                }
            }
        } else {
            foreach($contenu_array as $id => $content) {
                $text .= "<p>$id ".$content."</p>";
            }
        }
        
        return $text;
    }
}
