<?php

namespace core\component;


use core\component\dbmanager\Dbmanager;
use core\component\exception\CoreException;


/**
 * Class Controller
 * @package core\component
 * @author Thibault Jeannet
 */
class Controller {

    /**
     * @var Session
     */
    private $session;
    /**
     * @var Parametrage
     */
    private $parametre;
    /**
     * @var Dbmanager
     */
    public $dbmanager;
    /**
     * @var Request
     */
    public $request;

    
    public function init($requestSession, Parametrage $param, Request $request) {
        
        $this->session = $requestSession;
        $this->parametre = $param;
        $this->dbmanager = new Dbmanager();
        $this->request = $request;
        
    }

    /**
     * @return Dbmanager
     */
    public function getManager() {
        return $this->dbmanager;
    }

    /**
     * @param null $service
     * @return mixed $service
     */
    public function get($service = null) {
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

    /**
     * @return Parametrage
     */
    public function getParam() {
        return $this->parametre;
    }

    /**
     * @return Session
     */
    public function _session() {
        return new Session();
    }

    /**
     * @param $name
     * @param array $args
     * @return string
     */
    public function path($name,array $args = null) {
        $route = new Route('/');
        $path = $route->createPath($name,$args);
        
        return $path;
    }

    /**
     * @param String $url
     */
    public function redirect($url) {
        header("Location: $url");
        exit;
    }

    /**
     * @param $item
     * @return mixed
     */
    public function load($item) {
        $path = explode("/", $item);
        $path_end = end($path);
        $p = $path;
        array_pop($p);
        $p = implode("/",$p);

        $control = "source\\".$path[0]."\\".$path[1]."\\controller\\".$path[2]."Controller";
        $vendor = "vendor/".$path[0]."/".$path[1]."/controller/".$path[2]."Controller.php";
        $vendor2 = "vendor/".$p."/controller/".$path_end."Controller.php";
        $component = "/".$p."/".$path_end."Controller.php";


       
        if(file_exists(__DIR__."/../../".$control.".php")) {
            $c = new $control();
        } else if (file_exists(__DIR__."/../../".$vendor)) {
            $control = $path[0]."\\".$path[1]."\\controller\\".$path[2]."Controller";
            $c = new $control();
        } else if (file_exists(__DIR__."/../../".$vendor2)) {
            $control = $p."\\controller\\".$path_end."Controller";
            $c = new $control();
        } else if(file_exists(__DIR__."/../../".$component)) {
            $control = $p."/".$path_end."Controller";
            $c = new core\component\dbmanager\DBController();
            $this->dump($c, true);
            $c = new $control();
        }

        return $c;
    }

    /**
     * @param mixed $var
     * @param bool $die
     */
    public function dump(mixed $var, $die = false) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        
        if($die)
            die;
        
    }
}
