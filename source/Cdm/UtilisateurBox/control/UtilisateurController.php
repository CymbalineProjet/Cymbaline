<?php

namespace source\Cdm\UtilisateurBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use source\Cdm\UtilisateurBox\item\Utilisateur;
use source\Cdm\UtilisateurBox\form\EditForm;

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
    
    public function editAction(Request $request) {
        
        $m = $this->getManager();
        $utilisateur = $this->_session()->get('user');           

        if(isset($request->get('post')->form_edit)) {

            $utilisateur->setNom($request->get('post')->form_edit->nom);
            $utilisateur->setPrenom($request->get('post')->form_edit->prenom);
            $utilisateur->setUsername($request->get('post')->form_edit->username);
            $utilisateur->setDate_last_activity(new \DateTime());
            $m->load($utilisateur);
            $utilisateur = $m->update($utilisateur->getId());
            $this->_session()->_unregister("user");
            $this->_session()->_register("user", $utilisateur);
           
        }
        
        $form = new EditForm($utilisateur);
        $form->setMethod("post");
        $form->setAction($this->path("myutilisateur_edit"));
        
        return new View(array(
            'utilisateur' => $utilisateur,
        ),array(
            "form" => $form,
        ));
    }
    
    public function classementAction(Request $request) {
        
        $sUtilisateur = $this->get('Cdm/Utilisateur/Utilisateur');
        $data = $sUtilisateur->get_classement();        
        
        return new View(array(
            'test' => "classement des membres",
            'data' => $data,
        ));
    }
}
