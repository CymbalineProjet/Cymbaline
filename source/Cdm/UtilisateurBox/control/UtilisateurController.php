<?php

namespace source\Cdm\UtilisateurBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use source\Cdm\UtilisateurBox\item\Utilisateur;
use source\Cdm\UtilisateurBox\form\EditForm;
use core\component\tools\Upload;

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
            'utilisateurs' => $data,
        ));
    }
    
    public function modifierAction(Request $request) {
        
        return new View(array(
            'retour' => null,
        ));
    }
    
    public function editfirstAction(Request $request) {
        
        $utilisateur = $this->_session()->get('user');
        $m = $this->getManager();
        $m->load($utilisateur);
        
        if(isset($request->get('post')->mail)) {
            $utilisateur->setMail($request->get('post')->mail);
            $utilisateur->setPassword($request->get('post')->password);
            $utilisateur->setDate_last_activity(new \DateTime());
            $m->load($utilisateur);
            $m->update($utilisateur->getId());
        }        
        
        $this->redirect($this->path('modifier'));
    }
    
    public function editsecondAction(Request $request) {
        
        $utilisateur = $this->_session()->get('user');
        $m = $this->getManager();
        $m->load($utilisateur);
        
        if(isset($request->get('post')->publication)) {
            $utilisateur->setMessage($request->get('post')->publication);
            $utilisateur->setDate_last_activity(new \DateTime());
            $m->load($utilisateur);
            $m->update($utilisateur->getId());
        }
        
        $this->redirect($this->path('modifier'));
    }
    
    public function editthirdAction(Request $request) {
        $utilisateur = $this->_session()->get('user');
        $m = $this->getManager();
        $m->load($utilisateur);
        
        if(isset($request->get('post')->username)) {
            if($_FILES['photo']['name'] != "") {
                $ObjFichier = new Upload('photo');
                $ObjFichier->setTypesValides = array('image/jpeg','image/png','image/gif');
                $ObjFichier->setNom($request->get('post')->username);
                $ObjFichier->UploadFichier(__DIR__.'/../../../../public/img/upload/avatar/') or die($ObjFichier->UploadErreur());
            }
            $utilisateur->setUsername($request->get('post')->username);
            $utilisateur->setNom($request->get('post')->nom);
            $utilisateur->setPrenom($request->get('post')->prenom);
            $utilisateur->setDate_last_activity(new \DateTime());
            $m->load($utilisateur);
            $m->update($utilisateur->getId());
        }
        $this->redirect($this->path('modifier'));
    }
}
