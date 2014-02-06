<?php

namespace core\component;

use core\component\ArrayToObject;

/**
 * valeurs possible get,post,cookie
 * 
 * @param array('get' => $_GET, 'post' => $_POST);
 * @author Thibault
 */
class Request {

	
    private $post;
    private $get;
    private $cookie;
    private $session;
    private $server;

	
    /**
     * valeurs possible get,post,cookie
     * 
     * @param array $request
     */
	public function __construct(array $request) {
        $req = array();
        foreach($request as $r => $v) {
            $req["$r"] = $v;
            $array = new ArrayToObject($req);
            
            $this->$r = $array->convert();
            
        }

	}
	
    public function get($attr) {
        if($attr == NULL) {
            //erreur
        } else {
            switch ($attr) {
                case "post" :
                    return $this->post;
                break;
            
                case "get" :
                    return $this->get;
                break;
            
                case "session" :
                    return $this->session;
                break;
            
                case "server" :
                    return $this->server;
                break;
            
                case "cookie" :
                    return $this->cookie;
                break;

                
            }
        }
    }
	


}

?>
