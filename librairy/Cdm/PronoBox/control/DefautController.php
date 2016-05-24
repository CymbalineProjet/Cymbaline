<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\tools\Upload;

use source\Cdm\UtilisateurBox\item\Utilisateur;

/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class DefautController extends Controller {

    public function __construct() {
        
    }
    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "defaut controller cdm";
        $this->_session()->_unregister("user");
        $this->_session()->_unregister("security.user");
        $this->_session()->_destroy();
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function loginAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "defaut controller cdm login";
        $retour = null;
		
        $this->_session()->_unregister("security.user");
        
        
        
        if(isset($request->get('post')->mail)) {
            
            $ObjFichier = new Upload('photo');
            $ObjFichier->setTypesValides = array('image/jpeg');
            $ObjFichier->setNom($request->get('post')->username);
            $ObjFichier->UploadFichier(__DIR__.'/../../../../public/img/upload/avatar/') or die($ObjFichier->UploadErreur());
            $retour = "Vous etes maintenant enregistre.";
            
            $utilisateur = new Utilisateur();
            $utilisateur->setUsername($request->get('post')->username);
            $utilisateur->setNom($request->get('post')->nom);
            $utilisateur->setPrenom($request->get('post')->prenom);
            $utilisateur->setComplet(true);
            $utilisateur->setPassword($request->get('post')->password);
            $utilisateur->setMessage($request->get('post')->message);
            $utilisateur->setRole('user');
            $utilisateur->setPoint(0);
            $utilisateur->setMail($request->get('post')->mail);
            $utilisateur->setDate_last_activity(new \DateTime());
            $utilisateur->setDate_register(new \DateTime());
            $utilisateur->setAnonymous(false);
            
            $us = $this->get("Cdm/Utilisateur/Utilisateur");
            if(!$us->exist($utilisateur) || !$us->exist($utilisateur, 'mail')) {
            
                $m = $this->getManager();         
                $m->load($utilisateur);
                $m->push();
            } else {
                $retour = "Cette utilisateur existe deja.";
            }
            
        }
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
            'retour' => $retour,
        ));
    }
    
    public function regleAction() {
        
        return new View(array(
            'test'  => 'regles',
        ));
    }
    
}
