<?php
$view->extend("head", ""); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

$view->form['form']->open();
?>

<?php $view->form['form']->getLabel('nom'); ?>
<?php $view->form['form']->getField('nom'); ?>

<?php $view->form['form']->getLabel('prenom'); ?>
<?php $view->form['form']->getField('prenom'); ?>

<?php $view->form['form']->getLabel('username'); ?>
<?php $view->form['form']->getField('username'); ?>

<input type="submit" value="Enregistrer" />

<?php $view->form['form']->close(); ?>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        alert('edit');
    });
</script>
