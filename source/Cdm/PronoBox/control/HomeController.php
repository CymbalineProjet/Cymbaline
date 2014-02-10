<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\dbmanager\Dbmanager;

use source\Cdm\UtilisateurBox\item\Utilisateur;
use source\Cdm\UtilisateurBox\service\UtilisateurService;
use source\Cdm\UtilisateurBox\loader\UtilisateurLoader;

/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class HomeController extends Controller {


    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "home controller cdm";
        var_dump($request->get('post'));
        if(isset($request->get('post')->identifiant) && isset($request->get('post')->pwd)) {
            $this->_session()->_unregister("membre");


            $utilisateur = new Utilisateur();
            $utilisateur->setUsername($request->get('post')->identifiant);
            $utilisateur->setPassword($request->get('post')->pwd);   
        }
        
        if($this->_session()->_is_register('membre')) {           
            $utilisateur = $this->_session()->get('membre');
        }
        
        $us = new UtilisateurService();
        
        if($us->exist($utilisateur)) {
            
            $uloader = new UtilisateurLoader();
            $utilisateur = $uloader->load($utilisateur);
            
            $this->_session()->_register("membre", $utilisateur);
        } else {
            $m = $this->getManager();
            $m->load($utilisateur);
            $m->push();
            
            //return la view de la confirmation de l'insert + envoi mail
            //retravailler la view -> deplace le lien en 2eme position et on le rend false par defaut (
            //on utilisera par defaut celui renseigner dans les routes
            return new View('Cdm/PronoBox/confirmation', array(
                'error' => $error,
                'test'  => new \source\User\SecurityBox\item\Identity(),
                'utilisateur' => $utilisateur,
            ));
        }

        return new View('Cdm/PronoBox/home', array(
            'error' => $error,
            'test'  => new \source\User\SecurityBox\item\Identity(),
            'utilisateur' => $utilisateur,
        ));
    }
    
    public function adminAction() {
        
        var_dump($this->_session());
        
        return new View('Cdm/PronoBox/home', array(
            'error' => 'test',
            'test'  => '$test',
        ));
    }
    
}
