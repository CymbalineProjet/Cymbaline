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
								<h3>Forms</h3>
							</div>
							<div class="module-body">

								<div class="control-group">
									<table width="90%"S>
										<tr>
											<th>item</th>
											<th>show</th>
											<th>new</th>
											<th>edit</th>
											<th>delete</th>
										</tr>
										
										
									<?php
									foreach($view->variables['items'] as $item) {
										echo "<tr>
												<td>$item</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											  </tr>";
									}
									?>
									</table>
								</div>
							</div>
						</div>

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php
$view->extend("administration_footer", "");