<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 03/11/2015
 * Time: 01:30
 */

use core\component\tools\ArrayToObject;
use core\component\parser\YamlParser;

/**
 * @param $var
 */
function cb_debug($var,$stop = true) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
	

	
	if($stop) {
		
		die('cb_debug');
	}
}

function cb_env() {
    $yml = file_get_contents(__DIR__."/config/parameters.yml");
    $yaml = new YamlParser();
    $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
    $param = $arraytoobject->convert();
    $env = $param->parameters->env;
    return $env;
}

function cb_path($folder = "www") {
    $yml = file_get_contents(__DIR__."/config/parameters.yml");
    $yaml = new YamlParser();
    $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
    $param = $arraytoobject->convert();

    if($folder == "www")
        return $param->parameters->path->www;


    return false;
}

function cb_param($node) {
    $yml = file_get_contents(__DIR__."/config/parameters.yml");
    $yaml = new YamlParser();
    $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
    $param = $arraytoobject->convert();
	
    return $param->parameters->$node;
}

function cb_order($number) {

	switch( (int) $number) {
		case 1:
			return "1er";
		break;
		
		default:
			return $number."&egrave;me";
		break;
	}
}

function cb_esc_db($var) {
	return addslashes($var);
}