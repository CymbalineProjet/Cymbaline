<?php
$view->extend("header", $view->variables->test); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...



echo $view->variables->test;


?>
</body>
</html>