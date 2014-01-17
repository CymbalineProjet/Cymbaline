<?php

use Config\Parametrage;
use Control\Controler;





$param = new Parametrage();
$controller = new Controler($_GET, $_POST, $_SESSION, $param);

//app sur une page, donc sur l'index
$view = $controller->indexAction();

//var_dump($view);

// autoload function
function __autoload($class_name) {
	require_once($class_name.".php");
}

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Tirage au sort</title>
        <!--link rel="icon" type="image/x-icon" href="/favicon.ico" /-->
        <link rel="stylesheet" href="/public/css/main.css" />
        <script type="text/javascript" src="public/js/jquery.js"></script>
    </head>
    <body>
		<h1>Formulaire d'inscription</h1>
        
        <?php
        if($view->error) {
            echo "<div class='error'>".$view->messageError."</div>";
        }
        
        if($view->insert) {
            echo "<div class='valide'>".$view->message."</div>";
        }
        ?>

        
        <form action="" method="post" >
            <input type="hidden" name="submit" value="1" />
            <label for="nom">Votre nom : </label> <input type="text" name="nom" id="nom" required /><br />
            <label for="prenom">Votre pr&eacute;nom : </label> <input type="text" name="prenom" id="prenom" required /><br />
            <label for="mail">Votre email : </label> <input type="email" placeholder="me@example.com" name="mail" id="mail" required /><br />
            <input type="submit" value="Participer au tirage au sort" />
        </form>
        
        <?php
            if($view->insert) {
        ?>
        <script>
            $(document).ready(function() {
                setTimeout('window.location.reload()', 5000);
            });
        </script>
        <?php
            }
        ?>
	</body>
</html>