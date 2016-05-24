<?php 
$view->extend('header','');

$equipes = $view->variables['equipes'];

?>

    <!-- //////////////////////////////////////////////////////////////////////////////////////////////  SECTION - WRAPPER CONTENT  //////// -->
    <section>
        <div id="cover"></div>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////  CLASSEMENT  //////// -->
        <ul id="classement">
            <h3>Les équipes qualifiées
            <!-- A AJOUTER -->
                <a class="bt_equipes" href="">Toutes les équipes</a>
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
									<img height="20" src="<?php $view->front('prono/img/pays/'.strtolower($equipe->name).'/'.$equipe->iso.'_flag.gif');?>" alt="<?php echo $equipe->name; ?>" />
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
            button.title = "R�duire le tchat";
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