<?php

namespace core\component\tools;

/**
 * Description of File
 *
 * @author Thibault
 */
class File {
    /**
     * @var String
     */
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
	
	public function rename($newName) {
		$rename = rename($this->file,$newName);
		return $rename;
	}
	
	public function copy($newName) {
		$copy = copy($this->file,$newName);
		return $copy;
	}
	
	public function delete() {
		$delete = unlink($this->file);
		return $delete;
	}

    /**
     * Try to write in a file
     * @param $text
     * @param $file
     * @param string $mode
     */
    public function ecrire($text, $file, $mode = 'w+') {
        $fichier = fopen($file, $mode);
        $f= fwrite($fichier, $text);
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
