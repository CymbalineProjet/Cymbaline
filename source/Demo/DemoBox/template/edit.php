<?php
$view->extend("header", "edit item");

echo "<h1>Edit a new item</h1>";

$view->form['form']->open();

foreach($view->form['form']->getFields() as $attr => $field) {
    $view->form['form']->getLabel($attr);
    if(!is_array($field)) {
        echo "$field<br />";
    } else {
        foreach($field as $f) {
            echo "$f&nbsp;&nbsp;&nbsp;";
        } 
        echo "<br />";
    }
}

echo "<input type='submit' value='Editer' />";

$view->form['form']->close();  

echo "<p><a href='".$view->link('test_index')."'>Home item</a></p>";

$view->extend("footer");