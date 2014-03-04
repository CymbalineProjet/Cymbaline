<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use source\Cdm\PronoBox\item\Prono;



/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class PronoController extends Controller {


    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "prono controller cdm";
        
        $prono = new Prono();
        $m = $this->getManager();
        $m->load($prono);
        //$stades = Stade::hydrateAll($m->get());
        
        

        return new View(array(
            'error' => $error,
            'test'  => $test,
            
        ));
    }
    
    public function afficheAction(Request $request, array $args) {
        
        $test = "prono affiche controller cdm";
        
        $prono = new Prono();
        $m = $this->getManager();
        $m->load($prono);
        //$stade = $m->getById($args['id']);
        
        return new View(array(
            'test'  => $test,
            
        ));
    }

    
}
