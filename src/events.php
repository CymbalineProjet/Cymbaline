<?php
session_start();
var_dump($_SESSION);
$_SESSION['plop'] = "vdsvdvsdv";
$_SESSION['user'] = session_id();
var_dump($_SESSION);
?>

<form action="/plop.php" method="post">
<input type="hidden" name="plop" value="plop" />
<input type="submit" value="ok">
</form>