<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use source\Cdm\PronoBox\item\Poule;



/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class PouleController extends Controller {


    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "poule controller cdm";
        
        $poule = new Poule();
        $m = $this->getManager();
        $m->load($poule);
        $poules = Poule::hydrateAll($m->get());
        
        

        return new View(array(
            'error' => $error,
            'test'  => $test,
            'poules' => $poules,
        ));
    }
    
    public function afficheAction(Request $request, array $args) {
        
        $test = "poule controller cdm";
        
        $poule = new Poule();
        $m = $this->getManager();
        $m->load($poule);
        $poule = $m->getById($args['id']);
        
        return new View(array(
            'test'  => $test,
            'poule' => $poule,
        ));
    }

    
}
