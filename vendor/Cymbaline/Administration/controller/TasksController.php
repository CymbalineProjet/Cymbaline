<?php

namespace Cymbaline\Administration\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\dbmanager\SqlCommand;

use Cymbaline\Administration\item\Tasks;
use Cymbaline\Administration\form\TasksForm;

/**
 * Description of Tasks
 * 
 *
 * @author Thibault
 */
class TasksController extends Controller {

    
    /**
     * closeAction() close a todo
     * @return redirect
     */
    public function closeAction(Request $request, array $args) {
        
        $t = $this->dbmanager
                  ->load(new Tasks())
                  ->getById($args['id']);

        $t->setFlag(1);


        $task = $this->dbmanager
                  ->load($t)
                  ->update($args['id']);
        
        $this->redirect($this->path('tasks'));
        
    }
    

    
    /**
     * deleteAction() delete a tasks
     * @return redirect
     */
    public function deleteAction(Request $request, array $args) {
        
        $t = $this->dbmanager
                  ->load(new Tasks())
                  ->getById($args['id']);

        $this->dbmanager
             ->load($t)
             ->delete($args['id']);
        
        $this->redirect($this->path('tasks'));
    }
    
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
        ));
    }
    
    /**
     * newAction() create a todo
     * @return View $view
     */
    public function newAction(Request $request) {
        
        $form = new TasksForm();
        $form->setMethod("post");
        $form->setAction($this->path("tasks_new"));
        $form->setClass('form-horizontal row-fluid');
        
        if(isset($request->get('post')->form_tasks)) {
            $flag = 0;
            if($request->get('post')->form_tasks->flag == "oui") {
                $flag = 1;
            }
            $task = new Tasks();
            $task->setFlag($flag);
            $task->setContent($request->get('post')->form_tasks->content);
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
     * @param Request $request
     * @param array $args
     */
    public function updateAction(Request $request, array $args) {

        $item = $this->dbmanager
            ->load(new Tasks())
            ->getById($args['id']);

        $item->setFlag(1);

        $this->dbmanager
            ->load($item)
            ->update($args['id']);

        $this->redirect($this->path('tasks'));

    }
}
