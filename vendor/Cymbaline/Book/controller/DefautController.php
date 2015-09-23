<?php

namespace Cymbaline\Book\controller;

use core\component\tools\View;
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
    public function indexAction() {
        
        $error = false;
        $test = "defaut controller book";


        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }

    public function controllerAction() {
        return new View(null);
    }

    
}
