<?php

namespace Cymbaline\Utils;

use core\component\tools\ArrayToObject;
use core\component\parser\YamlParser;

/**
 * Description of Utils
 *
 * @author Thibault
 */
class Utils {
    
    private $param;
    
    public function __construct() {
        $yml = file_get_contents(__DIR__."/../../../core/config/parameters.yml");
        $yaml = new YamlParser();
        $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
        $this->param = $arraytoobject->convert();
        
        /*echo "<pre>";
        var_dump($this->param);
        var_dump($yaml->load($yml));
        echo "</pre>";*/
    }
    
}
