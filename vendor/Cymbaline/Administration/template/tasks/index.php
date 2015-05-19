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

						<div class="module message">
							<div class="module-head">
								<h3>Task Management Tool</h3>
							</div>
							<div class="module-option clearfix">
								<div class="pull-left">
									Filter : &nbsp;
									<div class="btn-group">
										<button class="btn">All</button>
										<button class="btn dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="#">All</a></li>
											<li><a href="#">In Progress</a></li>
											<li><a href="#">Done</a></li>
											<li class="divider"></li>
											<li><a href="<?php echo $view->link("tasks_new"); ?>">New task</a></li>
											<li><a href="#">Overdue Task</a></li>
										</ul>
									</div>
								</div>
								<div class="pull-right">
									<a href="<?php echo $view->link("tasks_new"); ?>" class="btn btn-primary">Create Task</a>
								</div>
							</div>
							<div class="module-body table">								

								<table class="table table-message">
									<tbody>
										<tr class="heading">
											<td class="cell-icon"></td>
											<td class="cell-title">Task</td>
											<td class="cell-status hidden-phone hidden-tablet">Status</td>
											<td class="cell-time align-right">Due Date</td>
										</tr>
										<?php foreach ($view->variables['tasks'] as $task) {
											$date = $view->tool('Date')->_new($task->getDate())->affiche('numeric');// new \DateTime($task->getDate());

											if(!$task->getFlag()) { 
										 ?>

											<tr class="task" rel="<?php echo $task->getId(); ?>">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div><?php echo $task->getContent(); ?></div></td>
											<td class="cell-status hidden-phone hidden-tablet"><b class="due">Missed</b></td>
											<td class="cell-time align-right"><?php echo $date; ?></td>
											</tr>

										<?php 
											} else { ?>

											<tr class="task resolved" rel="<?php echo $task->getId(); ?>">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div><?php echo $task->getContent(); ?></div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right"><?php echo $date; ?></td>
											</tr>

											<?php
											}
										}
										?>
										
									</tbody>
								</table>

                                <div id="dialog-confirm" title="Que faire ?" style="display: none;">
                                    <p>Choisissez l'action suviante :</p>
                                </div>


							</div>
							<div class="module-foot">
							</div>


						</div>

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
    $(document).ready(function() {



        $('.task').click(function(e) {
            var url;
            var id = $(this).attr('rel');
            if(!$(this).hasClass('resolved')) {
                e.preventDefault();
                $("#dialog-confirm").dialog({
                    resizable: false,
                    height: 150,
                    modal: false,
                    buttons: {
                        "Done": function () {
                            url = view.link('tasks_update',id);
                            view.execute();
                            $(this).dialog("close");
                        },
                        "Delete": function () {
                            url = view.link('tasks_delete',id);
                            view.execute();
                            $(this).dialog("close");
                        },
                        Cancel: function () {
                            $(this).dialog("close");
                        }
                    }
                });
            } else {
                e.preventDefault();
                $("#dialog-confirm").dialog({
                    resizable: false,
                    height: 150,
                    modal: false,
                    buttons: {
                        "Delete": function () {
                            url = view.link('tasks_delete',id);
                            view.execute();
                            $(this).dialog("close");
                        },
                        Cancel: function () {
                            $(this).dialog("close");
                        }
                    }
                });
            }
        });
    });
</script>

<?php
$view->extend("administration_footer", "");