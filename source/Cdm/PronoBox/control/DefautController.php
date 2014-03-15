<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use source\Cdm\UtilisateurBox\item\Utilisateur;

/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class DefautController extends Controller {

    public function __construct() {
        
    }
    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "defaut controller cdm";
        $this->_session()->_unregister("user");
        $this->_session()->_unregister("security.user");
        $this->_session()->_destroy();
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function loginAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "defaut controller cdm login";

        
        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
}
