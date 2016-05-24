<?php

namespace Cymbaline\Cymbalog\item;

use core\component\tools\File;
use core\component\tools\ArrayToObject;
use core\component\parser\YamlParser;

class Cymbalog {

    const LOG_TYPE_SQL    = 1;
    const LOG_TYPE_SCRIPT = 2;
    const LOG_TYPE_SESSION = 3;
    const LOG_TYPE_ERROR = 4;
    const LEVEL_LOW       = 1;
    const LEVEL_MIDDLE    = 2;
    const LEVEL_HIGH      = 3;
    const FILE            = "log/cymbalog.{env}.{type}.log";
    const MODEL           = "[{date}][{level}] {message}";

    protected $date;
    protected $message;
    protected $type;
    protected $level;
    protected $env;
    protected $file;

    public function __construct($type = self::LOG_TYPE_SQL, $level = self::LEVEL_LOW) {

        $this->env   = cb_env();
        $this->type  = $type;
        $this->date  = date('Y-m-d H:i:s');
        $this->level = $this->getLevel($level);
		$this->message = null;
    }

    public function log($function = null,$line = null) {
        $this->getFile();
        $file = new File(cb_path().$this->file);
		
		list($usec, $sec) = explode(' ', microtime());

		$usec = str_replace("0.", ".", $usec);    

        $text = self::MODEL;
        $text = str_replace("{date}",date($this->date, $sec) . $usec,$text);
        $text = str_replace("{level}",$this->level,$text);
		
		if(is_null($this->message))
			$message = "Error in $function at l.$line";
		else
			$message = $this->message;
		
        $text = str_replace("{message}",$message,$text);

        $file->ecrire($text."\n",cb_path().$this->file,"a");


    }

    protected function set($key,$value) {
        $this->$key = $value;
        return $this;
    }

    protected function get($key) {
        return $this->$key;
    }

    private function getFile() {
        switch($this->type) {
            case 1:
                $type = "mysql";
                break;

            case 2:
                $type = "script";
                break;
				
			case 3:
                $type = "session";
                break;
				
			case 3:
                $type = "error";
                break;
        }

        $this->file = str_replace("{env}",$this->env,self::FILE);
        $this->file = str_replace("{type}",$type,$this->file);
    }

    private function getLevel($level) {
        switch($level) {
            case self::LEVEL_LOW:
                    return "LOW";
                break;
            case self::LEVEL_MIDDLE:
                    return "MIDDLE";
                break;
            case self::LEVEL_HIGH:
                    return "HIGH";
                break;
        }
    }


}