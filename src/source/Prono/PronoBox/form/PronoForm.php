<?php

namespace source\Prono\PronoBox\form;

use core\component\tools\Form;


/**
 * Description of LoginForm
 *
 * @author Thibault
 */
class PronoForm extends Form {



    public function __construct() {
        $this->setName('form_prono');
        $this->build();
    }

    public function build() {

        $this->add('match', 'hidden', array(
            "class" => "span4",
        ), array(
            "value" => "Identifiant",
            "class"    => "control-label",
        ));

        $this->add('scoreDom','text', array(
            "class" => "span4",
        ), array(
            "value" => "Mot de passe",
            "class"    => "control-label",
        ));
		
		$this->add('scoreExt','text', array(
            "class" => "span4",
        ), array(
            "value" => "Mot de passe",
            "class"    => "control-label",
        ));
		
		$this->add('penalty','radio', array(
                     
        ), array(
            "value" => "Environnement",
            "class"    => "control-label",
        ), array(
            "oui" => 1,
            "non" => 0,
        ));

    }
}