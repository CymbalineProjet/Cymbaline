<?php

namespace core\component;

use core\component\tools\ArrayToObject;

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
        
        $array = new ArrayToObject($request['post']);
        $post = $array->convert();
        $array = new ArrayToObject($request['get']);
        $get = $array->convert();
        
        $this->cookie = $request['cookie'];
        $this->post = $post;
        $this->get = $get;
        $this->session = $request['session'];
        $this->server = $request['server'];

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
