<?php

namespace source\Cdm\PronoBox\control;

use core\component\View;
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
        
        if(isset($request->post->identifiant) && isset($request->post->pwd)) {
            $this->_session()->_unregister("membre");


            $utilisateur = new Utilisateur();
            $utilisateur->setUsername($request->post->identifiant);
            $utilisateur->setPassword($request->post->pwd);   
        }
        
        if($this->_session()->_is_register('membre')) {           
            $utilisateur = $this->_session()->get('membre');
        }
        
        $us = new UtilisateurService();
        
        if($us->exist($utilisateur)) {
            $uloader = new UtilisateurLoader();
            $utilisateur = $uloader->load($utilisateur);
            $this->_session()->_register("membre", $utilisateur);
        }
        
        $m = $this->getManager();
        $m->load($utilisateur);
        //$m->push();
        $users = $m->get();
        var_dump($users);

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
