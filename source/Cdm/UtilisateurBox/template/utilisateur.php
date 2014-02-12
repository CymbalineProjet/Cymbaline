<?php
$view->extend("head", ""); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

var_dump($view->variables['utilisateur']);

?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        alert('test');
    });
</script>
