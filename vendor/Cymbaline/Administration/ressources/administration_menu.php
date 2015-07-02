<div class="span3">
	<div class="sidebar">

		<ul class="widget widget-menu unstyled">
			<li>
				<a class="collapsed" data-toggle="collapse" href="#togglePages">
					<i class="menu-icon icon-cog"></i>
					<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
					Generator
				</a>
				<ul id="togglePages" class="collapse unstyled">
					<li>
						<a href="<?php echo $view->link('generator_parameters'); ?>">
							<i class="icon-edit"></i>
							Edit parameters
						</a>
					</li>
					<li>
						<a href="<?php echo $view->link('generator_add_zone'); ?>">
							<i class="icon-plus-sign"></i>
							Add zone
						</a>
					</li>
					<li>
						<a href="<?php echo $view->link('generator_add_box'); ?>">
							<i class="icon-plus-sign"></i>
							Add box
						</a>
					</li>
					<li>
						<a href="<?php echo $view->link('generator_add_item'); ?>">
							<i class="icon-plus-sign"></i>
							Add item
						</a>
					</li>
				</ul>
			</li>
			<?php 
			 if($view->getParam()->tasks->used) { ?>
			<li>
				<a href="<?php echo $view->link('tasks'); ?>">
					<i class="menu-icon icon-tasks"></i>
					Tasks
					<b class="label orange pull-right" id="nbreTasks">19</b>
				</a>
			</li>
			<?php } ?>
			<li>
				<a href="<?php echo $view->link('generator_route'); ?>">
					<i class="menu-icon icon-road"></i>
					Routes
				</a>
			</li>
			
			<li>
				<a href="<?php echo $view->link('generator_code'); ?>">
					<i class="menu-icon icon-file"></i>
					Codex
				</a>
			</li>

			
		</ul>

		<ul class="widget widget-menu unstyled">
			<li class="active">
				<a href="index.html">
					<i class="menu-icon icon-dashboard"></i>
					Dashboard
				</a>
			</li>
			<li>
				<a href="activity.html">
					<i class="menu-icon icon-bullhorn"></i>
					News Feed
				</a>
			</li>
			<li>
				<a href="message.html">
					<i class="menu-icon icon-inbox"></i>
					Inbox
					<b class="label green pull-right">11</b>
				</a>
			</li>
			
			<li>
				<a href="task.html">
					<i class="menu-icon icon-tasks"></i>
					Tasks
					<b class="label orange pull-right">19</b>
				</a>
			</li>
		</ul><!--/.widget-nav-->

		<ul class="widget widget-menu unstyled">
            <li><a href="ui-button-icon.html"><i class="menu-icon icon-bold"></i> Buttons </a></li>
            <li><a href="ui-typography.html"><i class="menu-icon icon-book"></i>Typography </a></li>
            <li><a href="form.html"><i class="menu-icon icon-paste"></i>Forms </a></li>
            <li><a href="table.html"><i class="menu-icon icon-table"></i>Tables </a></li>
            <li><a href="charts.html"><i class="menu-icon icon-bar-chart"></i>Charts </a></li>
        </ul><!--/.widget-nav-->

		<ul class="widget widget-menu unstyled">
			<li>
				<a class="collapsed" data-toggle="collapse" href="#togglePages">
					<i class="menu-icon icon-cog"></i>
					<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
					More Pages
				</a>
				<ul id="togglePages" class="collapse unstyled">
					<li>
						<a href="other-login.html">
							<i class="icon-inbox"></i>
							Login
						</a>
					</li>
					<li>
						<a href="other-user-profile.html">
							<i class="icon-inbox"></i>
							Profile
						</a>
					</li>
					<li>
						<a href="other-user-listing.html">
							<i class="icon-inbox"></i>
							All Users
						</a>
					</li>
				</ul>
			</li>
			
			<li>
				<a href="#">
					<i class="menu-icon icon-signout"></i>
					Logout
				</a>
			</li>
		</ul>

	</div><!--/.sidebar-->
</div><!--/.span3-->