<?php

namespace Cymbaline\Community\Manager\form;

use core\component\tools\Form;


/**
 * Description of LoginForm
 *
 * @author Thibault
 */
class LoginForm extends Form {



    public function __construct() {
        $this->name = 'form_manager';
		$this->method = 'post';
		$this->add('form_validator','hidden',array("value" => md5($this->name)));
    }

    public function create() {

        $this->add('mail', 'email', array(
            "class" => "span4",
        ), array(
            "value" => "Identifiant",
            "class"    => "control-label",
        ));

        $this->add('password','password', array(
            "class" => "span4",
        ), array(
            "value" => "Mot de passe",
            "class"    => "control-label",
        ));
		
		return $this;

    }
}