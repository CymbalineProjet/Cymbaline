<?php

namespace source\Cdm\UtilisateurBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use source\Cdm\UtilisateurBox\item\Utilisateur;

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
        
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function obtenirAction(Request $request, array $get) {
        
        $utilisateur = new Utilisateur();
        $m = $this->getManager();
        $m->load($utilisateur);
        $utilisateur = $m->getById($get['id']);

        
        return new View(array(
            'utilisateur' => $utilisateur,
        ));
    }
}
