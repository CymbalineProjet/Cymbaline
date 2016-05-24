<?php

namespace source\Cdm\PronoBox\form;

use core\component\tools\Form;
use source\Cdm\PronoBox\item\Matchs;


/**
 * Description of ParametersForm
 *
 * @author Thibault
 */
class MatchForm extends Form {
    
    

    public function __construct($item) {
        $this->setName('form_new');
        if(is_null($item) || !isset($item)) {
            $this->build();
        } else {
            $this->build($item);
        }
    }
    
    public function build($item = null) {     
        
        if(is_null($item)) {
            $item = new Matchs();
        }
        
        $this->add('equipedom', 'text', array(
            "required" => "required",
            "class" => "equipe",
            "value"    => $item->getEquipedom(),
        ), array(
            "value" => "Equipe domicile",
        ));

        $this->add('equipeext','text', array(         
            "required" => "required",
            "class" => "equipe",
            "value"    => $item->getEquipeext(),
        ), array(
            "value" => "Equipe extérieur",
        ));
        
        $this->add('scoredom', 'number', array(
            "required" => "required",
            "value"    => $item->getScoredom(),
        ), array(
            "value" => "Score domicile",
        ));

        $this->add('scoreext','number', array(         
            "required" => "required",
            "value"    => $item->getScoreext(),
        ), array(
            "value" => "Score extérieur",
        ));

        $this->add('date','datetime', array(    
            "required" => "required",
            "value"    => $item->getDate(),
            "id" => "datepicker",
        ), array(
            "value" => "Date",
        ));

        $this->add('joue','radio', array( 
            "checked"    => $item->getJoue(),
        ), array(
            "value" => "Etat",
        ), array(
            "1" => "Déjà joué",
            "0" => "A venir",
        ));

        $this->add('stade','text', array(    
            "required" => "required",
            "class" => "stade",
            "value"    => $item->getStade(),
        ), array(
            "value" => "Stade",
        ));
        
    }
}
