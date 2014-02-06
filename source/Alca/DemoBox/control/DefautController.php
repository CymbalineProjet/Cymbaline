<?php

namespace Control;

use Service\UtilisateurService;
use Entity\Utilisateur;
use Entity\Tirage;
/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class Controler {
    
    private $post;
    private $get;
    private $session;
    private $parametre;
    public  $retour;
    
    public function __construct($requestGet, $requestPost, $requestSession, \Config\Parametrage $param) {
        $this->post = $requestPost;
        $this->get = $requestGet;
        $this->session = $requestSession;
        $this->parametre = $param;
        $this->retour = new \stdClass();
    }
    
    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction() {
        //on donne au retour un attribut error à false
        $this->retour->error = false;
        
        if($this->post['submit'] == 1) {
            $connexion = $this->parametre->getConnexion();
            $service = new UtilisateurService($connexion);

            $tirage = new Tirage();
            $code = $tirage->generateRandomString();
            $codeExiste = $service->codeExistant($code);

            while($codeExiste) {
                $code = $tirage->generateRandomString();
                $codeExiste = $service->codeExistant($code);
            }

            $utilisateur = new Utilisateur();

            $utilisateur->setNom($this->post['nom']);
            $utilisateur->setPrenom($this->post['prenom']);
            $utilisateur->setMail($this->post['mail']);
            $utilisateur->setCode($code);
            $utilisateur->setDate(new \DateTime());
            

            if($service->dejaInscrit($utilisateur)) {
                $this->retour->error = true;
                $this->retour->messageError = "Vous avez d&eacute;j&agrave; particip&eacute;.";
            } else {
                $service->insert($utilisateur);
                $this->retour->message = "Vous venez de vous inscrire au tirage au sort.";
                $this->retour->insert = true;
            }
        }
        
        
        return $this->retour;
    }
}
