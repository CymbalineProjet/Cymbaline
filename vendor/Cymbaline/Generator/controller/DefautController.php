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
use Cymbaline\Generator\item\Zone;
use Cymbaline\Generator\item\Box;

/**
 * Le Controler permet la gestion des données en fonction de la page
 * Le Controler retournera un tableau des données utiles à  l'affichage
 *
 * @author tjeannet
 */
class DefautController extends Controller {

    public function __construct() {
        
    }
    /**
     * indexAction() traitera les données pour la page index
     * @return stdClass $this->retour Tableau des données nécessaires à l'affichage 
     */
    public function indexAction(Request $request) {
        
        $error = false;
        $test = "defaut controller generator";
        $param = new Parametrage();
        $zone = new Zone();
        
        $form_parameters = new ParametersForm();
        $form_parameters->setMethod('post');
        $form_parameters->setAction($this->path('generator_edit'));
        $form_parameters->setClass('form-horizontal');
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
            'param' => $param->getParam()->parameters,
            'zone'  => $zone->getList(),
        ),array(
            'form_parameters'  => $form_parameters,
        ));
    }
    
    
    public function editAction(Request $request) {
        
        $error = false;
        $test = "defaut controller generator edit-parameters";
        $parameters = new Parameters($request->get('post'));
        $parameters->save();
        
        return new View(array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function createitemAction(Request $request) {
        
        $error = false;
        $test = "defaut controller generator create item";
        
        $model = new ModeleFileItem(array(
            'name'   => $request->post->name,
            'attr'   => $request->post->attr_name,
            'author' => $request->post->author,
            'path'   => $request->post->path,
        ));
       
        if(isset($request->post->controller_item)) {
            $controller = new ModeleFileController(array(
                'name'   => $request->post->name,
                'attr'   => $request->post->attr_name,
                'author' => $request->post->author,
                'path'   => $request->post->path,
            ));
        }
        
        return new View('Alca/GenBox/create-item', array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function addzoneAction(Request $request) {
        
        $error = false;
        $test = "defaut controller generator create zone";
        
        $nameZone = $request->post->addzone;
        $zone = new Zone($nameZone);
        $zone->create();
        
        return new View('Alca/GenBox/create-zone', array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function addboxAction(Request $request) {
        
        $error = false;
        $test = "defaut controller generator create box";
        
        $zone = $request->post->zone;
        $nameBox = $request->post->addbox;
        
        $zone = new Zone($zone);
        $box = new Box($nameBox,$zone->getName());
        $box->create();
        
        return new View('Alca/GenBox/create-box', array(
            'error' => $error,
            'test'  => $test,
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
            'routes' => $routes['routes']['route'],
        ));
    }
    
}
