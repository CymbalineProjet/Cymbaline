<?php

// autoload function
function __autoload($class_name) {
    try {
        //var_dump($class_name);
        if(!file_exists($class_name.".php")) {
            throw new core\component\exception\CoreException('Impossible de charger '.$class_name.'.php');
        } else {
            require_once($class_name.".php");
        }
    } catch (core\component\exception\CoreException $e) {
        $e->display();
    }
    //var_dump($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $class_name);
}
