<?php

namespace core\component;

use core\component\exception\RouteException;
use core\component\parser\XmlParser;
use core\component\Parametrage;

/**
 * Description of Route
 *
 * @author Thibault Jeannet @La_Rustine
 */
class Route {
    
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
			
			$xml = file_get_contents("http://alca.dev/AlcaFram/core/config/routes.xml");
			$this->_parser = new XmlParser($xml);
			$this->_routes = $this->_parser->array;
			$this->path = $url;
			$this->param = new Parametrage();
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
			}
			
			$url = explode("/",$this->path);
			$true = false;
			foreach($this->_routes as $route => $args) {

				$r = explode("/", $route);
				unset($r[0]);

				if(sizeof($url) == sizeof($r) /*and sizeof($url) != 1*/) {				
					$test = strpos( $route, "/".$url[0]);
					if(is_int($test)) {
						if(sizeof($url) != 1) {
							/*unset($r[1]);
							unset($url[0]);*/
							$_args = array();
							//var_dump($url);
							//var_dump($r);
							$end_r = str_replace("@","",end($r));
							$_args[$end_r] = end($url);

							$this->_routes[$route]['_args'] = $_args;
							
							$rrr = $this->_routes[$route];
							//var_dump($args);
							$true = true;
						}
					}
				}	
				
			}
			
			if(isset($this->_routes[str_replace($this->param->getBaseUrl(),"","/".$this->path)]) or $true)  {
				if($true) {
					$route = $rrr;

				} else {
					$route = $this->_routes[str_replace($this->param->getBaseUrl(),"",$_SERVER['REQUEST_URI'])];
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
