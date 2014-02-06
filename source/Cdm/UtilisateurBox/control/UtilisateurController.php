<?php

namespace source\Cdm\UtilisateurBox\control;

use core\component\View;
use core\component\Request;
use core\component\Controller;

/**
 * Description of Utilisateur
 * 
 *
 * @author Thibault Jaxx Floyd Jeannet
 */
class UtilisateurController extends Controller {

    public function __construct() {
         //do something
    }

    /**
     * indexAction() traitera les données pour la page index
     * @return View $view
     */
    public function indexAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "Utilisateur controller";
        
        
        return new View('Cdm/UtilisateurBox/index', array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function obtenirAction(Request $request, array $get) {
        
        
        return new View('Cdm/UtilisateurBox/utilisateur', array(
            'error' => false,
            'test'  => $get['id'],
        ));
    }
}
