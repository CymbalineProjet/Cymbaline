<?php

namespace Cymbaline\Generator\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Controller;
use core\component\dbmanager\SqlCommand;

use Cymbaline\Generator\item\Todo;
use Cymbaline\Generator\form\TodoForm;

/**
 * Description of Todo
 * 
 *
 * @author Thibault
 */
class TodoController extends Controller {

    
    /**
     * closeAction() close a todo
     * @return View $view
     */
    public function closeAction(Request $request, array $args) {
        
        $m = $this->getManager();

        $m->load(new Todo());
        $t = $m->getById($args['id']);
        $t->setFlag(1);
        $m->load($t);
        $todo = $m->update($args['id']);
        
        $this->redirect($this->path('generator_todo'));
        return new View();
    }
    
    /**
     * openAction() open a todo
     * @return View $view
     */
    public function openAction(Request $request, array $args) {
        
        $m = $this->getManager();

        $m->load(new Todo());
        $t = $m->getById($args['id']);
        $t->setFlag(0);
        $m->load($t);
        $todo = $m->update($args['id']);
        
        $this->redirect($this->path('generator_todo'));
        return new View();
    }
    
    /**
     * deleteAction() delete a todo
     * @return View $view
     */
    public function deleteAction(Request $request, array $args) {
        
        $m = $this->getManager();

        $m->load(new Todo());
        $t = $m->getById($args['id']);
        $t->setFlag(1);
        $m->load($t);
        $todo = $m->delete($args['id']);
        
        $this->redirect($this->path('generator_todo'));
        return new View();
    }
    
    /**
     * todoAction() list todos
     * @return View $view
     */
    public function todoAction() {
	
		$m = $this->getManager();
        $m->load(new Todo());
		$todos = Todo::HydrateAll($m->get());
        
        /*$sqlcommand = new SqlCommand('Cdm/Utilisateur/Utilisateur');
        $sqlcommand->setSelect("*")
                   ->setOrderBy('point DESC, username ASC')
                   ->build();
        $data = $sqlcommand->execute();*/
	
        return new View(array(
            'todos' => $todos,
        ));
    }
	
    /**
     * newAction() create a todo
     * @return View $view
     */
	public function newAction(Request $request) {
		$m = $this->getManager();
		$form = new TodoForm();
        $form->setMethod("post");
        $form->setAction($this->path("generator_new_todo"));
		
		if(isset($request->get('post')->form_todo)) {
			$flag = 0;
			if($request->get('post')->form_todo->flag == "oui") {
				$flag = 1;
			}
			$todo = new Todo();
			$todo->setFlag($flag);
			$todo->setContent($request->get('post')->form_todo->content);
			$m->load($todo);
            $m->push();
			
			$this->redirect($this->path('generator_todo'));
		}
	
        return new View(array(
            
        ),array(
            'form' => $form,
        ));
    }
}
