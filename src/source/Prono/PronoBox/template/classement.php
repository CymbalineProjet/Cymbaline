<?php 
$view->extend('header','');

$membres = $view->variables['classement'];
$user_classement = $view->service('Prono/Prono/Prono')->getClassementFromSession();

?>

    <!-- //////////////////////////////////////////////////////////////////////////////////////////////  SECTION - WRAPPER CONTENT  //////// -->
    <section>
        <div id="cover"></div>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////  CLASSEMENT  //////// -->
        <ul id="classement">
            <h3>Le classement (vous &ecirc;tes <?php echo cb_order($user_classement); ?> sur <?php echo $membres->countDatas(); ?>)
            <!-- A AJOUTER -->
                <a class="bt_classement" href="">Le classement complet</a>
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