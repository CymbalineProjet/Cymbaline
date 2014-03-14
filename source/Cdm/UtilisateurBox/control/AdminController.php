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
class AdminController extends Controller {

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
        $test = "Utilisateur admin controller";
        
        $utilisateur = new Utilisateur();
        $m = $this->getManager();
        $m->load($utilisateur);
        $utilisateurs = Utilisateur::hydrateAll($m->get());
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
            'utilisateurs' => $utilisateurs,
        ));
    }
    
    public function afficheAction(Request $request, array $get) {
        
        $utilisateur = new Utilisateur();
        $m = $this->getManager();
        $m->load($utilisateur);
        $utilisateur = $m->getById($get['id']);

        
        return new View(array(
            'utilisateur' => $utilisateur,
            'test' => 'Admin user',
        ));
    }
    
    public function editAction(Request $request, array $get) {
        
        $utilisateur = new Utilisateur();
        $m = $this->getManager();
        $m->load($utilisateur);
        $utilisateur = $m->getById($get['id']);

        if(isset($request->get('post')->form_edit)) {
            
            $utilisateur->setNom($request->get('post')->form_edit->nom);
            $utilisateur->setPrenom($request->get('post')->form_edit->prenom);
            $utilisateur->setUsername($request->get('post')->form_edit->username);
            $utilisateur->setMail($request->get('post')->form_edit->mail);
            $utilisateur->setPassword($request->get('post')->form_edit->password);
            $utilisateur->setDate_last_activity(new \DateTime());
            $m->load($utilisateur);
            $utilisateur = $m->update($get['id']);
        }
        
        $form = new EditForm($utilisateur);
        $form->setMethod("post");
        $form->setAction($this->path("admin_user_edit",$get['id']));
        
        return new View(array(
            'utilisateur' => $utilisateur,
        ),array(
            "form" => $form,
        ));
    }
    
    /*public function edituserAction(Request $request, array $get) {
        
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
    }*/
    
    
}
