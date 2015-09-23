<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Generator</title>

        <link href="<?php $view->front('vendor/prettify/default.css',false);?>" rel="stylesheet">

		<script src="<?php $view->front('js/jquery.js');?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
		<script src="<?php $view->front('vendor/prettify/prettify.js',false);?>"></script>
		<script src="<?php $view->front('vendor/prettify/lang-css.js',false);?>"></script>
		<script src="<?php $view->front('vendor/prettify/lang-yaml.js',false);?>"></script>
		<script src="<?php $view->front('vendor/prettify/lang-sql.js',false);?>"></script>

       
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		
		<script>
			$(document).ready(function() {
				prettyPrint();

			});
		</script>

    </head>
    <body>
        
    <div id="master">
        
    <?php $view->extend("menu");