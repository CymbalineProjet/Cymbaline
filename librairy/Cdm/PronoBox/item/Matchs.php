<?php

namespace source\Cdm\PronoBox\item;

/**
 * Matchs
 */
class Matchs
{
    /**
     * #type=int#
     * #name=id#
     */
    private $id;

    /**
     * #type=datetime#
     * #name=date#
     */
    private $date;

    /**
     * #type=int#
     * #name=scoredom#
     */
    private $scoredom;

    /**
     * #type=int#
     * #name=scoreext#
     */
    private $scoreext;

    /**
     * #type=int#
     * #name=equipedom#
     */
    private $equipedom;

    /**
     * #type=int#
     * #name=equipeext#
     */
    private $equipeext;

    /**
     * #type=bool#
     * #name=joue#
     */
    private $joue;

    /**
     * #type=int#
     * #name=stade#
     */
    private $stade;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set id
     *
     * @return integer 
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Matchs
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set scoreDom
     *
     * @param integer $scoreDom
     * @return Matchs
     */
    public function setScoredom($scoredom)
    {
        $this->scoredom = $scoredom;

        return $this;
    }

    /**
     * Get scoreDom
     *
     * @return integer 
     */
    public function getScoredom()
    {
        return $this->scoredom;
    }

    /**
     * Set scoreExt
     *
     * @param integer $scoreext
     * @return Matchs
     */
    public function setScoreext($scoreext)
    {
        $this->scoreext = $scoreext;

        return $this;
    }

    /**
     * Get scoreExt
     *
     * @return integer 
     */
    public function getScoreext()
    {
        return $this->scoreext;
    }

    /**
     * Set equipeDom
     *
     * @param integer $equipeDom
     * @return Matchs
     */
    public function setEquipedom($equipedom)
    {
        $this->equipedom = $equipedom;

        return $this;
    }

    /**
     * Get equipeDom
     *
     * @return integer 
     */
    public function getEquipedom()
    {
        return $this->equipedom;
    }

    /**
     * Set equipeExt
     *
     * @param integer $equipeExt
     * @return Matchs
     */
    public function setEquipeext($equipeext)
    {
        $this->equipeext = $equipeext;

        return $this;
    }

    /**
     * Get equipeExt
     *
     * @return integer 
     */
    public function getEquipeext()
    {
        return $this->equipeext;
    }

    /**
     * Set joue
     *
     * @param boolean $joue
     * @return Matchs
     */
    public function setJoue($joue)
    {
        $this->joue = $joue;

        return $this;
    }

    /**
     * Get joue
     *
     * @return boolean 
     */
    public function getJoue()
    {
        return $this->joue;
    }

    /**
     * Set stade
     *
     * @param integer $stade
     * @return Matchs
     */
    public function setStade($stade)
    {
        $this->stade = $stade;

        return $this;
    }

    /**
     * Get stade
     *
     * @return integer 
     */
    public function getStade()
    {
        return $this->stade;
    }
    
    public function getVainqueur() {
        if($this->scoredom > $this->scoreext) {
            return 1;
        } 
        
        if($this->scoredom < $this->scoreext) {
            return 2;
        }
        
        if($this->scoredom == $this->scoreext) {
            return 0;
        }
    }
    
    public function hydrate(\stdClass $match) {
        
        $_match = new Matchs();
        //var_dump(get_object_vars($equipe));
        foreach($match as $attr => $value) {
            
            $attribut = "set".ucfirst($attr);
            $_match->$attribut($value);
          
        }
        
        return $_match;
    }
    
    static function hydrateAll(array $matchs) {
        
        $match = new \stdClass();
        $e = new Matchs();
        
        foreach($matchs as $attr => $value) {
            
            foreach($value as $id => $valeur) {
                
                if(!is_int($id)) {
                    
                    $match->{$id} = $valeur;
                    //var_dump($equipe);
                }
                
            }
            //var_dump($equipe);
            $matchs[$attr] = $e->hydrate($match);
            unset($match);
            $match = new \stdClass();
        }
        
        return $matchs;
        
    }
}
