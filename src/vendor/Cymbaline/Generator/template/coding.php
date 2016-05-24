<?php
$view->extend("gen_header", "Display code test"); 


?>
<h3>PHP</h3>
<pre class="prettyprint linenums lang-php">
&lt;?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use source\Cdm\PronoBox\item\Matchs;
use source\Cdm\PronoBox\form\MatchForm;

use source\Cdm\PronoBox\item\Stade;
use source\Cdm\PronoBox\item\Equipe;



/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera une vue utile à  l'affichage des données
 *
 * @author Thibault Jeannet
 */
class MatchsController extends Controller {


    /**
     * indexAction() traitera les données pour la page index
     * @return View $view
     */
    public function indexAction(Request $request) {
        
        $error = false;
        $test = "match controller cdm";
        
        $match = new Matchs();
        $m = $this->getManager();
        $m->load($match);
        $matchs = Matchs::hydrateAll($m->get());
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
            'matchs' => $matchs,
        ));
    }
    
    public function afficheAction(Request $request, array $args) {
        
        $test = "match affiche controller cdm";
        
        $match = new Matchs();
        $m = $this->getManager();
        $m->load($match);
        $match = $m->getById($args['id']);
        
        return new View(array(
            'test'  => $test,
            'match' => $match,
        ));
    }
    
    public function resultatAction(Request $request) {
        
        return new View(array(
            'test'  => 'resultat',
        ));
    }
    
    public function calendrierAction(Request $request) {
        
        return new View(array(
            'test'  => 'resultat',
        ));
    }
    
    public function newAction(Request $request) {
        
        $match = new Matchs();
        
        if(isset($request->get('post')->form_new)) {
            
            $date = new \DateTime($request->get('post')->form_new->date);
            
            $match->setDate($date);
            $match->setEquipedom($request->get('post')->form_new->equipedom);
            $match->setEquipeext($request->get('post')->form_new->equipeext);
            $match->setScoredom($request->get('post')->form_new->scoredom);
            $match->setScoreext($request->get('post')->form_new->scoreext);
            $match->setStade($request->get('post')->form_new->stade);
            $match->setJoue($request->get('post')->form_new->joue);
            $m = $this->getManager();
            $m->load($match);
            $m->push();
        }
        
        $form = new MatchForm($match);
        $form->setMethod("post");
        $form->setAction($this->path("admin_match_new"));
        
        return new View(array(
            'test'  => 'resultat',
        ),array(
            'form' => $form,
        ));
    }

    public function listeAction() {
        
        $m = $this->getManager();
        $m->load(new Matchs());
        $matchs = Matchs::hydrateAll($m->get());
        
        foreach($matchs as $id => $match) {
            $m->load(new Equipe());
            $dom = $m->getById($match->getEquipedom());
            $match->setEquipedom($dom->getNom());
            
            $m->load(new Equipe());
            $ext = $m->getById($match->getEquipeext());
            $match->setEquipeext($ext->getNom());
            
            $m->load(new Stade());
            $stade = $m->getById($match->getStade());
            $match->setStade($stade->getNom());
        }
        
        return new View(array(
            'matchs'  => $matchs,
        ));
    }
    
}


OU PLUS COMPLEXE !!



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
			
			$xml = file_get_contents("http://".$_SERVER['HTTP_HOST']."/core/config/routes.xml");
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
        $path = "/";
        foreach($this->_routes['routes']['route'] as $route => $args) {

            if($args['attrib']['name'] == $name) {        
                if(is_null($arg)) {
                  $path = $args['attrib']['path'];  
                } else {
                    $explode = explode("/",$args['attrib']['path']);                  
                    unset($explode[0]);
                    unset($explode[sizeof($explode)]);
                    $p = "";
                    foreach($explode as $element) {
                        $p .= "/$element";
                    }
                    $path = "$p/$arg"; 
                }
            }
        }
        return $path;
    }
    
    public function import() {
        
        try {
            foreach($this->_routes['routes']['import']['file'] as $file) {
                $xml = file_get_contents("http://".$_SERVER['HTTP_HOST']."".$file['source']);
                
                $this->_parser = new XmlParser($xml);
                $this->_xml = $this->_parser->array;
                
                foreach ($this->_xml['routes']['route'] as $route) {
                    
                    $this->_routes['routes']['route'][] = $route; 
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


</pre>

<h3>JS</h3>
<pre class="prettyprint linenums">
function post_to_url(path, params, method) {
	method = method || "post"; // Set method to post by default if not specified.

	// The rest of this code assumes you are not using a library.
	// It can be made less wordy if you use one.
	var form = document.createElement("form");
	form.setAttribute("method", method);
	form.setAttribute("action", path);
	form.setAttribute("enctype", "multipart/form-data");
	

	for(var key in params) {
		if(params.hasOwnProperty(key)) {
			
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", key);
				hiddenField.setAttribute("value", params[key]);

				form.appendChild(hiddenField);
			
		 }
	}

	document.body.appendChild(form);
	form.submit();
}
</pre>

<h3>CSS</h3>
<pre class="prettyprint linenums lang-css">
body {
	background: #f9f6f1;
	font: 13px/1.7em 'Open Sans';
}
    
p { 
	font: 13px/1.7em 'Open Sans'; 	
}
    
input,
button,
select,
textarea {
  font-family: 'Open Sans';
}

.dropdown .dropdown-menu {
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
}
</pre>
<h3>HTML</h3>
<pre class="prettyprint linenums">

&lt;ul id="menu1"&gt;
    &lt;li&gt;&lt;a href="#"&gt;Generator&lt;/a&gt;
        &lt;ul&gt;
            &lt;li&gt;&lt;a href="#"&gt;a&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href="#"&gt;bb&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href="#"&gt;ccc&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href="#"&gt;ddd&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href="#"&gt;eeee&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href="#"&gt;fffff&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/li&gt;
    &lt;li&gt;&lt;a href="#"&gt;Menu2&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
</pre>

<h3>YAML</h3>
<pre class="prettyprint linenums lang-yaml">
parameters:
    env: dev
    baseurl: ~
    basetitle: DKs Fram 
    controllerdefault: Cdm/PronoBox/Defaut
    
    database:
        dev:
            host: localhost
            port: ~
            dbname: alca
            dbuser: root
            dbpass: ~
        prod:
            host: ~
            port: ~
            dbname: ~
            dbuser: ~
            dbpass: ~
            
    
    roles:
        user: *
        admin: admin
</pre>

<h3>SQL</h3>
<pre class="prettyprint linenums lang-sql">
CREATE TABLE IF NOT EXISTS `Etablissement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codefiness` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codepostal` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` int(11) NOT NULL,
  `telephone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
</pre>

<h3>XML</h3>
<pre class="prettyprint linenums">
&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;routes&gt;
    
    &lt;route name="generator" path="/generator" 
           template="Alca/GenBox/template/index" controller="Alca/GenBox/Defaut" action="index" /&gt;

    &lt;route name="generator_edit" path="/generator/edit" 
           template="Alca/GenBox/template/edit-parameters" controller="Alca/GenBox/Defaut" action="edit" /&gt;  
    
    &lt;route name="generator_code" path="/generator/codex" 
           template="Alca/GenBox/template/coding" controller="Alca/GenBox/Defaut" action="code" /&gt;  
    
    &lt;route name="generator_route" path="/generator/route" 
           template="Alca/GenBox/template/routing" controller="Alca/GenBox/Defaut" action="route" /&gt;   

&lt;/routes&gt;
</pre>


<?php
$view->extend("gen_footer"); 
