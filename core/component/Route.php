<?php

namespace core\component;

use core\component\exception\RouteException;
use core\component\parser\XmlParser;
use core\component\parser\YamlParser;
use core\component\tools\ArrayToObject;
use core\component\Parametrage;

/**
 * Description of Route
 *
 * @author Thibault Jeannet @La_Rustine
 */
class Route {
    
    private $_xml;
	private $_routes;
	private $_parser;
    private $path;
	private $template;
	private $controller;
	private $action;
	private $method;
	private $args;
	private $param;
	
	/**
	* Route constructeur
	* Récupère toutes les routes du fichier XML
	*
	*/
	public function __construct($url) {
		try {
			if($url == NULL) {
				throw new RouteException("La route passée dans le controller est nulle.");
			}
			
			$xml = file_get_contents(__DIR__."/../config/routes.xml");
			$this->_parser = new XmlParser($xml);
			$this->_routes = $this->_parser->array;
			$this->path = $url;
			$this->param = new Parametrage();
            $this->import();
           
		} catch (RouteException $e) {
			$e->display();
		}
	}
    
    public function createPath($name,$arg = null) {
        $path = $this->param->getBaseUrl();
        foreach($this->_routes['routes']['route'] as $route => $args) {

            if($args['attrib']['name'] == $name) {        
                if(is_null($arg)) {
                  $path = $this->param->getBaseUrl().$args['attrib']['path'];  
                } else {
                    $explode = explode("/",$args['attrib']['path']);                  
                    unset($explode[0]);
                    unset($explode[sizeof($explode)]);
                    $p = "";
                    foreach($explode as $element) {
                        $p .= "/$element";
                    }
                    $path = $this->param->getBaseUrl()."$p/$arg"; 
                }
            }
        }
		
        return $path;
    }
    
    public function import() {
       
        try {
            $yml = file_get_contents(__DIR__."/../../core/config/import.yml");
            $yaml = new YamlParser();
            $arraytoobject = new ArrayToObject($yaml->load($yml),TRUE);
            $import = $arraytoobject->convert();

            if($import != "") {
                foreach($import->import as $file) {
                    $xml = file_get_contents(__DIR__."/../..".$file->path);
                    $this->_parser = new XmlParser($xml);
                    $this->_xml = $this->_parser->array;
                    foreach ($this->_xml['routes']['route'] as $route) {
                        $this->_routes['routes']['route'][] = $route; 
                    }
                }
            }
        } catch (RouteException $e) {
            $e->display();
        }
    }
	
	/**
	* Retourne une occurence de route en fonction de l'url
	* On récupère les portions "attributs" 
	* Ex : "/utilisateur/@id" => on récupère @id qu'on passe dans les args avec sa valeur
	* @return array(
        *               "_template"   => "Cdm/PronoBox/template/index",
    	*               "_controller" => "Cdm/PronoBox/Defaut",
    	*               "_action"     => "index",
    	*               "_method"     => "get",
    	*               "_args"       => false,
    	*           )
	*/
	public function load() {
		try {
            
			if($this->path == NULL) {
				throw new RouteException("Path null. Impossible de charger la route.");
			} else if($this->path == "/") {                
                foreach($this->_routes['routes']['route'] as $route => $args) {  
                    if($args['attrib']['path'] == $this->path) {
                        return $this->_routes['routes']['route'][$route]['attrib'];
                    }
                }                
            }
			
			$url = explode("/",$this->path);
            
			$true = false;
            $is_route = false;
            foreach($this->_routes['routes']['route'] as $route => $args) {
                    
				$r = explode("/", $args['attrib']['path']);
				unset($r[0]);
                
				if(sizeof($url) == sizeof($r)) {
                    if($args['attrib']['path'] == "/".$this->path) {
                        $is_route = true;
                        $idroute = $route;
                        break;
                    }
                }
            }
			foreach($this->_routes['routes']['route'] as $route => $args) {
                    
                if($is_route)
                    break;
                    
				$r = explode("/", $args['attrib']['path']);
				unset($r[0]);
                
				if(sizeof($url) == sizeof($r)) {
                    $nbre_arg = substr_count($args['attrib']['path'], '@');
                    
                    if($nbre_arg == 1) {
                        
                        $n = sizeof($url);
                        for($y=0;$y<=$n-2;$y++) {
                            if($url[$y] == $r[$y+1]) {
                                $egal = true;
                            } else {
                                $egal = false;
                            }
                        }
                        if($egal) {
                            $posaro = strpos(end($r),"@");
                            $end_r = substr(end($r), $posaro);
                            $end_r = str_replace("@","",$end_r);
                            $_args[$end_r] = end($url);
                            $idroute = $route;
                            $this->_routes['routes']['route'][$route]['attrib']['args'] = $_args;
                            break;
                        }
                    } else if($nbre_arg != 0) {
                        $nbre_tab = sizeof($r);
                        $n = sizeof($url);
                        $o = 1+$nbre_arg;
                        for($y=0;$y<=$n-$o;$y++) {
                            if($url[$y] == $r[$y+1]) {
                                $egal = true;
                            } else {
                                $egal = false;
                            }
                        }
                        
                        if($egal) {
                            for($i=$nbre_tab-$nbre_arg+1;$i<=$nbre_tab;$i++) {
                                $posaro = strpos($r[$i],"@");
                                $end_r = substr($r[$i], $posaro);
                                $end_r = str_replace("@","",$end_r);
                                $_args[$end_r] = $url[$i-1];
                            }
                            $idroute = $route;
                            $this->_routes['routes']['route'][$route]['attrib']['args'] = $_args;
                            break;
                        }
                    } 
				}	
			}

            if(!isset($idroute)) {
                throw new RouteException("Cette page n'existe pas");
            }
            
            $path = str_replace($this->param->getBaseUrl(),"","/".$this->path);
            $route_path = $this->_routes['routes']['route'][$idroute]['attrib']['path'];
            $mypath = explode("/",$path);
            $myroute_path = explode("/",$route_path);
            if(sizeof($mypath) != sizeof($myroute_path)) {
                throw new RouteException("La route demandée n'existe pas.");
            }
            unset($mypath[0]);
            unset($myroute_path[0]);
            
            foreach($myroute_path as $_id => $p) {
                if($p == $mypath[$_id]) {
                    
                } else {
                    $pos = strpos($p, "@");
                    if(is_int($pos)) {
                        $param_arg = explode("@",$p);
                        if($param_arg[0] != "") {
                            switch($param_arg[0]) {
                                case "int":
                                    if(is_numeric($mypath[$_id])) {
                                        
                                    } else {
                                        throw new RouteException("Cette page n'existe pas");
                                    }
                                break;
                            
                                case "string":
                                    if(is_numeric($mypath[$_id])) {
                                        throw new RouteException("Cette page n'existe pas");
                                    } else {
                                        
                                    }
                                break;
                            }
                        } else {
                            if(is_numeric($mypath[$_id])) {
                                throw new RouteException("Cette page n'existe pas");
                            } else {

                            }
                        }
                    } /*else {
                        throw new RouteException("La route demandée n'existe pas.");
                    */
                }                
            }

			if(isset($this->_routes['routes']['route'][$idroute]) or $true)  {
				if($true) {
					$route = $rrr['attrib'];
				} else {
					$route = $this->_routes['routes']['route'][$idroute]['attrib'];
				}
			} else {
				throw new RouteException("La route demandée n'existe pas dans le fichier de configuration.");
			}

			return $route;
		
		} catch (RouteException $e) {
			$e->display();
		}
	}
	
	/**
	* Retourne un tableau des routes
	* @return array
	*/
	public function getRoutes() {
		return $this->_routes;
	}
	
	/**
	* Retourne le path de la route
	* @return string
	*/
	public function getPath() {
		return $this->path;
	}
	
	/**
	* Retourne l'occurence après modification du path
	* @param $path string
	* @return Route
	*/
	public function setPath($path) {
		$this->path = $path;
		return $this;
	}
	
	/**
	* Retourne le lien vers le template
	* @return string
	*/
	public function getTemplate() {
		return $this->template;
	}
	
	/**
	* Retourne une occurence de route
	* @param $template string
	* @return Route
	*/
	public function setTemplate($template) {
		$this->template = $template;
		return $this;
	}
	
	/**
	* Retourne le lien vers le controller
	* @return strig
	*/
	public function getController() {
		return $this->controller;
	}
	
	/**
	* Retourne une occurence de route
	* @param $controller string
	* @return Route
	*/
	public function setController($controller) {
		$this->controller  = $controller;
		return $this;
	}
	
	/**
	* Retourne l'action du controller
	* @return string
	*/
	public function getAction() {
		return $this->action;
	}
	
	/**
	* Retourne une occurence de route
	* @param $action string
	* @return Route
	*/
	public function setAction($action) {
		$this->action = $action;
		return $this;
	}
	
	/**
	* Retourne la methode http
	* @return string
	*/
	public function getMethod() {
		return $this->method;
	}
	
	/**
	* Retourne une occurence de Route
	* @param $method string
	* @return Route
	*/
	public function setMethod($method) {
		$this->method = $method;
		return $this;
	}
	
	/**
	* Retourne un tableau d'arguments
	* @return array
	*/
	public function getArgs() {
		return $this->args;
	}
	
	/**
	* Retourne une occurence de Route
	* @param $args array
	* @return Route
	*/
	public function setArgs(array $args) {
		$this->args = $args;
		return $this;
	}
	
}
