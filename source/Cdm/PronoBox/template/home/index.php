<?php
$view->extend("head", "prono14 | vos pronos"); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...


//var_dump($view->variables['stades']);
?>
<div class="main-container">

        <?php $view->extend("sidebar"); ?>

        <div class="main">
            <header>
                <h1>BIENVENUE <?php echo strtoupper($view->session()->get('user')->getUsername()); ?> !</h1>
                <h2>BIENTÔT LA COUPE DU MONDE</h2>
                <h3>DÉBUT LE 12 JUIN 2014</h3>
            </header>
            <div id="scrollbar1">
                <div class="scrollbar">
                    <div class="track">
                        <div class="thumb">
                            <div class="end"></div>
                        </div>
                    </div>
                </div>
                <div class="viewport">
                    <div class="overview">
                        <div class="countdown">
                            <h1>TEMPS RESTANT :</h1>
                            <ul class="label">
                                <li>Jours</li>
                                <li>Heures</li>
                                <li>Minutes</li>
                                <li>Secondes</li>
                            </ul>
                            <div class="dw_clock"></div>
                            <h1>EN ATTENDANT VOUS POUVEZ COMMENCER VOS PRONOSTIQUES :</h1>
                            <a href="<?php echo $view->link('pronos'); ?>" style="text-decoration: none;">
                            <div class="bloc button">
                                Commencer vos<br /><span class="arrow">→ &nbsp;</span> pronostiques <span class="arrow">&nbsp; ←</span>
                            </div>
                            </a>
                            <!--a href="">
                            <div class="bloc button">
                                Voir vos<br /><span class="arrow">→ &nbsp;</span> pronostiques <span class="arrow">&nbsp; ←</span>
                            </div>
                            </a-->
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- #main -->

    </div>
    <!-- #main-container -->

    <?php $view->extend("bottombar",null,array("active" => "accueil")); ?>

    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')
    </script>
    
    <script src="<?php $view->front('vendor/flipclock/flipclock.js'); ?>"></script>
    <script>
        <?php
        echo "var now = ".strtotime("now").";";
        echo "var debut = ".strtotime("14-06-12 18:00:00").";";
        ?>

		$(document).ready(function() {
            var time = debut - now;
            
			var clock = $('.dw_clock').FlipClock(time, {
		        clockFace: 'DailyCounter',
		        countdown: true
		        
		    });

		});
	
        
    </script>

    <!--
        // GOOGLE ANALYTICS
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
-->
</body>

</html>