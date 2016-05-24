<?php
$view->extend("head", "prono14 | classement"); 

?>
<div class="main-container">

        <?php $view->extend("sidebar"); ?>

        <div class="main">
            <header>
                <h1>LE CLASSEMENT</h1>
                <h2>DATE ACTUELLE</h2>
                <h3>VOUS AVEZ PRONOSTIQUÉ TOUS LES MATCHS DU JOUR</h3>
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
                        <?php
                        $i = 1;
                        foreach($view->variables['utilisateurs'] as $utilisateur) {                           
                            ?>
                            <ul class="joueur">
                            <li class=" position"><?php echo $i ?>e</li>
                            <li class="pic-joueur" style="background:url(<?php $view->front("img/upload/avatar/".$utilisateur->getUsername().".jpg"); ?>)"></li>
                            <li class=" name"><?php echo $utilisateur->getPrenom()." \"".$utilisateur->getUsername()."\" ".$utilisateur->getNom()?></li>
                            <li class=" points"><?php echo $utilisateur->getPoint(); ?>points</li>
                            <li class=" score">0 parfaits - 0 simples - 0 mauvais</li>
                        </ul>
                            <?php 
                            $i++;
                        } ?>
                    </div>
                </div>
            </div>


        </div>
        <!-- #main -->

    </div>
    <!-- #main-container -->
    
    <?php $view->extend("bottombar",null,array("active" => "classement")); ?>
    <script type="text/javascript" language="javascript">
        function resize(event) {
            var content = $('.overview').width();
            var change = ($('li.position').width()) + ($('li.pic_joueur').width()) + ($('li.points').width()) + ($('li.score').width());
            console.log(change);
            var nameSize = $('li.name').width(content - (change + 220));
        };
        window.onresize = resize;
    </script>
    <script type="text/javascript" language="javascript">
        $(document).ready(resize);
    </script>
</body>

</html>