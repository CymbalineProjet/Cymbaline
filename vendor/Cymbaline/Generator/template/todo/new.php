<?php
$view->extend("gen_header", "Generator | todo"); //toujours etendre le header

?>
<h3>ADD TODO</h3>

<?php
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

?>

<input type="submit" value="Enregistrer" />

<?php $view->form['form']->close();        
        
$view->extend("gen_footer"); 

