<?php

// autoload function
function __autoload($class_name) {
	require_once($class_name.".php");
    //var_dump($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $class_name);
}
