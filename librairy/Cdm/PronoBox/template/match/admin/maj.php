<?php
$view->extend("header", "prono14 | admin matchs maj"); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...
$match = $view->variables['match'];

echo "<h2>".$match->dom." ".$match->ext."</h2>";

$view->form['form']->open();

foreach($view->form['form']->getFields() as $attr => $field) {
    $view->form['form']->getLabel($attr);
    echo "$field<br />";
}

?>

<input type="submit" value="Editer" />

<?php $view->form['form']->close();

$view->extend("admin_footer");