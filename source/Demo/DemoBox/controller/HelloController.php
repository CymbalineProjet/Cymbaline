<?php

namespace source\Demo\DemoBox\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\exception\VarException;

use source\Demo\DemoBox\item\Hello;
use source\Demo\DemoBox\form\HelloForm;
use source\Demo\DemoBox\form\HelloEditForm;

/**
 * Description of Hello
 * 
 *
 * @author Jaxx
 */
class HelloController extends Controller {

    /**
     * indexAction() show items
     * @return View $view
     */
    public function indexAction() {
        
        $items = $this->dbmanager
                      ->load(new Hello())
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
        
        $form = new HelloForm();
        $form->setMethod('post');
        $form->setAction($this->path('hello_create'));
        
        return new View(array(
            
        ), array(
            'form' => $form,
        ));
    }

    /**
     * @param Request $request
     * @throws VarException
     */
    public function createAction(Request $request) {

        if($request->get('post')->form_hello->label == "")
            throw new VarException("form_hello[label] is null");

        $item = new Hello();
        $item->setLabel($request->get('post')->form_hello->label);
        $this->dbmanager
             ->load($item)
             ->push();

        $this->redirect($this->path('hello_index'));
    }

    /**
     * editAction() show form to edit an item
     * @return View $view
     */
    public function editAction(Request $request, array $args) {

        $item = $this->dbmanager
                     ->load(new Hello())
                     ->getById($args['id']);

        $form = new helloEditForm($item);
        $form->setMethod('post');
        $form->setAction($this->path('hello_update', $args['id']));
        
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

        if($request->get('post')->form_edit_hello->label == "")
            throw new VarException("form_edit_hello[label] is null");

        $item = $this->dbmanager
                     ->load(new Hello())
                     ->getById($args['id']);
        $item->setLabel($request->get('post')->form_edit_hello->label);

        $this->dbmanager
             ->load($item)
             ->update($args['id']);

        $this->redirect($this->path('hello_index'));
    }

    /**
     * deleteAction() delete an item in database 
     * @return null
     */
    public function deleteAction(Request $request, array $args) {

        if($args['id'] == "")
            throw new VarException("args[id] is null");

        $item = $this->dbmanager
                     ->load(new Hello())
                     ->getById($args['id']);

        $this->dbmanager
             ->load($item)
             ->delete($args['id']);

        $this->redirect($this->path('hello_index'));
    }

    
}