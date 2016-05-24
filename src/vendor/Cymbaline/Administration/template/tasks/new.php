<?php
$view->extend("administration_header", "Administration");
?>
<div class="wrapper">
		<div class="container">
			<div class="row">

				<?php
				$view->extend("administration_menu");
				?>

				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Add new task</h3>
							</div>

							<div class="module-body">	
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
							        echo "<br /><br />";
							    }
							}

							echo "<input type='submit' value='Enregistrer' class='btn' />";

							$view->form['form']->close();  

							?>
							</div>
						</div>

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php
$view->extend("administration_footer", "");