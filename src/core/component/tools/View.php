<?php

namespace core\component\tools;

use core\component\Parametrage;
use core\component\Route;
use core\component\Session;
use core\component\Service;

use core\component\exception\VarException;

use Cymbaline\Community\Tools\Community;

/**
 * Description of View
 *
 * @author Thibault
 */
class View {

    /**
     * @var String
     */
    private $template;
    /**
     * @var String
     */
    private $path;
    /**
     * @var String
     */
    private $baseurl;
    /**
     * @var Parametrage
     */
    private $param;
    /**
     * @var Object
     */
    private $tools;

    /**
     * @var Array
     */
    public $variables;
    /**
     * @var String
     */
    public $title;
    /**
     * @var Array
     */
    public $form;
	
	public $toolbar;

    public function __construct(array $variables, array $form = NULL, $template = NULL) {
        $this->template = $template;
        $this->form = $form;
        
        $this->variables = $variables;
        $this->param = new Parametrage();
        $this->baseurl = $this->param->getBaseUrl();
        $this->title = $this->param->getBaseTitle();
		
		if(cb_env() == "dev") 
			$this->toolbar = true;
		else 
			$this->toolbar = false;

        $this->loadTools();
    }

    public function loadTools() {
        
        $files = scandir(__DIR__);
        unset($files[0]);
        unset($files[1]);
        unset($files[6]);

        foreach ($files as $value) {
            $v = explode(".",$value);
            $class = $v[0];
            $c = str_replace(" ","",'core\component\tools\ '.$class);
            
            $this->tools[$v[0]] = $c;
        }
          
    }

    public function tool($name) {
        if(is_null($name))
            throw new VarException("$this->tool(name) name is null");

        if(!isset($this->tools[$name]))
            throw new VarException("$this->tool(name) $name is not a tool");

        $tool = $this->tools[$name];

        return  new $tool();

    }
	
	/**
     * @param null $service
     * @return mixed $service
     */
    public function service($service = null) {
        try {
            
            if(is_null($service)) {
                throw new CoreException("Impossible de charger le service. Aucune service renseigné.");
            } else {
                $s = new Service();
                $service = $s->get($service);
               
                return $service;
            }
                        
        } catch (CoreException $e) {
            $e->display();
        }
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
                    throw new \core\component\exception\CoreException(__DIR__."/../../../vendor/".$this->ressources."/$base.php");
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
        echo $path;
    }
    
    public function front($path,$ressources = true) {
        
        $_path = "http://".$_SERVER['HTTP_HOST']."/public/$path";
        
        if($this->ressources && $ressources) {
            if(!file_exists(__DIR__."/../../../source/".$this->ressources."/$path")) {
                if(!file_exists(__DIR__."/../../../vendor/".$this->ressources."/$path")) {
                    throw new \core\component\exception\CoreException(__DIR__."/../../../vendor/".$this->ressources."/$path");
                } else {
                    $_path = "http://".$_SERVER['HTTP_HOST']."/vendor/".$this->ressources."/$path";
                }
            } else {
                $_path = "http://".$_SERVER['HTTP_HOST']."/source/".$this->ressources."/$path";
            }
        }

        echo $_path;
    }
	
	public function assets($path) {
        
        $_path = "http://".$_SERVER['HTTP_HOST']."/public/$path";
        
        if($path) {
            if(!file_exists(__DIR__."/../../../source/$path")) {
                if(!file_exists(__DIR__."/../../../vendor/$path")) {
                    throw new \core\component\exception\CoreException(__DIR__."/../../../vendor/$path");
                } else {
                    $_path = "http://".$_SERVER['HTTP_HOST']."/vendor/$path";
                }
            } else {
                $_path = "http://".$_SERVER['HTTP_HOST']."/source/$path";
            }
        }

        echo $_path;
    }
    
    public function session() {
        $session = new Session($_SESSION);
        return $session;
    }
	
	public function community() {
		$community = new Community();
		return $community;
	}
    
}