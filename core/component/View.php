<?php

namespace core\component;

use core\component\Parametrage;

/**
 * Description of View
 *
 * @author Thibault
 */
class View {
    //put your code here
    
    private $template;
    public $form;
    public $variables;
    private $path;
    private $baseurl;
    public $title;
    
    public function __construct($template, array $variables, array $form = NULL) {
        $this->template = $template;
        $this->form = $form;
        
        $this->variables = $variables;
        $this->path();
        $param = new Parametrage();
        $this->baseurl = $param->getBaseUrl();
        $this->title = $param->getBaseTitle();
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
        $content = file_get_contents($_path);
        
        if($replace != NULL) {
            foreach($replace as $k => $value) {
                $content = str_replace("#$k#", $value, $content);
            }
        } 
        
        echo $content;
    }
    
    public function extend($base, $title = NULL) {

        $_path = "http://".$_SERVER['SERVER_NAME'].$this->baseurl."/core/ressources/".$base.".php";
        $content = file_get_contents($_path);
        
        if($title == NULL) {
            $title = $this->title;
            $html = str_replace("#title#", $title, $content);
            $html = str_replace("#baseurl#", "http://".$_SERVER['SERVER_NAME'].$this->baseurl."/", $html);
        } else {
            $html = str_replace("#title#", $title, $content);
            $html = str_replace("#baseurl#", "http://".$_SERVER['SERVER_NAME'].$this->baseurl."/", $html);
        }
        
        echo $html;
    }
    
    public function getBaseUrl() {
        return $this->baseurl;
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