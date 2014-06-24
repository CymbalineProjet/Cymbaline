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
    
    public $variables;
    public $title;
    public $form;

    public function __construct(array $variables, array $form = NULL, $template = NULL) {
        $this->template = $template;
        $this->form = $form;
        
        $this->variables = $variables;
        $param = new Parametrage();
        $this->baseurl = $param->getBaseUrl();
        $this->title = $param->getBaseTitle();
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
        $_path = "http://".$_SERVER['SERVER_NAME'].$this->baseurl."/public/$path";
        echo $_path;
    }
    
    public function session() {
        $session = new Session($_SESSION);
        return $session;
    }
    
}
/*
 * pour que ca puisse fonctionne
 * $view->extend($base,$title = null); //$view->extend('demo','nouveau titre');
 * ou
 * $view->get($path); //$view->get('footer');
 * 
 * dans index.php il faut supprimer le html et le passé dans des vues
 * exemple : template/base/header.php ou template/menu.php
 * 
 * retourne l'include du fichier  
 *  
 */