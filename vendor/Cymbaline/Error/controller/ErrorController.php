<?php

namespace Cymbaline\Error\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

/**
 * Description of ErrorController
 * 
 *
 * @author Thibault Jaxx Floyd Jeannet
 */
class ErrorController extends Controller {

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
    
}
