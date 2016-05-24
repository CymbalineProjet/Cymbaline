<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 23/05/2015
 * Time: 00:49
 */

namespace Cymbaline\Administration\form;


use core\component\interfaces\IForm;
use core\component\tools\Form;

/**
 * Class TasksEditForm
 * @package Cymbaline\Administration\form
 * @author Thibault Jeannet
 */
class TasksEditForm extends Form implements IForm {

    /**
     * Create Form
     */
    public function __construct() {

        $this->setName('form_edit_tasks');
        $this->build();
    }

    /**
     * Create form_edit_tasks
     */
    public function build() {

        $this->add('content', 'text', array(
            "class" => "span4",
            "value" => $this->getItem()->getContent(),
        ), array(
            "value" => "Content",
            "class"    => "control-label",
        ));

    }
}