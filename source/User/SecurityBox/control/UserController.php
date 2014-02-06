<?php

namespace source\User\SecurityBox\controller;

use core\component\View;
use core\component\Request;
use core\component\Controller;

use source\User\SecurityBox\form\LoginForm;

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
        
        
        return new View('User/SecurityBox/index', array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function loginAction(Request $request) {
        
        $form = new LoginForm();
        
        return new View('User/SecurityBox/login', array(
            'error' => false,
        ), array(
            "login" => $form,
        ));
        
    }
}
