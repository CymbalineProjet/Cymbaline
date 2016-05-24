<?php

/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 23/05/2015
 * Time: 02:42
 */



namespace core\component\dbmanager;



use core\component\Controller;
use NBAData\API\NBA_API;


class DBController extends Controller {


    public function soapAction() {
        $api = new NBA_API("slugypop31","mybot/0.1 (https://erikberg.com/)");
    }


    public function sqlAction(array $args) {

        $path = null;

        $path = str_replace("{","",str_replace("}","",$args['path']));

        $a = explode(":",$path);

        var_dump($a);die;



        if(is_null($path))

            echo "error";

        else

            echo $path;



        exit;

    }

}