<?php

namespace source\Cdm\PronoBox\item;


class Poule
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
     * @return Poule 
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
     * @return Poule
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
    
    public function hydrate(\stdClass $poule) {
        
        $_poule = new Poule();
        //var_dump(get_object_vars($equipe));
        foreach($poule as $attr => $value) {
            
            $attribut = "set".ucfirst($attr);
            $_poule->$attribut($value);
          
        }
        
        return $_poule;
    }
    
    static function hydrateAll(array $poules) {
        
        $poule = new \stdClass();
        $e = new Poule();
        
        foreach($poules as $attr => $value) {
            
            foreach($value as $id => $valeur) {
                
                if(!is_int($id)) {
                    
                    $poule->{$id} = $valeur;
                    //var_dump($equipe);
                }
                
            }
            //var_dump($equipe);
            $poules[$attr] = $e->hydrate($poule);
            unset($poule);
            $poule = new \stdClass();
        }
        
        return $poules;
        
    }
}
