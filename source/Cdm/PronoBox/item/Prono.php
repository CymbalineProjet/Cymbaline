<?php

namespace source\Cdm\PronoBox\item;

/**
 * Prono
 *
 */
class Prono {
    
    /**
     * #type=int#
     * #name=id#
     */
    private $id;

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
     * #type=bool#
     * #name=victoire#
     */
    private $victoire;

    /**
     * #type=bool#
     * #name=resultat#
     */
    private $resultat;

    /**
     * #type=int#
     * #name=utilisateur#
     */
    private $utilisateur;

    /**
     * #type=id#
     * #name=matchs#
     */
    private $matchs;


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
     * Set scoreDom
     *
     * @param integer $scoreDom
     * @return Prono
     */
    public function setScoreDom($scoreDom)
    {
        $this->scoreDom = $scoreDom;

        return $this;
    }

    /**
     * Get scoreDom
     *
     * @return integer 
     */
    public function getScoreDom()
    {
        return $this->scoreDom;
    }

    /**
     * Set scoreExt
     *
     * @param integer $scoreExt
     * @return Prono
     */
    public function setScoreExt($scoreExt)
    {
        $this->scoreExt = $scoreExt;

        return $this;
    }

    /**
     * Get scoreExt
     *
     * @return integer 
     */
    public function getScoreExt()
    {
        return $this->scoreExt;
    }

    /**
     * Set victoire
     *
     * @param boolean $victoire
     * @return Prono
     */
    public function setVictoire($victoire)
    {
        $this->victoire = $victoire;

        return $this;
    }

    /**
     * Get victoire
     *
     * @return boolean 
     */
    public function getVictoire()
    {
        return $this->victoire;
    }

    /**
     * Set resultat
     *
     * @param boolean $resultat
     * @return Prono
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return boolean 
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set utilisateur
     *
     * @param integer $utilisateur
     * @return Prono
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return integer 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set matchs
     *
     * @param integer $matchs
     * @return Prono
     */
    public function setMatchs($matchs)
    {
        $this->matchs = $matchs;

        return $this;
    }

    /**
     * Get matchs
     *
     * @return integer 
     */
    public function getMatchs()
    {
        return $this->matchs;
    }
    
    public function hydrate(\stdClass $prono) {
        
        $_prono = new Prono();
        //var_dump(get_object_vars($equipe));
        foreach($prono as $attr => $value) {
            
            $attribut = "set".ucfirst($attr);
            $_prono->$attribut($value);
          
        }
        
        return $_prono;
    }
    
    static function hydrateAll(array $pronos) {
        
        $prono = new \stdClass();
        $e = new Prono();
        
        foreach($pronos as $attr => $value) {
            
            foreach($value as $id => $valeur) {
                
                if(!is_int($id)) {
                    
                    $prono->{$id} = $valeur;
                    //var_dump($equipe);
                }
                
            }
            //var_dump($equipe);
            $pronos[$attr] = $e->hydrate($prono);
            unset($prono);
            $prono = new \stdClass();
        }
        
        return $pronos;
        
    }
    
}
