<?php

namespace source\Cdm\PronoBox\item;

/**
 * Stade
 *
 */
class Stade {
    /**
     * #type=int#
     * #name=id#
     */
    private $id;

    /**
     * #type=string#
     * #name=nom#
     */
    private $nom;

    /**
     * #type=string#
     * #name=lieu#
     */
    private $lieu;

    /**
     * #type=int#
     * #name=capacite#
     */
    private $capacite;


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
     * @return Stade 
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Stade
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Stade
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set capacite
     *
     * @param integer $capacite
     * @return Stade
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite
     *
     * @return integer 
     */
    public function getCapacite()
    {
        return $this->capacite;
    }
    
    public function hydrate(\stdClass $stade) {
        
        $_stade = new Stade();
        //var_dump(get_object_vars($equipe));
        foreach($stade as $attr => $value) {
            
            $attribut = "set".ucfirst($attr);
            $_stade->$attribut($value);
          
        }
        
        return $_stade;
    }
    
    static function hydrateAll(array $stades) {
        
        $stade = new \stdClass();
        $e = new Stade();
        
        foreach($stades as $attr => $value) {
            
            foreach($value as $id => $valeur) {
                
                if(!is_int($id)) {
                    
                    $stade->{$id} = $valeur;
                    //var_dump($equipe);
                }
                
            }
            //var_dump($equipe);
            $stades[$attr] = $e->hydrate($stade);
            unset($stade);
            $stade = new \stdClass();
        }
        
        return $stades;
        
    }
}
