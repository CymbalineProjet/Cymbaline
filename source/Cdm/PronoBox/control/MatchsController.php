<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use source\Cdm\PronoBox\item\Matchs;



/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class MatchsController extends Controller {


    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        //on donne au retour un attribut error à false
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

    
}
