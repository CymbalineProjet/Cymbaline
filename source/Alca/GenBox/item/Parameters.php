<?php

namespace source\Alca\GenBox\item;

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
        $xml = "<?xml version='1.0' encoding='UTF-8'?>
        <parameters>
            <env>$this->env</env>
            <baseurl>$this->baseurl</baseurl>
            <basetitle>$this->basetitle</basetitle>
            <controllerdefault>$this->controllerdefault</controllerdefault>
            <database env='dev'>
                <host>".$this->dbdev->host." </host>
                <port>".$this->dbdev->port." </port>
                <dbname>".$this->dbdev->dbname." </dbname>
                <dbuser>".$this->dbdev->dbuser." </dbuser>
                <dbpass>".$this->dbdev->dbpass." </dbpass>
            </database>

            <database env='prod'>
                <host>".$this->dbprod->host." </host>
                <port>".$this->dbprod->port." </port>
                <dbname>".$this->dbprod->dbname." </dbname>
                <dbuser>".$this->dbprod->dbuser." </dbuser>
                <dbpass>".$this->dbprod->dbpass." </dbpass>
            </database>
        </parameters>";
        
        $file = new File();
        $file->ecrire($xml, "core/config/parameters.xml");
        
                
                
    }
}
