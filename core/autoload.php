<?php

// autoload function
function __autoload($class_name) {
    try {
		$class_name= str_replace("\\","/",$class_name);
        
        if(!file_exists($class_name.".php")) {
            if(!file_exists("vendor/".$class_name.".php")) {
                throw new core\component\exception\CoreException('Impossible de charger '.$class_name.'.php');
            } else {
                require_once("vendor/".$class_name.".php");
            }
        } else {
            require_once($class_name.".php");
        }
    } catch (core\component\exception\CoreException $e) {
        $e->display();
    }
}

function catch_error($errno, $errstr, $errfile, $errline,$error_level) {
    throw new \core\component\exception\CatchableException($errstr);
}

set_error_handler('catch_error');