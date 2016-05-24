<?php

namespace Cymbaline\Community\Member\form;

use core\component\tools\Form;


/**
 * Description of LoginForm
 *
 * @author Thibault
 */
class LoginForm extends Form {



    public function __construct() {
        $this->setName('form_user');
        $this->build();
    }

    public function build() {

        $this->add('identifiant', 'text', array(
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

    }
}