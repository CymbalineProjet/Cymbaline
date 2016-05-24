<?php

namespace core\component\exception;

use core\component\tools\File;

/**
 * 
 * ask@nilpo.com 
 * http://www.php.net/manual/fr/language.exceptions.php
 * 
 */

interface IException
{
    /* Protected methods inherited from Exception class */
    public function getMessage();                 // Exception message 
    public function getCode();                    // User-defined Exception code
    public function getFile();                    // Source filename
    public function getLine();                    // Source line
    public function getTrace();                   // An array of the backtrace()
    public function getTraceAsString();           // Formated string of trace
    
    /* Overrideable methods inherited from Exception class */
    public function __toString();                 // formated string for display
    public function __construct($message = null, $code = 0);
}

abstract class CustomException extends \Exception implements IException
{
    protected $message = 'Unknown exception';     // Exception message
    private   $string;                            // Unknown
    protected $code    = 0;                       // User-defined exception code
    protected $file;                              // Source filename of exception
    protected $line;                              // Source line of exception
    private   $trace;  
    private $fil;

    public function __construct($message = null, $code = 0, $display = true)
    {
        if (!$message) {
            throw new $this('Unknown '. get_class($this));
        }
        parent::__construct($message, $code);
        
        if($display)
            $this->display();
        
    }
    
    public function __toString()
    {
        return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
                                . "{$this->getTraceAsString()}";
    }
    
    public function setTrace(array $trace) {
        $this->trace = $trace;
        return $this;
    }
    
    public function setFile($file) {
        $this->fil = $file;
        return $this;
    }
    
    public function display() {
        
        $class = explode("\\", get_class($this));
        $class = end($class);
        $trace = str_replace("#","<br/>",$this->getTraceAsString());   
        $file = file_get_contents(__DIR__.'/../../../vendor/Cymbaline/Error/template/error.php');

        if($class == "DeniedException") {
            $file = str_replace("#class#", $class, $file);
            $file = str_replace("#file#", "", $file);
            $file = str_replace("#line#", "", $file);
            $file = str_replace("#trace#", "", $file);
            $file = str_replace("#message#", $this->getMessage(), $file);
            echo $file;
            exit;
        }
        
        if(!is_null($this->trace)) {
            $file = str_replace("#class#", $class, $file);
            $file = str_replace("#file#", $this->fil, $file);
            $file = str_replace("#line#", "", $file);
            $line = (int)$this->trace['line'];
            if($this->trace['function'] == "catch_error") {
                $line = (int)$this->trace['args'][3];
            }
            $line--;
            $start = $line - 6;
            $end = $line + 6;
            $f = new File($this->fil);
            $content = $f->get_content_file_error_display($line,$start,$end);
            $trace = "<pre class='prettyprint linenums lang-php' style='overflow-x:auto;'>$content</pre>";
            $file = str_replace("#trace#", $trace, $file);
            $file = str_replace("#message#", $this->getMessage(), $file);
            echo $file;
            exit;
        }
        
        $file = str_replace("#class#", $class, $file);
        $file = str_replace("#file#", $this->getFile(), $file);
        $file = str_replace("#line#", $this->getLine(), $file);
        $file = str_replace("#message#", $this->getMessage(), $file);
        
        if(sizeof($this->getTrace()) > 0 && is_null($this->trace)) {
            $trace = "";
            
            foreach($this->getTrace() as $error) {
                $line = (int)$error['line'];
                if($error['function'] == "catch_error") {

                    $line = (int)$error['args'][3];
                }
                $line--;
                $start = $line - 6;
                $end = $line + 6;
                $f = new File($error['file']);
                $content = $f->get_content_file_error_display($line,$start,$end);
                $trace .= "<pre class='prettyprint linenums lang-php' style='overflow-x:auto;'>$content</pre>";
            }
            $file = str_replace("#trace#", $trace, $file);
        } else {
            $file = str_replace("#trace#", "", $file);
        }
        
        echo $file;
        exit;
    }
}