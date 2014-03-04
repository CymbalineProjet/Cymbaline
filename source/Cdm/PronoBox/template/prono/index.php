<?php
$view->extend("head", "prono14 | vos pronos"); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

echo $view->variables['test'];

//var_dump($view->variables['stades']);