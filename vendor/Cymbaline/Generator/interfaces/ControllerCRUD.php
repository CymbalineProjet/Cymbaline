<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 22/05/2015
 * Time: 01:18
 */

namespace Cymbaline\Generator\interfaces;



interface ControllerCRUD {

    public function indexAction();
    public function newAction();
    public function editAction(array $args);
    public function updateAction(array $args);
    public function deleteAction(array $args);
    public function createAction();
}