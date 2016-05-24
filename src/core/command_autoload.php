<?php

//include 'functions.php';

// autoload function
function __autoload($class_name) {

		$class_name= str_replace("\\","/",$class_name);

        if(!file_exists($class_name.".php")) {
            if(!file_exists("vendor/".$class_name.".php")) {
                if(!file_exists(__DIR__."/../".$class_name.".php")) {
				
                    die('Impossible de charger '.__DIR__."/../".$class_name.'.php');
                } else {
				cb_debug('plop',false);
                    echo __DIR__."/..".$class_name.".php";
                    require_once(__DIR__."/../".$class_name.".php");
                }
            } else {
			
				require_once("vendor/".$class_name.".php");
            }
        } else {
            require_once($class_name.".php");
        }
   
}