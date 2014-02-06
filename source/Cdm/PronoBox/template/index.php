<?php
$view->extend("head", ""); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

$view->get('User/SecurityBox/login',array(
    "action" => "./home",
));


