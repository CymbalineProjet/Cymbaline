<?php

namespace core\component\tools;

use core\component\Parametrage;
use core\component\Route;

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
    
    //retravailler la view -> deplace le lien en 2eme position et on le rend false par defaut (
            //on utilisera par defaut celui renseigner dans les routes
    public function __construct(array $variables, array $form = NULL, $template = NULL) {
        $this->template = $template;
        $this->form = $form;
        
        $this->variables = $variables;
        //$this->path();
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
        $_path = "http://".$_SERVER['SERVER_NAME'].$this->baseurl."/source/".$path[0]."/".$path[1]."/template/".$path[2].".php";
        
        /*$content = file_get_contents($_path);
        
        if($replace != NULL) {
            foreach($replace as $k => $value) {
                $content = str_replace("#$k#", $value, $content);
            }
        } 
        
        echo $content;*/
        
        return include($_path);
    }
    
    public function extend($base, $title = NULL) {
        //var_dump($title);
        if($title == NULL) {
            $title = $this->title;
        }
        
        $title = str_replace(" ", "%20", $title);
        
        $_path = "http://".$_SERVER['SERVER_NAME'].$this->baseurl."/public/ressources/".$base.".php?title=".$title;
        //$content = file_get_contents($_path);
        
        return include($_path);
        /*
        if($title == NULL) {
            $title = $this->title;
            $html = str_replace("#title#", $title, $content);
            $html = str_replace("#baseurl#", "http://".$_SERVER['SERVER_NAME'].$this->baseurl."/", $html);
        } else {
            $html = str_replace("#title#", $title, $content);
            $html = str_replace("#baseurl#", "http://".$_SERVER['SERVER_NAME'].$this->baseurl."/", $html);
        }
        
        echo $html;*/
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