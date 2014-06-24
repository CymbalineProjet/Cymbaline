<?php
$view->extend("header", ""); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

$view->form['form']->open();

foreach($view->form['form']->getFields() as $attr => $field) {
    $view->form['form']->getLabel($attr);
    echo "$field<br />";
}

?>

<input type="submit" value="Enregistrer" />

<?php $view->form['form']->close();

$view->extend("admin_footer");