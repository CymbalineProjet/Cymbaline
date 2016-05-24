<?php 
$view->extend('header','');

//cb_debug($view->community()->member()->get('username'));
$membres = $view->variables['classement'];
$equipes = $view->variables['equipes'];
$matchs = $view->variables['matchs'];
$user_classement = $view->service('Prono/Prono/Prono')->getClassementFromSession();

$poules = array(
	1 => "A",
	2 => "B",
	3 => "C",
	4 => "D",
	5 => "E",
	6 => "F",
);

?>

    <!-- //////////////////////////////////////////////////////////////////////////////////////////////  SECTION - WRAPPER CONTENT  //////// -->
    <section id="home">
        <div id="cover"></div>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////  CLASSEMENT  //////// -->
        <ul id="classement">
            <h3>Le top du classement (vous êtes <?php echo cb_order($user_classement); ?> sur <?php echo $membres->countDatas(); ?>)
            <!-- A AJOUTER -->
                <a class="bt_classement" href="<?php $view->link('classement');?>">Le classement complet</a>
            <!-- FIN -->
            </h3>
			
			<?php
			
				$i = 1;
				foreach($membres->getDatas() as $membre) {
				
			?>
					<li>
						<div class="bloc user">
							<div class="cover">
								<img src="<?php $view->front('upload/member/member_'.$membre->id.'.jpg'); ?>" alt="francois">
							</div>
							<div class="info_user">
								<div class="name"><?php echo $membre->username;?></div>
								<div class="points"><?php echo $membre->point;?> points</div>
								<ul class="penalties">
								<?php
									for($p = 1; $p <= 5; $p++) {
									
										if($p > $membre->penalties) {
											echo '<li style="list-style: circle;">&nbsp;</li>';
										} else {
											echo '<li style="list-style: disc;">&nbsp;</li>';
										}
							
									}
								?>
								</ul>
								<span class="position"><?php echo cb_order($i); ?></span>
							</div>
						</div>
					</li>
			<?php
					$i++;
				}
				
				unset($membres);
				unset($i);
			?>
        </ul>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////  PRONOSTICS  //////// -->
        <ul id="pronostics">
            <h3>Vos pronostics des matchs en cours
            <!-- A AJOUTER -->
                <a class="bt_pronostics" href="">Tous vos pronostics</a>
            <!-- FIN -->
            </h3>
			
			<?php
				
				foreach($matchs->getDatas() as $match) {
				
					$date = $view->tool('Date')->_new($match->date)->affiche("full",true);
					
			?>
					<li>
						<div class="bloc prono">
							<div class="cover_team">
								<img src="<?php $view->front('prono/img/pays/'.strtolower($match->equipeDom).'/'.$match->isoDom.'_player.jpg');?>" alt="<?php echo strtolower($match->equipeDom);?>">
							</div>
							<div class="cover_team">
								<img src="<?php $view->front('prono/img/pays/'.strtolower($match->equipeExt).'/'.$match->isoExt.'_player.jpg'); ?>" alt="<?php echo strtolower($match->equipeExt);?>">
							</div>
							<div class="info_prono">
								<div class="team_left">
									<span class="flag">
										<img src="<?php $view->front('prono/img/pays/'.strtolower($match->equipeDom).'/'.$match->isoDom.'_flag.gif');?>" alt="<?php echo $match->equipeDom;?>" />
									</span>
									<span class="team_name"><?php echo $match->equipeDom;?></span>
								</div>
								<form>
									<div class="score">
										<!-- A AJOUTER (class waiting -> quand le prono n'a pas encore été fait) -->
										<input class="scoreA waiting" type="text" value="0" />
										<span class="sep">-</span>
										<input class="scoreB waiting" type="text" value="0" />
									</div>
									<div class="penalty">
										<input type="checkbox" />
										<label>penalty</label>
									</div>
									<button>ENREGISTRER</button>
								</form>
								<div class="team_right">
									<span class="team_name"><?php echo $match->equipeExt;?></span>
									<span class="flag">
										<img src="<?php $view->front('prono/img/pays/'.strtolower($match->equipeExt).'/'.$match->isoExt.'_flag.gif');?>" alt="<?php echo $match->equipeExt;?>" />
									</span>
								</div>
							</div>
							<div class="info_game">Groupe <?php echo $match->poule;?> - <?php echo $date;?></div>
							<hr/>
							<div class="user_prono">
								<img class="roundedImage" src="<?php $view->front('upload/member/member_'.$view->community()->member()->getId().'.jpg');?>" />
								<span class="user_name"><?php echo $view->community()->member()->get('username') ?></span>
							</div>
						</div>
					</li>
			<?php
			
				}
				
				unset($matchs);
			?>
        
        </ul>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////  TEAMS  //////// -->
        <ul id="teams">
            <h3>Les équipes qualifiées
            <!-- A AJOUTER -->
                <a class="bt_equipes" href="<?php $view->link('equipes');?>">Toutes les équipes</a>
            <!-- FIN -->
            </h3>
			<?php
				
				foreach($equipes->getDatas() as $equipe) {
					
			?>
					<li>
						<div class="bloc team">
							<div class="cover">
								<img src="<?php $view->front('prono/img/pays/'.strtolower($equipe->name).'/'.$equipe->iso.'.jpg'); ?>" alt="<?php echo strtolower($equipe->name); ?>">
							</div>
							<div class="info_team">
								<span class="flag">
									<img src="<?php $view->front('prono/img/pays/'.strtolower($equipe->name).'/'.$equipe->iso.'_flag.gif');?>" alt="<?php echo $equipe->name; ?>" />
								</span>
								<span class="name"><?php echo $equipe->name; ?></span>
								<div class="points"><?php echo $equipe->point; ?> points</div>
								<span class="group">Groupe <?php echo $poules[$equipe->poule];?></span>
							</div>
						</div>
					</li>
			<?php
				}
				
				unset($equipes);
			?>
			
        </ul>
        <div id="guide_cover">
            <div id="left_arrow">
                <a href="" title="Vers la gauche">Vers la gauche</a>
            </div>
            <div id="right_arrow">
                <a href="" title="Vers la droite">Vers la droite</a>
            </div>
        </div>
        <footer>
            <p>Copyright 2016 - site privé - réalisé par Thibault Jeannet et François Lestoquoy</p>
        </footer>
    </section>

</body>
<script>
$(document).ready(function() {
    /* Open-close tchat */
    var button = document.getElementById( "tchat_button" );
    var menuClose = false;
    var menuHeight = document.getElementById( "menuLeft" ).offsetHeight;
    var menuList = document.getElementById( "menuLeft" ).getElementsByTagName( "li" );
    $(button).click(function() {
        if(menuClose == false) {
            $(menuList[1]).addClass('isHidden');
            $(menuList[2]).addClass('isHidden');
            $(menuList[3]).addClass('isHidden');
            $(menuList[4]).addClass('isHidden');
            $(menuList[5]).addClass('isHidden');
            $(menuList[6]).addClass('isHidden');
            button.title = "Réduire le tchat";
            menuClose = true;
        } else if(menuClose == true) {
            $(menuList[1]).removeClass('isHidden');
            $(menuList[2]).removeClass('isHidden');
            $(menuList[3]).removeClass('isHidden');
            $(menuList[4]).removeClass('isHidden');
            $(menuList[5]).removeClass('isHidden');
            $(menuList[6]).removeClass('isHidden');
            button.title = "Augmenter le tchat";
            menuClose = false;
        }
    });
    /* Move into Guide Cover */
    var leftArrow = document.getElementById( "left_arrow" );
    var rightArrow = document.getElementById( "right_arrow" );
    var cover = document.getElementById( "guide_cover" );
    var x = 0;
    
    $(rightArrow).hover(function () {
        moveR = window.setInterval(function(){
            x-=6;
            $(cover).css('background-position', x + 'px 0');
        }, 10);
    }, function(){
        window.clearInterval(moveR);
    });
    
    $(leftArrow).hover(function () {
        moveL = window.setInterval(function(){
            x+=6;
            $(cover).css('background-position', x + 'px 0');
        }, 10);
    }, function(){
        window.clearInterval(moveL);
    });
    
});
</script>

</html>