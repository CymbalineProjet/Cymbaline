<?php

namespace source\Cdm\PronoBox\item;
/**
 * Description of BlocProno
 *
 * @author Thibault
 */
class BlocResultat {
    
    private $match;
    private $prono;
    
    public $equipedom;
    public $equipeext;
    public $slugdom;
    public $slugext;
    public $heurematch;
    public $scoredom;
    public $scoreext;
    public $pronovalide;
    public $idmatch;
    
    public function __construct($match,$equipedom,$equipeext,$prono) {
        $this->match = $match;
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
        $this->heurematch = $this->match->getDate();
        $this->joue = $this->match->getJoue();
        
        if($this->pronovalide) {
            $this->scoredom = $this->match->getScoredom();
            $this->scoreext = $this->match->getScoreext(); 
            $this->pronodom = 0;
            $this->pronoext = 0;
            $this->pronovalide = false;
        } else {
            $this->scoredom = $this->match->getScoredom();
            $this->scoreext = $this->match->getScoreext(); 
            $this->pronodom = $this->prono->getScoredom();
            $this->pronoext = $this->prono->getScoreext();
            $this->pronovalide = true;
        }
        
    }
    
    private function delete() {
        unset($this->dom);
        unset($this->ext);
        unset($this->match);
        unset($this->prono);
    }
}
