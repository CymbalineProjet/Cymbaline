<?php
$view->extend("header", "prono14 | admin match "); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

if(!is_null($view->variables['retour'])) {
?>
<div class="succes"><?php echo $view->variables['retour']; ?></div>
<?php
} 

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
<a href="<?php $view->front('datetimepicker/jquery.datetimepicker.css'); ?>">test</A>
<?php $view->form['form']->close();?>

<script>
    var equipes = [
      <?php
      foreach($view->variables['equipes'] as $equipe) {
          echo '"'.$equipe->getNom().'",';
      }
      ?>
    ];
    
    var stades = [
      <?php
      foreach($view->variables['stades'] as $stade) {
          echo '"'.$stade->getNom().'",';
      }
      ?>
    ];
    
    $( ".equipe" ).autocomplete({
      source: equipes
    });
    
    $( ".stade" ).autocomplete({
      source: stades
    });
</script>

<?php
$view->extend("admin_footer");