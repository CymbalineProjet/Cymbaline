<?php
$view->extend("header", "prono14 | admin "); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

echo $view->variables['test'];


$view->extend("admin_footer");