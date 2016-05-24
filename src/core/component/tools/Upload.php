<?php

namespace core\component\tools;

/**
 * 
 * http://www.zone-webmasters.net/codes-sources/php/60-classe-d-upload-de-fichier-php5.html
 */
class Upload2
{
    /**
     * @var String
     */
    private $Fichier        ='';
    /**
     * @var String
     */
    private $Nom            ='';
    /**
     * @var String
     */
    private $Type           ='';
    /**
     * @var String
     */
    private $Repertoire     ='';
    /**
     * @var String
     */
    private $Temp           ='';
    /**
     * @var Array
     */
    private $TypesValides   = array();
    /**
     * @var String
     */
    private $Erreur         ='';


	public function __construct($Fichier) {
        
        $this->Temp = $_FILES[$Fichier]['tmp_name'];
        $this->Nom = $_FILES[$Fichier]['name'];
        $this->Type =$_FILES[$Fichier]['type'];

    }

	public function setTypesValides($TypesValides)
    {
        $this->TypesValides = $TypesValides;
    }	
	
	public function uploadFichier($Repertoire='./')
    {
        $this->Repertoire = $Repertoire;

        if(!is_uploaded_file($this->Temp))
        {
            return false;
            $this->Erreur='Vous avez rien uploader';
        }

        else if(in_array($this->Type,$this->TypesValides))
        {
            return false;
            $this->Erreur= 'Le fichier '.$this->Nom.' n\'est pas d\'un type valide';
        }

        elseif(!move_uploaded_file($this->Temp, $this->Repertoire.$this->Nom))
        {
            return false;
            $this->Erreur='Impssible de copier le fichier '.$this->Nom;
        }
        else {return true;}
    }
	
	public	function UploadErreur()
    {
        return $this->Erreur='Vous avez rien uploader';
    }

	public	function setNom($Nom)
    {
        $this->Nom = $Nom.".jpg";
        return $this;
    }		
		
	public	function RetournerType()
    {
        return($this->Type);
    }	
		
	public	function RetournerNom()
    {
        return($this->Nom);
    }	
		
	public 	function __toString()
    {
        return($this->Nom);
    }
}