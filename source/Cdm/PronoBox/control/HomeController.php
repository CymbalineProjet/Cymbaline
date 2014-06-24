<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;

use core\component\exception\DeniedException;

use source\Cdm\UtilisateurBox\item\Utilisateur;
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
		$utilisateur = new Utilisateur();
		$utilisateur->setUsername = "anonymous";
		$utilisateur->setPassword = "test";
		$utilisateur->setAnonymous(true);
        
        if(isset($request->get('post')->identifiant) && isset($request->get('post')->pwd)) {
            $this->_session()->_unregister("user");


            $utilisateur = new Utilisateur();
            $utilisateur->setUsername($request->get('post')->identifiant);
            $utilisateur->setPassword($request->get('post')->pwd);   
			$this->_session()->_register("user", $utilisateur);
        }
        
        if($this->_session()->_is_register('user')) {           
            $utilisateur = $this->_session()->get('user');
        }
        
        $us = $this->get("Cdm/Utilisateur/Utilisateur");
        
        if($us->exist($utilisateur)) {
            
            $uloader = new UtilisateurLoader();
            $utilisateur = $uloader->load($utilisateur);
            $utilisateur->setAnonymous(false);
            $utilisateur->setClassement = $us->get_classement($utilisateur);
			
            $this->_session()->_register("user", $utilisateur);
			
			
        } else {
            $this->_session()->_register("user", $utilisateur);
			$ex = new DeniedException('Access denied : anonymous user.');
			$ex->denied();
            
            //return la view de la confirmation de l'insert + envoi mail
            return new View(array(
                'error' => $error,
                'test'  => new \source\User\SecurityBox\item\Identity(),
                'utilisateur' => $utilisateur,
            ));
        }
        
        //add en attendant le debut de la coupe du monde
        //$this->redirect($this->path('pronos'));
        
        return new View(array(
            'error' => $error,
            'test'  => new \source\User\SecurityBox\item\Identity(),
            'utilisateur' => $utilisateur,
        ));
    }
    
    public function adminAction() {
        
        var_dump($this->_session());
        
        return new View(array(
            'error' => 'test',
            'test'  => '$test',
        ));
    }
    
}
