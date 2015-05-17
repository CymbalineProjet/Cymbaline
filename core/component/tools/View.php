<?php

namespace core\component\tools;

use core\component\Parametrage;
use core\component\Route;
use core\component\Session;

/**
 * Description of View
 *
 * @author Thibault
 */
class View {
    //put your code here
    
    private $template;
    private $path;
    private $baseurl;
    private $param;
    
    public $variables;
    public $title;
    public $form;

    public function __construct(array $variables, array $form = NULL, $template = NULL) {
        $this->template = $template;
        $this->form = $form;
        
        $this->variables = $variables;
        $this->param = new Parametrage();
        $this->baseurl = $this->param->getBaseUrl();
        $this->title = $this->param->getBaseTitle();
    }

    public function getParam() {
        $param = $this->param->getParam();
        unset($param->import);
        return $param->parameters;
    }
    
    public function is_template() {
        if($this->template == NULL) {
            return false;
        } 
        
        return true;
    }
    
    public function getPath() {
        return $this->path;
    }


    public function path() {
        $path = explode("/", $this->template);
        $this->path = "/source/".$path[0]."/".$path[1]."/template/".$path[2].".php";
    }
    
    public function get($base, array $replace = NULL) {
        $path = explode("/", $base);
        $_path = __DIR__."/../../../source/".$path[0]."/".$path[1]."/template/".$path[2].".php";
        $view = $this;
        return include($_path);
    }
    
    public function extend($base, $title = NULL, array $args = null) {
        
        if(is_array($args) && !is_null($args)) {
            foreach($args as $name => $value) {
                $this->$name = $value;
            }
        }
        
        if($title != NULL) {
            $this->title = $title;
        }
        
        $_path = __DIR__."/../../../public/ressources/$base.php";
        
        if($this->ressources) {
            if(!file_exists(__DIR__."/../../../source/".$this->ressources."/$base.php")) {
                if(!file_exists(__DIR__."/../../../vendor/".$this->ressources."/$base.php")) {
                    throw new \core\component\exception\CoreException("Extend $base.php error not found.");
                } else {
                    $_path = __DIR__."/../../../vendor/".$this->ressources."/$base.php";
                }
            } else {
                $_path = __DIR__."/../../../source/".$this->ressources."/$base.php";
            }
        }
        
        $view = $this;
        return include($_path);
    }
    
    public function getBaseUrl() {
        return $this->baseurl;
    }
    
    public function redirect($url) {
        header("Location: $url");
        exit;
    }
    
    public function link($name,$arg = null) {
        $route = new Route('/');
        $path = $route->createPath($name,$arg);
        return $path;
    }
    
    public function front($path) {
        
        $_path = "http://".$_SERVER['HTTP_HOST']."/public/$path";
        
        if($this->ressources) {
            if(!file_exists(__DIR__."/../../../source/".$this->ressources."/$path")) {
                if(!file_exists(__DIR__."/../../../vendor/".$this->ressources."/$path")) {
                    throw new \core\component\exception\CoreException("http://".$_SERVER['HTTP_HOST']."/vendor/".$this->ressources."/$path");
                } else {
                    $_path = "http://".$_SERVER['HTTP_HOST']."/vendor/".$this->ressources."/$path";
                }
            } else {
                $_path = "http://".$_SERVER['HTTP_HOST']."/source/".$this->ressources."/$path";
            }
        }

        echo $_path;
    }
    
    public function session() {
        $session = new Session($_SESSION);
        return $session;
    }
    
}