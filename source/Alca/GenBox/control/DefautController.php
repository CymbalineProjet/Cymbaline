<?php

namespace source\Alca\GenBox\control;

use core\component\View;
use core\component\Request;
use core\component\Parametrage;
use core\component\Controller;

use source\Alca\GenBox\form\ParametersForm;
use source\Alca\GenBox\item\Parameters;
use source\Alca\GenBox\item\ModeleFileItem;
use source\Alca\GenBox\item\ModeleFileController;
use source\Alca\GenBox\item\Zone;
use source\Alca\GenBox\item\Box;

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
        //on donne au retour un attribut error à false
        $error = false;
        $test = "defaut controller generator";
        $param = new Parametrage();
        $zone = new Zone();
        
        
        
        $form_parameters = new ParametersForm();
        $form_parameters->setMethod('post');
        $form_parameters->setAction('edit');
        $form_parameters->setClass('form-horizontal');
        
        
        
        return new View('Alca/GenBox/index', array(
            'error' => $error,
            'test'  => $test,
            'param' => $param->getParam()->parameters,
            'zone'  => $zone->getList(),
        ),array(
            'form_parameters'  => $form_parameters,
        ));
    }
    
    
    public function editAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "defaut controller generator edit-parameters";
        //var_dump($request->post);
        $parameters = new Parameters($request->post);
        $parameters->save();
        //var_dump($parameters); die;
        return new View('Alca/GenBox/edit-parameters', array(
            'error' => $error,
            'test'  => $test,
        ));
    }
    
    public function createitemAction(Request $request) {
        //on donne au retour un attribut error à false
        $error = false;
        $test = "defaut controller generator create item";
        var_dump($request->post->attr_name);
        $model = new ModeleFileItem(array(
            'name'   => $request->post->name,
            'attr'   => $request->post->attr_name,
            'author' => $request->post->author,
            'path'   => $request->post->path,
        ));
        var_dump($model);
       
        if(isset($request->post->controller_item)) {
            $controller = new ModeleFileController(array(
                'name'   => $request->post->name,
                'attr'   => $request->post->attr_name,
                'author' => $request->post->author,
                'path'   => $request->post->path,
            ));
            
            var_dump($controller);
        }
        
        
        //var_dump($parameters); die;
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
        var_dump($zone);
        
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
    
}
