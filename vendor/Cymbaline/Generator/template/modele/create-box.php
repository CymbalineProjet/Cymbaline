<?php
$view->extend("header", $view->variables->test); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...
?>

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    

<?php
echo $view->variables->test;

$view->extend("footer", $view->variables->test);
