<?php

namespace Cymbaline\Generator\item;

use core\component\tools\ArrayToObject;
use core\component\tools\File;

/**
 * Description of Parameters
 *
 * @author Thibault
 */
class Parameters {
    //put your code here
    private $env;
    private $baseurl;
    private $basetitle;
    private $controllerdefault;
    
    private $dbdev;
    private $dbprod;
    
    public function __construct($param) {
        
        $this->env               = $param->env;
        $this->baseurl           = $param->baseurl;
        $this->basetitle         = $param->basetitle;
        $this->controllerdefault = $param->controllerdefault;
        
        $this->dbdev = array(
            'host'   => $param->host,
            'port'   => $param->port,
            'dbname' => $param->dbname,
            'dbuser' => $param->dbuser,
            'dbpass' => $param->dbpass
        );
        
        $this->dbprod = array(
            'host'   => $param->host_prod,
            'port'   => $param->port_prod,
            'dbname' => $param->dbname_prod,
            'dbuser' => $param->dbuser_prod,
            'dbpass' => $param->dbpass_prod
        );
        
        $array = new ArrayToObject($this->dbdev);
        $this->dbdev = $array->convert();
        
        $array = new ArrayToObject($this->dbprod);
        $this->dbprod = $array->convert();
        
        
        
    }
    
    public function save() {
        $yml = file_get_contents(__DIR__."/../../../../vendor/Cymbaline/Generator/template/modele/modele-parameters.txt");
        
        $yml = str_replace("#env", $this->env, $yml);
        $yml = str_replace("#baseurl", $this->baseurl, $yml);
        $yml = str_replace("#basetitle", $this->basetitle, $yml);
        $yml = str_replace("#controllerdefault", $this->controllerdefault, $yml);
        $yml = str_replace("#host", $this->dbdev->host, $yml);
        $yml = str_replace("#port", $this->dbdev->port, $yml);
        $yml = str_replace("#dbname", $this->dbdev->dbname, $yml);
        $yml = str_replace("#dbuser", $this->dbdev->dbuser, $yml);
        $yml = str_replace("#dbpass", $this->dbdev->dbpass, $yml);
        $yml = str_replace("#phost", $this->dbprod->host, $yml);
        $yml = str_replace("#pport", $this->dbprod->port, $yml);
        $yml = str_replace("#pdbname", $this->dbprod->dbname, $yml);
        $yml = str_replace("#pdbuser", $this->dbprod->dbuser, $yml);
        $yml = str_replace("#pdbpass", $this->dbprod->dbpass, $yml);

        
        $file = new File();
        $file->ecrire($yml, __DIR__."/../../../../core/config/parameters.yml");
    }
}
