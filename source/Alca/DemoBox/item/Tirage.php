<?php

namespace Entity;

/**
 * Description of Tirage :
 * Class Tirage permettant de créer une instance de tirage 
 * et d'utiliser les fonctions
 *
 * @author tjeannet
 */
class Tirage {
    
    /**
     * 
     * @var $randomString string 
     */
    private $randomString;
    /**
     * String des chiffres compris entre 0 et 9
     * $characters = '0123456789';
     * @var $characters string 
     */
    private $characters;
    /**
     * Nombres aléatoires uniques
     * @var $uniq int 
     */
    private $uniq;
    
    /**
     * Constructeur Tirage
     * -- initilise $characters à '0123456789'
     */
    public function __construct() {
        $this->characters = '0123456789';
    }
    
    /**
     * Retourne la valeur de $randomString
     * @return string $randomString
     */
    public function getRandomString() {
        return $this->randomString;
    }
    
    /**
     * Modifie la valeur de $randomString et reourne l'objet
     * @param string $randomS
     * @return \Tirage
     */
    public function setRandomString($randomS) {
        $this->randomString = $randomS;
        return $this;
    }
    
    /**
     * Retourne la valeur de $characters
     * @return string $characters
     */
    public function getCharacters() {
        return $this->characters;
    }
    
    /**
     * Modifie la valeur de $characters et reourne l'objet
     * @param string $character
     * @return \Tirage
     */
    public function setCharacters($character) {
        $this->characters = $character;
        return $this;
    }
    
    /**
     * Retourne la valeur de $characters
     * @return int $uniq
     */
    public function getUniq() {
        return $this->uniq;
    }
    
    /**
     * Modifie la valeur de $characters et reourne l'objet
     * @param it $unique
     * @return \Tirage
     */
    public function setUniq($unique) {
        $this->uniq = (int) $unique;
        return $this;
    }
    
    /**
     * Génère la variable $uniq
     * La longueur de la chaine retournée peut être renseignée
     * @param int $length
     * @return int $this->uniq
     */
    public function generateRandomString($length = 5) {
        $this->randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $this->randomString .= $this->characters[rand(0, strlen($this->characters) - 1)];
        }
        $this->uniq = (int) $this->randomString;
        return $this->uniq;
    }
}
