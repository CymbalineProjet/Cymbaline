<?php

namespace Cymbaline\Administration\controller;

use Cymbaline\Generator\interfaces\ControllerCRUD;

use core\component\tools\View;
use core\component\Controller;

use Cymbaline\Administration\item\Tasks;
use Cymbaline\Administration\form\TasksForm;
use Cymbaline\Administration\form\TasksEditForm;

/**
 * Description of Tasks
 * 
 *
 * @author Thibault
 */
class TasksController extends Controller implements ControllerCRUD {

    
    /**
     * todoAction() list todos
     * @return View $view
     */
    public function indexAction() {


        $tasks = $this->dbmanager
                      ->load(new Tasks())
                      ->setOrder("ORDER BY date DESC")
                      ->get();

        return new View(array(
            'tasks' => $tasks,
            'news'  => $news,
        ));
    }
    
    /**
     * newAction() create a task
     * @return View $view
     */
    public function newAction() {
        
        $form = new TasksForm();
        $form->setMethod("post");
        $form->setAction($this->path("tasks_new"));
        $form->setClass('form-horizontal row-fluid');
        
        if(isset($this->request->get('post')->form_tasks)) {

            $task = new Tasks();
            $task->setFlag(0);
            $task->setContent($this->request->get('post')->form_tasks->content);
            $this->dbmanager->load($task);
            $this->dbmanager->push();
            
            $this->redirect($this->path('tasks'));
        }
    
        return new View(array(
            
        ),array(
            'form' => $form,
        ));
    }

    /**
     * @param array $args
     */
    public function updateAction(array $args) {

        $item = $this->dbmanager
            ->load(new Tasks())
            ->getById($args['id']);

        $item->setFlag(1);

        $this->dbmanager
            ->load($item)
            ->update($args['id']);

        $this->redirect($this->path('tasks'));

    }

    /**
     * deleteAction() delete a tasks
     * @param array $args
     */
    public function deleteAction(array $args) {

        $t = $this->dbmanager
            ->load(new Tasks())
            ->getById($args['id']);

        $this->dbmanager
            ->load($t)
            ->delete($args['id']);

        $this->redirect($this->path('tasks'));
    }

    /**
     * @throws VarException
     */
    public function createAction() {

        if($this->request->get('post')->form_hello->label == "")
            throw new VarException("form_hello[label] is null");

        $item = new Tasks();
        $item->setContent($this->request->get('post')->form_tasks->content);
        $this->dbmanager
            ->load($item)
            ->push();

        $this->redirect($this->path('tasks'));
    }

    /**
     * editAction() show form to edit an item
     * @return View $view
     * @param array $args
     */
    public function editAction(array $args) {

        $item = $this->dbmanager
            ->load(new Tasks())
            ->getById($args['id']);

        $form = new TasksEditForm();
        $form->setItem($item);
        $form->setMethod('post');
        $form->setAction($this->path('tasks_edit', $args['id']));

        return new View(array(

        ), array(
            'form' => $form,
        ));
    }
}
