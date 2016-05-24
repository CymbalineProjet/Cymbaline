<?php

namespace source\Cdm\PronoBox\item;
/**
 * Description of BlocProno
 *
 * @author Thibault
 */
class BlocProno {
    
    private $match;
    private $poule;
    private $stade;
    private $dom;
    private $ext;
    private $prono;
    
    public $equipedom;
    public $equipeext;
    public $slugdom;
    public $slugext;
    public $nomstade;
    public $capacitestade;
    public $heurematch;
    public $nomgroupe;
    public $scoredom;
    public $scoreext;
    public $pronovalide;
    public $idmatch;
    
    public function __construct($match,$equipedom,$equipeext,$stade,$poule,$prono) {
        $this->match = $match;
        $this->poule = $poule;
        $this->stade = $stade;
        $this->dom = $equipedom;
        $this->ext = $equipeext;
        $this->prono = $prono;
        $this->_parse();
        $this->delete();
    }
    
    private function _parse() {
        
        $this->pronovalide = empty($this->prono);
        $this->idmatch = $this->match->getId();
        $this->equipedom = $this->dom->getNom();
        $this->equipeext = $this->ext->getNom();
        $this->slugdom = $this->dom->getSlug();
        $this->slugext = $this->ext->getSlug();
        $this->nomstade = $this->stade->getNom();
        $this->heurematch = $this->match->getDate();
        $this->nomgroupe = $this->poule->getNom();
        $this->capacitestade = $this->stade->getCapacite();
        
        if($this->pronovalide) {
            $this->scoredom = $this->match->getScoredom();
            $this->scoreext = $this->match->getScoreext();  
            $this->pronovalide = false;
        } else {
            $this->scoredom = $this->prono->getScoredom();
            $this->scoreext = $this->prono->getScoreext();
            $this->pronovalide = true;
        }
        
    }
    
    private function delete() {
        unset($this->dom);
        unset($this->ext);
        unset($this->match);
        unset($this->poule);
        unset($this->prono);
        unset($this->stade);
    }
}
