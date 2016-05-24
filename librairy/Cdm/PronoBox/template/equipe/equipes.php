<?php
$view->extend("head", "prono14 | equipes"); 

?>
<div class="main-container">

        <?php $view->extend("sidebar"); ?>

        <div class="main">
            <header>
                <h1>les &eacute;quipes</h1>
                <h2>DATE ACTUELLE</h2>
                <h3>LES ÉQUIPES QUALIFIÉES PAR GROUPES</h3>
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
                        foreach($view->variables['equipes'] as $equipe) {
                            
                        ?>
                        
                        <h3 class="groupe"><?php echo $equipe['poule']->getNom(); ?></h3>
                        <ul class="groupe">
                            <?php
                            foreach($equipe['equipes'] as $e) {
                                
                            ?>
                            <li class="equipe">
                                <div class="head">
                                    <img src="<?php $view->front('img/flags/'.strtolower($e->getSlug()).'.png'); ?>" alt="<?php echo $e->getNom(); ?>" />
                                    <span class="name_team"><?php echo strtoupper($e->getNom()); ?></span>
                                </div>
                                <div class="picture" style="-webkit-backgournd-size:cover;background-size:cover;background-color:white;background:url(<?php $view->front('img/embleme/'.strtolower($e->getSlug()).'.jpg'); ?>) no-repeat center center;"></div>
                            </li>
                            <?php
                            }
                            ?>                            
                        </ul>
                        
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>


        </div>
        <!-- #main -->

    </div>
    <!-- #main-container -->

    <?php $view->extend("bottombar",null,array("active" => "equipes")); ?>
    <script type="text/javascript" language="javascript">
        function resize(event) {
            var content = $('.overview').width();
            var change = $('li.equipe').width((content/4)-12);
        };
        window.onresize = resize;
    </script>
    <script type="text/javascript" language="javascript">
        $(document).ready(resize);
    </script>
</body>

</html>