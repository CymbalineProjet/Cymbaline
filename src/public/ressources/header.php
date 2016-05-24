<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Pronos.2016 - Inscription</title>

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,300italic,400,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php $view->front('prono/css/reset.css');?>">
    <link rel="stylesheet" href="<?php $view->front('prono/css/style.css'); ?>">
    <script type="text/javascript" src="<?php $view->front('prono/js/jquery-1.12.0.min.js'); ?>"></script>
    
	<script type="text/javascript" src="<?php $view->front('js/function/view.js'); ?>"></script>
	
	<?php 
	if($view->community()->exists()) {
	
	?>
	<script>
		var memberId = <?php echo $view->community()->member()->getId(); ?>;
	</script>
	
	<script type="text/javascript" src="<?php $view->front('vendor/tchat/jquery.tchat.js'); ?>"></script>
	
	<?php
	}
	?>
	
	
	<style>
		.roundedImage {
			overflow:hidden;
			-webkit-border-radius:50px;
			-moz-border-radius: 50px;
			border-radius: 50px;
			width: 28px; //90
			height: 28px; //90
		}
	</style>
	
	<?php
	if($view->toolbar) {
	
	?>
	
	<script type="text/javascript" src="<?php $view->front('vendor/colorbox/jquery.colorbox.js'); ?>"></script>
	<link rel="stylesheet" href="<?php $view->front('vendor/colorbox/colorbox.css'); ?>">
	
	<script type="text/javascript" src="<?php $view->front('vendor/toolbar/jquery.toolbar.js'); ?>"></script>
	
	<script>
	$(document).ready(function() {
		$(".toolbarButton").colorbox({inline:true, width:"50%"});
		/*$(".toolbarButton").click(function() {
			$.colorbox({href: "<?php echo $view->link('toolbar');?>", width:"100%", height:"100%"});
			console.log('fezf');
		});*/
		
		$(this).keypress(function(e) {
			console.log(e.keyCode);
			if(e.keyCode == 73) {
				$.colorbox({href: "<?php echo $view->link('toolbar');?>", width:"100%", height:"100%"});
			}
		});
	});
	</script>
	<?php
	}
	?>
	
</head>
<body>
<div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
			<p><strong>This content comes from a hidden element on this page.</strong></p>
			<p>The inline option preserves bound JavaScript events and changes, and it puts the content back where it came from when it is closed.</p>
			<p><a id="click" href="#" style='padding:5px; background:#ccc;'>Click me, it will be preserved!</a></p>
			
			<p><strong>If you try to open a new Colorbox while it is already open, it will update itself with the new content.</strong></p>
			<p>Updating Content Example:<br />
			<a class="ajax" href="../content/ajax.html">Click here to load new content</a></p>
			</div>
		</div>
    <header>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////  FIRST LINE - HEADER  ////////// -->
        <img class="logo" src="<?php $view->front('prono/img/logo.jpg'); ?>" alt="Pronos.2016" />
        <h1>PRONOS.2016</h1>
        <ul id="nav_second">
            <li class="accueil">
                <a href="<?php $view->link('home');?>" title="">
                    <span>Accueil</span>
                </a>
            </li>
            <li class="classement">
                <a href="<?php $view->link('classement');?>" title="">
                    <span>Classement</span>
                </a>
            </li>
            <li class="pronostics">
                <a href="#" title="">
                    <span>Pronostics</span>
                </a>
            </li>
            <li class="matchs">
                <a href="#" title="">
                    <span>Les matchs</span>
                </a>
            </li>
            <li class="equipes">
                <a href="<?php $view->link('equipes');?>" title="">
                    <span>Les équipes</span>
                </a>
            </li>
            <li class="calendrier">
                <a href="#" title="">
                    <span>Calendrier</span>
                </a>
            </li>
        </ul>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////  SECOND LINE - HEADER  ////////// -->
        <div id="title">
            <h2>COUPE D’EUROPE DE FOOTBALL 2016 - FRANCE</h2>
            <div id="connexion">
                <span class="user_name"><?php echo $view->community()->member()->get('username') ?></span>
                <img class="roundedImage inline" href="#inline_content" width="28" heigth="28" src="<?php $view->front('upload/member/member_'.$view->community()->member()->getId().'.jpg'); ?>" />
                <ul id="connexion_list">
                    <li id="button_connexion">
                        <a href="<?php $view->link('index');?>" title="déconnexion">
                            <span>Déconnexion</span>
                        </a>
                    </li>
                    <li class="compte">
                        <a href="#" title="">
                            <span>mon compte</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- //////////////////////////////////////////////////////////////////////////////////////////////  MAIN MENU - NAVIGATION  //////// -->
    <nav>
        <ul id="menuLeft">
            <li class="accueil">
                <a href="<?php $view->link('home');?>" title="">
                    <span>Accueil</span>
                </a>
            </li>
            <li class="classement">
                <a href="<?php $view->link('classement');?>" title="">
                    <span>Classement</span>
                </a>
            </li>
            <li class="pronostics">
                <a href="#" title="">
                    <span>Pronostics</span>
                </a>
            </li>
            <li class="matchs">
                <a href="#" title="">
                    <span>Les matchs</span>
                </a>
            </li>
            <li class="equipes">
                <a href="<?php $view->link('equipes');?>" title="">
                    <span>Les équipes</span>
                </a>
            </li>
            <li class="calendrier">
                <a href="#" title="">
                    <span>Calendrier</span>
                </a>
            </li>
            <li class="compte">
                <a href="#" title="">
                    <span>Mon compte</span>
                </a>
            </li>
        </ul>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////  ONLINE TCHAT  //////// -->
        <div id="tchat">
            <form id="tchatForm" method="post" action="<?php $view->link('tchat_new'); ?>" onSubmit="return false;">
                <a title="Augmenter le tchat" id="tchat_button">
                    <img class="roundedImage " width="28" heigth="28" src="<?php $view->front('upload/member/member_'.$view->community()->member()->getId().'.jpg'); ?>" />
                </a>
                <input id="myMessage" type="text" maxlength="120" value="Ecrire un message ..." onblur="if (this.value == '') {this.value = 'Ecrire un message ...';}" onfocus="if (this.value == 'Ecrire un message ...') {this.value = '';}" />
            </form>
            <ul id="tchatList">
				
                <!--li>
                    <label>
                        <img src="img/users/francois_pic.png" />
                    </label>
                    <div>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.</div>
                </li-->
                
            </ul>
        </div>
    </nav>