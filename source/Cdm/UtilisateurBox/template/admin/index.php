<?php
$view->extend("head", "prono14 | admin "); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...


?>

<table cellspacing="0" cellpadding="0" style="padding:2px;">
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

<?php
foreach($view->variables['utilisateurs'] as $utilisateur) {
    echo "<tr>"
    . "<td>".$utilisateur->getId()."</td>"
    . "<td>".$utilisateur->getUsername()."</td>"
    . "<td>".$utilisateur->getNom()."</td>"
    . "<td>".$utilisateur->getPrenom()."</td>"
    . "<td>".$utilisateur->getMail()."</td>"
    . "<td>Action</td>"
    . "</tr>";
            
}
?>
</table>