<?php

include 'functions.php';
include 'images.php';

// autoload function
function __autoload($class_name) {

    try {
		$class_name= str_replace("\\","/",$class_name);

        if(!file_exists($class_name.".php")) {
            if(!file_exists("vendor/".$class_name.".php")) {
                if(!file_exists(__DIR__."/../".$class_name.".php")) {
				
                    throw new core\component\exception\CoreException('Impossible de charger '.__DIR__."/../".$class_name.'.php');
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
    } catch (core\component\exception\CoreException $e) {
        $e->display();
    }
}

/*
register_shutdown_function( "fatal_handler" );

function test($errno, $errstr, $errfile, $errline, $nn) {
    var_dump($errstr);
    throw new \core\component\exception\CatchableException($errstr);
}

function fatal_handler() {
  $errfile = "unknown file";
  $errstr  = "shutdown";
  $errno   = E_CORE_ERROR;
  $errline = 0;

  $error = error_get_last();
  
  if( $error !== NULL) {
    $errno   = $error["type"];
    $errfile = $error["file"];
    $errline = $error["line"];
    $errstr  = $error["message"];

    test($errno, $errstr, $errfile, $errline, null);
  }
}



function catch_error($errno, $errstr, $errfile, $errline,$error_level) {
    throw new \core\component\exception\CatchableException($errstr);
}

set_error_handler('catch_error');*/

define('E_FATAL',  E_ERROR | E_USER_ERROR | E_PARSE | E_CORE_ERROR | 
        E_COMPILE_ERROR | E_RECOVERABLE_ERROR);

define('ENV', 'production');

//Custom error handling vars
define('DISPLAY_ERRORS', TRUE);
define('ERROR_REPORTING', E_ALL | E_STRICT);
define('LOG_ERRORS', TRUE);

register_shutdown_function('shut');

set_error_handler('handler');

//Function to catch no user error handler function errors...
function shut(){

    $error = error_get_last();

    if($error && ($error['type'] & E_FATAL)){
        handler($error['type'], $error['message'], $error['file'], $error['line']);
    }

}

function handler( $errno, $errstr, $errfile, $errline ) {

    switch ($errno){

        case E_ERROR: // 1 //
            $typestr = 'E_ERROR'; break;
        case E_WARNING: // 2 //
            $typestr = 'E_WARNING'; break;
        case E_PARSE: // 4 //
            $typestr = 'E_PARSE'; break;
        case E_NOTICE: // 8 //
            $typestr = 'E_NOTICE'; break;
        case E_CORE_ERROR: // 16 //
            $typestr = 'E_CORE_ERROR'; break;
        case E_CORE_WARNING: // 32 //
            $typestr = 'E_CORE_WARNING'; break;
        case E_COMPILE_ERROR: // 64 //
            $typestr = 'E_COMPILE_ERROR'; break;
        case E_CORE_WARNING: // 128 //
            $typestr = 'E_COMPILE_WARNING'; break;
        case E_USER_ERROR: // 256 //
            $typestr = 'E_USER_ERROR'; break;
        case E_USER_WARNING: // 512 //
            $typestr = 'E_USER_WARNING'; break;
        case E_USER_NOTICE: // 1024 //
            $typestr = 'E_USER_NOTICE'; break;
        case E_STRICT: // 2048 //
            $typestr = 'E_STRICT'; break;
        case E_RECOVERABLE_ERROR: // 4096 //
            $typestr = 'E_RECOVERABLE_ERROR'; break;
        case E_DEPRECATED: // 8192 //
            $typestr = 'E_DEPRECATED'; break;
        case E_USER_DEPRECATED: // 16384 //
            $typestr = 'E_USER_DEPRECATED'; break;

    }

    $message = '<b>'.$typestr.': </b>'.$errstr.' in <b>'.$errfile.'</b> on line <b>'.$errline.'</b><br/>';

    if(($errno & E_FATAL) && ENV === 'production2'){

        header('Location: 500.html');
        header('Status: 500 Internal Server Error');

    }

    if(!($errno & ERROR_REPORTING))
        return;

    if(DISPLAY_ERRORS) { 
        //header('Location: /error');
        //header('Status: Fatal Error');
    }

    //Logging error on php file error log...
    if(LOG_ERRORS)
        error_log(strip_tags($message), 0);

}
