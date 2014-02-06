<?php
$view->extend("head", ""); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

echo "Utilisateur : ".$view->variables['utilisateur']->getUsername(). " (".$view->variables['utilisateur']->getNom().")";

?>
<br />
<a href="./login">Deconnexion</a>
<br/>
<div class="tracker" style="display:none;position: fixed;padding:5px;border:1px solid blue;background:black;color:white;"><?php var_dump($view->variables['utilisateur']); ?></div>

<a href="./login">Deconnexion</a>

<script type="text/javascript" src="./public/js/jquery.js"></script>
<script type="text/javascript" src="./public/js/keypress.js"></script>
<script type="text/javascript" src="./public/js/tracker.js"></script>
<script>
    $(document).ready(function() {
        keypress.combo("shift s", function() {
            tracker('.tracker');
        }); 
    });
</script>