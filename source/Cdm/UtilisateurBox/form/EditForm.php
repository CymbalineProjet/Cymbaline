<?php

namespace source\Cdm\UtilisateurBox\form;

use core\component\tools\Form;
use source\Cdm\UtilisateurBox\item\Utilisateur;


/**
 * Description of ParametersForm
 *
 * @author Thibault
 */
class EditForm extends Form {
    
    

    public function __construct($item) {
        $this->setName('form_edit');
        if(is_null($item) || !isset($item)) {
            $this->build();
        } else {
            $this->build($item);
        }
    }
    
    public function build($item = null) {     
        
        if(is_null($item)) {
            $item = new Utilisateur();
        }
        
        $this->add('nom', 'text', array(
            "required" => "required",
            "value"    => $item->getNom(),
        ), array(
            "value" => "Nom",
        ));

        $this->add('prenom','text', array(         
            "required" => "required",
            "value"    => $item->getPrenom(),
        ), array(
            "value" => "Pr&eacute;nom",
        ));

        $this->add('username','text', array(    
            "required" => "required",
            "value"    => $item->getUsername(),
        ), array(
            "value" => "Pseudo",
        ));

        $this->add('password','text', array(    
            "required" => "required",
            "value"    => $item->getPassword(),
        ), array(
            "value" => "Mot de passe",
        ));

        $this->add('mail','email', array(    
            "required" => "required",
            "value"    => $item->getMail(),
        ), array(
            "value" => "Adresse mail",
        ));
        
    }
}
