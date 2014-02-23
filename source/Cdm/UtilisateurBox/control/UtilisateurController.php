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
        
        $utilisateur = $this->_session()->get('membre');      
        
        $form = new EditForm();
        $form->setMethod("post");
        $form->setAction("/AlcaFram/edit");     
        
        $m = $this->getManager();
        $m->load($utilisateur);
        $utilisateur = $m->getById($utilisateur->getId());


        if(isset($request->get('post')->form_edit)) {
            
            $utilisateur->setNom($request->get('post')->form_edit->nom);
            $utilisateur->setPrenom($request->get('post')->form_edit->prenom);
            $utilisateur->setUsername($request->get('post')->form_edit->username);
            $utilisateur->setDate_last_activity(new \DateTime());
            $m->load($utilisateur);
            $utilisateur = $m->update($utilisateur->getId());
            $this->_session()->_unregister("membre");
            $this->_session()->_register("membre", $utilisateur);
           
        }
        
        return new View(array(
            'utilisateur' => $utilisateur,
        ),array(
            "form" => $form,
        ));
    }
    
    public function edituserAction(Request $request, array $get) {
        
        $form = new EditForm();
        $form->setMethod("post");
        $form->setAction("/AlcaFram/utilisateur/edit/".$get['id']);
        
        $utilisateur = new Utilisateur();
        $m = $this->getManager();
        $m->load($utilisateur);
        $utilisateur = $m->getById($get['id']);

        if(isset($request->get('post')->form_edit)) {
            var_dump($request->get('post')->form_edit);
            $utilisateur->setNom($request->get('post')->form_edit->nom);
            $utilisateur->setPrenom($request->get('post')->form_edit->prenom);
            $utilisateur->setUsername($request->get('post')->form_edit->username);
            $utilisateur->setDate_last_activity(new \DateTime());
            $m->load($utilisateur);
            $utilisateur = $m->update($get['id']);
        }
        
        return new View(array(
            'utilisateur' => $utilisateur,
        ),array(
            "form" => $form,
        ));
    }
}
