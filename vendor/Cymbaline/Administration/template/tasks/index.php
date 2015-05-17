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
										<tr class="task">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"><b class="due">Missed</b></td>
											<td class="cell-time align-right">Just Now</td>
										</tr>
										<tr class="task">
											<td class="cell-icon"><i class="icon-checker"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"><b class="due">Missed</b></td>
											<td class="cell-time align-right">Just Now</td>
										</tr>
										<tr class="task">
											<td class="cell-icon"><i class="icon-checker"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"><b class="due">Missed</b></td>
											<td class="cell-time align-right">Yesterday</td>
										</tr>
										<tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
										<tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
                                        <tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
                                        <tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
                                        <tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
                                        <tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
                                        <tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
                                        <tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
                                        <tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
                                        <tr class="task resolved">
											<td class="cell-icon"><i class="icon-checker high"></i></td>
											<td class="cell-title"><div>Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div></td>
											<td class="cell-status hidden-phone hidden-tablet"></td>
											<td class="cell-time align-right">15 July 2014</td>
										</tr>
									</tbody>
								</table>


							</div>
							<div class="module-foot">
							</div>
						</div>

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php
$view->extend("administration_footer", "");