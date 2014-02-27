<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use source\Cdm\PronoBox\item\Equipe;



/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class EquipeController extends Controller {


    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "equipe controller cdm";
        
        $equipe = new Equipe();
        $m = $this->getManager();
        $m->load($equipe);
        $get_equipes = $m->get();
        $equipes = Equipe::hydrateAll($get_equipes);
        
        

        return new View(array(
            'error' => $error,
            'test'  => $test,
            'equipes' => $equipes,
        ));
    }

    
}
