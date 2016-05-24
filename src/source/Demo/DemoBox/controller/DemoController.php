<?php

namespace source\Demo\DemoBox\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

/**
 * Description of Demo
 * 
 *
 * @author Thibault Jeannet
 */
class DemoController extends Controller {

    /**
     * indexAction() traitera les données pour la page index
     * @return View $view
     */
    public function indexAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "Demo controller";
        
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }
}
