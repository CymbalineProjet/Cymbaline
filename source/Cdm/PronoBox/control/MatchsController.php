<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\dbmanager\SqlCommand;

use source\Cdm\PronoBox\item\Matchs;
use source\Cdm\PronoBox\form\MatchForm;
use source\Cdm\PronoBox\form\MajMatchForm;

use source\Cdm\PronoBox\item\Stade;
use source\Cdm\PronoBox\item\Equipe;

use source\Cdm\PronoBox\item\Prono;

use source\Cdm\UtilisateurBox\item\Utilisateur;

use source\Cdm\PronoBox\item\BlocResultat;



/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera une vue utile à  l'affichage des données
 *
 * @author Thibault Jeannet
 */
class MatchsController extends Controller {


    /**
     * indexAction() traitera les données pour la page index
     * @return View $view
     */
    public function indexAction(Request $request) {
        
        $error = false;
        $test = "match controller cdm";
        
        $match = new Matchs();
        $m = $this->getManager();
        $m->load($match);
        $matchs = Matchs::hydrateAll($m->get());
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
            'matchs' => $matchs,
        ));
    }
    
    public function afficheAction(Request $request, array $args) {
        
        $test = "match affiche controller cdm";
        
        $match = new Matchs();
        $m = $this->getManager();
        $m->load($match);
        $match = $m->getById($args['id']);
        
        return new View(array(
            'test'  => $test,
            'match' => $match,
        ));
    }
    
    public function resultatAction(Request $request) {
        
        $utilisateur = $this->_session()->get('user');
        $m = $this->getManager();
        $prono = new Prono();
        $blocs = array();
        
        $m->load(new Matchs());
        $matchs = Matchs::hydrateAll($m->get());
        
        foreach($matchs as $match) {
            
            $sqlcommand = new SqlCommand('Cdm/Prono/Prono');
            $sqlcommand->setSelect("*")
                       ->setWhere("matchs = ".$match->getId())
                       ->addWhere("utilisateur = ".$utilisateur->getId())
                       ->build();
            $prono = $sqlcommand->execute();
            
            $m->load(new Equipe());
            $dom = $m->getById($match->getEquipedom());
            
            $m->load(new Equipe());
            $ext = $m->getById($match->getEquipeext());

            $bloc = new BlocResultat($match, $dom, $ext, $prono);

            $m->load(new \source\Cdm\PronoBox\item\Poule());
            $bloc->poule = $m->getById($dom->getPoule());
            $blocs[] = $bloc;
        }
        
        $sqlcommand = new SqlCommand('Cdm/Prono/Matchs');
        $sqlcommand->setSelect("*")
                   ->setWhere("joue = 0")
                   ->build();
        $restant = sizeof($sqlcommand->execute());
        
        return new View(array(
            'resultats'  => $blocs,
            'restant' => $restant,
        ));
    }
    
    public function calendrierAction(Request $request) {
        
        return new View(array(
            'test'  => 'resultat',
        ));
    }
    
    public function newAction(Request $request) {
        
        $retour = null;
        $match = new Matchs();
        $m = $this->getManager();        
        
        $form = new MatchForm($match);
        $form->setMethod("post");
        $form->setAction($this->path("admin_match_new"));
        
        if(isset($request->get('post')->form_new)) {
            
            $date = new \DateTime($request->get('post')->form_new->date);
            
            $e = new Equipe();
            $e->setNom($request->get('post')->form_new->equipedom);
            $m->load($e);
            $d = $m->getBy('nom');
            
            $e->setNom($request->get('post')->form_new->equipeext);
            $m->load($e);
            $x = $m->getBy('nom');
                    
            $s = new Stade();
            $s->setNom($request->get('post')->form_new->stade);
            $m->load($s);
            $s = $m->getBy('nom');

            $match->setDate($date);
            $match->setEquipedom($d->getId());
            $match->setEquipeext($x->getId());
            $match->setScoredom($request->get('post')->form_new->scoredom);
            $match->setScoreext($request->get('post')->form_new->scoreext);
            $match->setStade($s->getId());
            $match->setJoue($request->get('post')->form_new->joue);
            $m->load($match);
            $m->push();
            
            $retour = "Match ajouté au calendrier.";
        }
        
        $m->load(new Equipe());
        $equipes = Equipe::hydrateAll($m->get());
        
        $m->load(new Stade());
        $stades = Stade::hydrateAll($m->get());
        
        return new View(array(
            'equipes'  => $equipes,
            'stades'  => $stades,
            'retour' => $retour,
        ),array(
            'form' => $form,
        ));
    }

    public function listeAction() {
        
        $m = $this->getManager();
        $m->load(new Matchs());
        $matchs = Matchs::hydrateAll($m->get());
        
        foreach($matchs as $id => $match) {
            $m->load(new Equipe());
            $dom = $m->getById($match->getEquipedom());
            $match->setEquipedom($dom->getNom());
            
            $m->load(new Equipe());
            $ext = $m->getById($match->getEquipeext());
            $match->setEquipeext($ext->getNom());
            
            $m->load(new Stade());
            $stade = $m->getById($match->getStade());
            $match->setStade($stade->getNom());
        }
        
        return new View(array(
            'matchs'  => $matchs,
        ));
    }
    
    public function majAction(Request $request, array $args) {
        
        $m = $this->getManager();
        $m->load(new Matchs());
        $match = $m->getById($args['id']);
        
        $form = new MajMatchForm($match);
        $form->setMethod("post");
        $form->setAction($this->path("admin_match_maj",$args['id']));
        
        if(isset($request->get('post')->form_maj)) {
            
            
            $match->setScoredom($request->get('post')->form_maj->scoredom);
            $match->setScoreext($request->get('post')->form_maj->scoreext);
            $match->setJoue(true);
            $m->load($match);
            $ddd = $m->update($args['id']);
            
            $p = new Prono();
            $p->setMatchs($args['id']);
            $m->load($p);
            $pronos = Prono::hydrateAll($m->getAllBy('matchs'));
            
            $sProno = $this->get("Cdm/Prono/Prono");

            foreach($pronos as $prono) {
                
                $point = $sProno->calcul_point($prono);
                $user = new Utilisateur();
                $m->load($user);
                $utilisateur = $m->getById($prono->getUtilisateur());

                $u_pt = $utilisateur->getPoint() + $point;
                
                echo $utilisateur->getPoint()."+$point = $u_pt pour user #".$utilisateur->getUsername()." pour le match ".$prono->getMatchs()."<br />";
                $utilisateur->setPoint($u_pt);
                
                $m->load($utilisateur);
                
                $d = $m->update($utilisateur->getId());
                
                
            }
            
             $this->redirect($this->path('admin_match'));
        }
        
        $e = new Equipe();
        $e->setId($match->getEquipedom());
        $m->load($e);
        $dom = $m->getById($match->getEquipedom());

        $e->setId($match->getEquipeext());
        $m->load($e);
        $ext = $m->getById($match->getEquipeext());
        
        $match->dom = $dom->getNom();
        $match->ext = $ext->getNom();
         
        return new View(array(
            'match'  => $match,
        ),array(
            'form' => $form,
        ));
    }
    
}
