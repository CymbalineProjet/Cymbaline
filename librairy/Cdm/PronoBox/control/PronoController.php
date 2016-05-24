<?php

namespace source\Cdm\PronoBox\control;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\dbmanager\SqlCommand;

use source\Cdm\PronoBox\item\Prono;
use source\Cdm\PronoBox\service\PronoService;
use source\Cdm\PronoBox\item\Matchs;
use source\Cdm\PronoBox\item\BlocProno;
use source\Cdm\PronoBox\item\Equipe;
use source\Cdm\PronoBox\item\Stade;
use source\Cdm\PronoBox\item\Poule;



/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class PronoController extends Controller {


    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        
        $blocs = array();
        $m = $this->getManager();
        $m->load(new Matchs());
        $matchs = Matchs::hydrateAll($m->get());
        $utilisateur = $this->_session()->get('user');
         
        foreach($matchs as $_match) {            
            $m->load(new Equipe());
            $equipedom = $m->getById($_match->getEquipedom());
            $equipeext = $m->getById($_match->getEquipeext());
            
            $m->load(new Stade());
            $stade = $m->getById($_match->getStade());
            
            $m->load(new Poule());
            $poule = $m->getById($equipedom->getPoule());
            
            
            $user = $this->_session()->get('user');
            $sqlcommand = new SqlCommand('Cdm/Prono/Prono');
            $sqlcommand->setSelect("*")
                       ->setWhere("matchs = ".$_match->getId())
                       ->addWhere("utilisateur = ".$user->getId())
                       ->build();
            $data = $sqlcommand->execute();
            
            $blocs[] = new BlocProno($_match,$equipedom,$equipeext,$stade,$poule,$data);
        }
        $prono = new Prono();
        $prono->setUtilisateur($utilisateur->getId());
        $m->load($prono);
        $p = $m->getAllBy('utilisateur');
        
        if(!$p) {
            $nombreprono = 0;
        } else {
            $nombreprono = sizeof($p);
        }
        
        return new View(array(
            'blocs' => $blocs,
            'nombreprono' => $nombreprono,
        ));
    }
    
    public function afficheAction(Request $request, array $args) {
        
        $test = "prono affiche controller cdm";
        
        $prono = new Prono();
        $m = $this->getManager();
        $m->load($prono);
        //$stade = $m->getById($args['id']);
        
        return new View(array(
            'test'  => $test,
            
        ));
    }
    
    public function majAction(Request $request, array $args) {
        var_dump($args);
        $sProno = new PronoService();
        $prono = new Prono();
        $m = $this->getManager();
        $m->load($prono);
        $p = $m->getById($args['id']);
        $point = $sProno->calcul_point($p);
        
        
        
        
        echo $point;die;
    }
    
    public function ajaxAction(Request $request) {
        
        $prono = new Prono();
        $prono->setMatchs($request->get('post')->match);
        $prono->setScoreDom($request->get('post')->dom);
        $prono->setScoreExt($request->get('post')->ext);
        $prono->setResultat(false);
        $prono->setVictoire(false);
        $utilisateur = $this->_session()->get('user');
        $prono->setUtilisateur($utilisateur->getId());
        
        $sProno = $this->get("Cdm/Prono/Prono");
        $m = $this->getManager();
        $m->load($prono);
        if($sProno->exist($prono)) {
            $m->update($sProno->getId($prono));
            echo "Prono mis à jour.";
        } else {
            $m->push();
            echo "Prono enregistré.";
        }

        return new View(array(
            'retour' => null,
        ));
    }

    
}
