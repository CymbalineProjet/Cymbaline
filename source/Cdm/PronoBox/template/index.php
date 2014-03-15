<?php
$view->extend("head", "prono14 | Access"); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

?>

<form action="/login" method="post" name="form_access" id="form_access">
    
    <label for="access">Mot de passe :</label>
    <input type="password" name="access" id="access" required />
    <input type="submit" value="Entrer" id="submit" />
</form>

<script>
    $(document).ready(function() {
        var code = "6273e4f677f5bc98b11c05978a4ac1e7";
        $("#form_access").submit(function() {
           if(md5($("#access").val()) == code) {
               return true;
           } else {
               alert("Access denied: incorrect password");
               return false;
           }
        });
    });
</script>


