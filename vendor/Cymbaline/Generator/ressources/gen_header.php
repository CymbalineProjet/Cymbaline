<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Generator</title>
        
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        
        <link href="<?php $view->front('vendor/prettify/default.css');?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php $view->front('vendor/dynatable/jquery.dynatable.css');?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php $view->front('vendor/potato/jquery.ui.potato.menu.css');?>" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        
		<script src="<?php $view->front('js/jquery.js');?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
		<script src="<?php $view->front('vendor/prettify/prettify.js');?>"></script>
		<script src="<?php $view->front('vendor/prettify/lang-css.js');?>"></script>
		<script src="<?php $view->front('vendor/prettify/lang-yaml.js');?>"></script>
		<script src="<?php $view->front('vendor/prettify/lang-sql.js');?>"></script>
        <script src="<?php $view->front('vendor/dynatable/jquery.dynatable.js');?>"></script>
        <script src="<?php $view->front('vendor/potato/jquery.ui.potato.menu.js');?>"></script>
       
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		
		<script>
			$(document).ready(function() {
				prettyPrint();
                $('#my-table').dynatable();
                $('#menu1').ptMenu();
			});
		</script>
        
        <style>
            body {
                margin: 0;
                font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
                font-size: 13px;
                line-height: 20px;
                color: #333333;
                background-color: #f8f8f8;
                padding: 10px;
            }
            
            h3 {
                margin: 0;
                font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
                font-weight: bold;
                color: #538192;
                text-rendering: optimizelegibility;
                font-size: 18px;
                margin-bottom: .5em;
                line-height: 30px;
            }
            
            #master {
                margin:auto;
                width:940px;
                padding-top:10px;
                padding-bottom:10px;
            }
            
            #contents {
                white-space: nowrap;
            }
            #menu1 {
                white-space: nowrap;
                margin-bottom: 30px;
            }
            #menu2 {
                clear: both;
                width: 140px;
                margin-top: 10px;
            }
            .potato-menu-item {
                width:188px;
                font-size:12px;
                font-weight: bold;
                background:#538192;
            }
            .potato-menu-group {
                z-index:1000;
            }
            .potato-menu-item a {
                padding:10px 20px 10px 12px;
                color: #fff;
            }
            .potato-menu-hover {
                background-color: #83AABE;
            }
            .potato-menu-has-vertical > a {
                background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAENSURBVDjLpZM/SwNREMTnxBRpFYmctaKCfwrBSCrRLuL3iEW6+EEUG8XvIVjYWNgJdhFjIXamv3s7u/ssrtO7hFy2fcOPmd03SYwR88xi1cPgpRdjjDB1mBquju+TMt1CFcDd0V7q4GilAwpnd2A0qCvcHRSdHUBqAYgOyaUGIBQAc4fkNSJIIGgGj4ZQx4EEAY3waPUiSC5FhLoOQkbQCJvioPQfnN2ctpuNJugKNUWYsMR/gO71yYPk8tRaboGmoCvS1RQ7/c1sq7f+OBUQcjkPGb9+xmOoF6ckCQb9pmj3rz6pKtPB5e5rmq7tmxk+hqO34e1or0yXTGrj9sXGs1Ib73efh1WaZN46/wI8JLfHaN24FwAAAABJRU5ErkJggg==) right no-repeat;
            }
            .potato-menu-has-horizontal > a {
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAADvSURBVDjLY/z//z8DJYCJgUIwxAwImOWx22uSExvZBvz68cvm5/dfV5HFGEGxUHoiExwVf//8Zfjz+w/D719/GH79/A3UAMK/GH4CMYiWFJJk+PXrN8PN27cunWq/oA/SwwIzyUrYluHvP6AB//7A8e+/f4H4N8Pvf0D8Fyb2h+HLl696WllqJ69Nu2XOArMZpBCuGajoN1jxbwT9FyH36/dvkCt/w10Acvb+h3uxOhvoZzCbi4OLQVJSiuH1q9cMt2/cvXB7zj0beBgQAwwKtS2AFuwH2vwIqFmd5Fi40H/1BFDzQaBrdTFiYYTnBQAI58A33Wys0AAAAABJRU5ErkJggg==) right no-repeat;
            }
            .potato-menu-item ul {
                /*border-top:2px solid #538192;
                border-left:2px solid #538192;*/
            }

            
        </style>
        
        
    </head>
    <body>
        
    <div id="master">
        
    <?php $view->extend("gen_menu"); 