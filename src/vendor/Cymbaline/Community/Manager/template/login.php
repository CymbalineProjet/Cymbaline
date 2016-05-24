<?php
$view->extend('header',false);


$labels = $view->form['form']->getLabels();
$view->form['form']->open(); 


?>
<?php foreach ($view->form['form']->getFields() as $i => $field) { 


?>
                                    
		<div class="control-group">
			<label class="control-label" for="basicinput"><?php echo $labels[$i]; ?></label>
			<div class="controls">
				<?php 
				if(is_array($field)) {
					foreach ($field as $key => $value) {
						echo $value;
					}
				} else {
					echo $field; 
				}
				?>
				<!--input type="text" id="basicinput" placeholder="Type something here..." class="span8">
				<span class="help-inline">Minimum 5 Characters</span-->
			</div>
		</div>

<?php }

$view->form['form']->addSubmit(); 
$view->form['form']->open(); 
?>