<?php

namespace source\Demo\DemoBox\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\exception\VarException;

use source\Demo\DemoBox\item\Maintenance;
use source\Demo\DemoBox\form\MaintenanceForm;
use source\Demo\DemoBox\form\MaintenanceEditForm;

/**
 * Description of Maintenance
 * 
 *
 * @author Thibault Jeannet
 */
class MaintenanceController extends Controller {

    /**
     * indexAction() show items
     * @return View $view
     */
    public function indexAction() {
        
        $items = $this->dbmanager
                      ->load(new Maintenance())
                      ->get();
        
        return new View(array(
            'items' => $items,
        ));
    }

    /**
     * newAction() show form for new item
     * @return View $view
     */
    public function newAction() {
        
        $form = new MaintenanceForm();
        $form->setMethod('post');
        $form->setAction($this->path('maintenance_create'));
        
        return new View(array(
            
        ), array(
            'form' => $form,
        ));
    }

    /**
     * createAction() save item in database 
     * @return null
     */
    public function createAction(Request $request) {

        if($request->get('post')->form_maintenance->label == "")
            throw new VarException("form_maintenance[label] is null");

        $item = new Maintenance();
        $item->setLabel($request->get('post')->form_maintenance->label);
        $this->dbmanager
             ->load($item)
             ->push();

        $this->redirect($this->path('maintenance_index'));
    }

    /**
     * editAction() show form to edit an item
     * @return View $view
     */
    public function editAction(Request $request, array $args) {

        $item = $this->dbmanager
                     ->load(new Maintenance())
                     ->getById($args['id']);

        $form = new maintenanceEditForm($item);
        $form->setMethod('post');
        $form->setAction($this->path('maintenance_update', $args['id']));
        
        return new View(array(

        ), array(
            'form' => $form,
        ));
    }

    /**
     * updateAction() update an item in database 
     * @return null
     */
    public function updateAction(Request $request, array $args) {

        if($request->get('post')->form_edit_maintenance->label == "")
            throw new VarException("form_edit_maintenance[label] is null");

        $item = $this->dbmanager
                     ->load(new Maintenance())
                     ->getById($args['id']);
        $item->setLabel($request->get('post')->form_edit_maintenance->label);

        $this->dbmanager
             ->load($item)
             ->update($args['id']);

        $this->redirect($this->path('maintenance_index'));
    }

    /**
     * deleteAction() delete an item in database 
     * @return null
     */
    public function deleteAction(Request $request, array $args) {

        if($args['id'] == "")
            throw new VarException("args[id] is null");

        $item = $this->dbmanager
                     ->load(new Maintenance())
                     ->getById($args['id']);

        $this->dbmanager
             ->load($item)
             ->delete($args['id']);

        $this->redirect($this->path('maintenance_index'));
    }

    
}