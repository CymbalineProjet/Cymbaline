<?php

namespace source\Cdm\PronoBox\item;



/**
 * Equipe
 *
 */
class Equipe
{
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
     * #name=slug#
     */
    private $slug;

    /**
     * #type=int#
     * #name=but#
     */
    private $but;

    /**
     * #type=int#
     * #name=butc#
     */
    private $butc;

    /**
     * #type=int#
     * #name=diff#
     */
    private $diff;

    /**
     * #type=string#
     * #name=pos#
     */
    private $pos;

    /**
     * #type=int#
     * #name=poule#
     */
    private $poule;
    
    /**
     * #type=int#
     * #name=point#
     */
    private $point;


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
     * Set nom
     *
     * @param string $nom
     * @return Equipe
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
     * Set slug
     *
     * @param string $slug
     * @return Equipe
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set but
     *
     * @param integer $but
     * @return Equipe
     */
    public function setBut($but)
    {
        $this->but = $but;

        return $this;
    }

    /**
     * Get but
     *
     * @return integer 
     */
    public function getBut()
    {
        return $this->but;
    }

    /**
     * Set butc
     *
     * @param integer $butc
     * @return Equipe
     */
    public function setButc($butc)
    {
        $this->butc = $butc;

        return $this;
    }

    /**
     * Get butc
     *
     * @return integer 
     */
    public function getButc()
    {
        return $this->butc;
    }

    /**
     * Set diff
     *
     * @param integer $diff
     * @return Equipe
     */
    public function setDiff($diff)
    {
        $this->diff = $diff;

        return $this;
    }

    /**
     * Get diff
     *
     * @return integer 
     */
    public function getDiff()
    {
        return $this->diff;
    }

    
    /**
     * Set pos
     *
     * @param string $pos
     * @return Equipe
     */
    public function setPos($pos)
    {
        $this->pos = $pos;

        return $this;
    }

    /**
     * Get pos
     *
     * @return string 
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * Set poule
     *
     * @param integer $poule
     * @return Equipe
     */
    public function setPoule($poule)
    {
        $this->poule = $poule;

        return $this;
    }

    /**
     * Get poule
     *
     * @return integer 
     */
    public function getPoule()
    {
        return $this->poule;
    }

    /**
     * Set point
     *
     * @param integer $point
     * @return Equipe
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return integer 
     */
    public function getPoint()
    {
        return $this->point;
    }
    
    public function hydrate(\stdClass $equipe) {
        
        $_equipe = new Equipe();
        //var_dump(get_object_vars($equipe));
        foreach($equipe as $attr => $value) {
            
            $attribut = "set".ucfirst($attr);
            $_equipe->$attribut($value);
          
        }
        
        return $_equipe;
    }
    
    static function hydrateAll(array $equipes) {
        
        $equipe = new \stdClass();
        $e = new Equipe();
        
        foreach($equipes as $attr => $value) {
            
            foreach($value as $id => $valeur) {
                
                if(!is_int($id)) {
                    
                    $equipe->{$id} = $valeur;
                    //var_dump($equipe);
                }
                
            }
            //var_dump($equipe);
            $equipes[$attr] = $e->hydrate($equipe);
            unset($equipe);
            $equipe = new \stdClass();
        }
        
        return $equipes;
        
    }
    
}
