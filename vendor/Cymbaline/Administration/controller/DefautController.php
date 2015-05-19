<?php

namespace Cymbaline\Administration\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;


/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class DefautController extends Controller {

    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        
        $error = false;
        $test = "defaut controller administration";


        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }

    /**
     * @param Request $request
     * @param $args
     */
    public function viewAction(Request $request, $args) {

        $pos = strpos($args['path'], ":");
        if($pos === false) {
            $path = str_replace("{","",str_replace("}","",$args['path']));
            //echo $this->path($path);
            $this->redirect($this->path($path));
        } else {
            $path = str_replace("{","",str_replace("}","",$args['path']));
            $a = explode(":",$path);
            //echo $this->path($a[0],$a[1]);
            $this->redirect($this->path($a[0],$a[1]));
        }

    }
    
}
