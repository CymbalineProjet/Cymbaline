<?php

namespace Cymbaline\Generator\controller;

use core\component\tools\View;
use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;

use Cymbaline\Generator\form\ParametersForm;
use Cymbaline\Generator\item\Parameters;
use Cymbaline\Generator\item\ModeleFileItem;
use Cymbaline\Generator\item\ModeleFileController;
use Cymbaline\Generator\item\ModeleFileService;
use Cymbaline\Generator\item\ModeleFileForm;
use Cymbaline\Generator\item\ModeleFileRoute;
use Cymbaline\Generator\item\ModeleFileTemplate;
use Cymbaline\Generator\item\Zone;
use Cymbaline\Generator\item\Box;

/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class DefautController extends Controller {

    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction() {
        
        $error = false;
        $test = "defaut controller generator";
        $param = new Parametrage();
        $zone = new Zone();
        
        $form_parameters = new ParametersForm();
        $form_parameters->setMethod('post');
        $form_parameters->setAction($this->path('generator_edit'));
        $form_parameters->setClass('form-horizontal row-fluid');

        return new View(array(
            'error' => $error,
            'test'  => $test,
            'param' => $param->getParam()->parameters,
            'zone'  => $zone->getList(),
        ),array(
            'form_parameters'  => $form_parameters,
        ));
    }
    
    
    public function editAction() {
        
        $error = false;
        $test = "defaut controller generator edit-parameters";
        $parameters = new Parameters($this->request->get('post'));
        $parameters->save();
        
        $this->redirect($this->path('generator_parameters'));
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function additemAction() {
        
        $controller = null;
        $model = null;
        $service = null;
        $form = null;
        $route = null;
        $crud = false;        
        
        if(isset($this->request->get('post')->name)) {

            $model = new ModeleFileItem(array(
                'name'   => $this->request->get('post')->name,
                'attr'   => $this->request->get('post')->attr_name,
                'author' => $this->request->get('post')->author,
                'path'   => $this->request->get('post')->path,
            ));

            if(isset($this->request->get('post')->controller_item)) {
                if(isset($this->request->get('post')->crud_item)) {
                    $crud = true;

                    new ModeleFileTemplate(array(
                        'name'   => $this->request->get('post')->name,
                        'attr'   => $this->request->get('post')->attr_name,
                        'author' => $this->request->get('post')->author,
                        'path'   => $this->request->get('post')->path,
                    ));
                }

                $controller = new ModeleFileController(array(
                    'name'   => $this->request->get('post')->name,
                    'attr'   => $this->request->get('post')->attr_name,
                    'author' => $this->request->get('post')->author,
                    'path'   => $this->request->get('post')->path,
                    'crud'   => $crud,
                ));

                $route = new ModeleFileRoute(array(
                    'name'   => $this->request->get('post')->name,
                    'attr'   => $this->request->get('post')->attr_name,
                    'author' => $this->request->get('post')->author,
                    'path'   => $this->request->get('post')->path,
                    'crud'   => $crud,
                ));
            }
            
            if(isset($this->request->get('post')->form_item)) {
                $form = new ModeleFileForm(array(
                    'name'   => $this->request->get('post')->name,
                    'attr'   => $this->request->get('post')->attr_name,
                    'author' => $this->request->get('post')->author,
                    'path'   => $this->request->get('post')->path,
                ));
            }
            
            if(isset($this->request->get('post')->service_item)) {
                $service = new ModeleFileService(array(
                    'name'   => $this->request->get('post')->name,
                    'attr'   => $this->request->get('post')->attr_name,
                    'author' => $this->request->get('post')->author,
                    'path'   => $this->request->get('post')->path,
                ));
            }
            die('ok');
            $this->redirect($this->path('generator_add_item'));
        }
        
        return new View(array());
    }

    
    public function addzoneAction() {
        
        $error = false;
        $test = "defaut controller generator create zone";
        
        if(isset($this->request->get('post')->addzone)) {
            $zone = new Zone($this->request->get('post')->addzone);
            $zone->create();
            $this->redirect($this->path('generator_add_zone'));
        }
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function addboxAction() {
        
        $error = false;
        $test = "defaut controller generator create box";
       
        if(isset($this->request->get('post')->zone)) {
            $zone = new Zone($this->request->get('post')->zone);
            $box = new Box($this->request->get('post')->addbox,$zone->getName());
            $box->create();
            $this->redirect($this->path('generator_add_box'));
        }
        $zone = new Zone();
        return new View(array(
            'error' => $error,
            'test'  => $test,
            'zone'  => $zone->getList(),
        ));
    }
    
    public function codeAction() {
        return new View(array(
            'error' => 'test',
        ));
    }
    
    public function routeAction() {
        $route = new \core\component\Route('/');
        $routes = $route->getRoutes();
        
        return new View(array(
            'routes' => $routes,
        ));
    }
    
}
