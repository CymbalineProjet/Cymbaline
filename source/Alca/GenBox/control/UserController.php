<?php

namespace source\Alca\GenBox\controller;

use core\component\View;
use core\component\Request;
use core\component\Controller;

/**
 * Description of User
 * 
 *
 * @author Thibault Jaxx Floyd Jeannet
 */
class UserController extends Controller {

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
        $test = "User controller";
        
        
        return new View('Alca/GenBox/index', array(
            'error' => $error,
            'test'  => $test,
        ));
    }
}
