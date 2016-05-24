<?php
$view->extend("head", "prono14 | resultat"); 

?>
<div class="main-container">

        <?php $view->extend("sidebar"); ?>

        <div class="main">
            <header>
                <h1>LES RÉSULTATS DES MATCHS</h1>
                <h2>ENCORE <?php echo $view->variables['restant']; ?> MATCHS AVANT LA FIN DES QUALIFICATIONS </h2>
                <h4>VOUS AVEZ 0 PRONOS PARFAITS, 0 SIMPLES, 0 MAUVAIS</h4>
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
                        <div class="result_content">
                            <div class="result_bloc result_head">RÉSULTATS DES MATCHS</div>
                            <div class="sep">&nbsp;</div>
                            <div class="result_bloc result_head">VOS PRONOSTIQUES</div>
                        </div>
                        <?php
                        for($i=1;$i<=8;$i++) {
                            $blocs = array();
                            foreach($view->variables['resultats'] as $resultat) {
                                if($resultat->poule->getId() == $i) {
                                    $blocs[] = $resultat;
                                    $poule = $resultat->poule->getNom();
                                }
                            }
                        ?>
                        
                        <div class="date_result first"><?php echo $poule; ?></div>
                        <?php
                        foreach($blocs as $bloc) {
                            
                        ?>
                        <div class="result_content">
                            <div class="result_bloc" >
                                <p class="flags">
                                    <img src="<?php $view->front('img/flags/'.strtolower($bloc->slugdom).'.png'); ?>" alt="<?php echo $bloc->equipedom; ?>">
                                </p>
                                <p class="team_result1"><?php echo strtoupper($bloc->equipedom); ?></p>
                                <p class="score_result1"><?php echo ($bloc->joue) ? $bloc->scoredom : '-'; ?></p>
                                <p class="score_result2"><?php echo ($bloc->joue) ? $bloc->scoreext : '-'; ?></p>
                                <p class="team_result2"><?php echo strtoupper($bloc->equipeext); ?></p>
                                <p class="flags">
                                    <img src="<?php $view->front('img/flags/'.strtolower($bloc->slugext).'.png'); ?>" alt="<?php echo $bloc->equipeext; ?>">
                                </p>
                            </div>
                            <div class="sep">&nbsp;</div>
                            <div class="result_bloc">
                            <p class="flags">
                                    <img src="<?php $view->front('img/flags/'.strtolower($bloc->slugdom).'.png'); ?>" alt="<?php echo $bloc->equipedom; ?>">
                                </p>
                                <p class="team_result1"><?php echo strtoupper($bloc->equipedom); ?></p>
                                <p class="score_result1"><?php echo ($bloc->pronovalide) ? $bloc->pronodom : '-'; ?></p>
                                <p class="score_result2"><?php echo ($bloc->pronovalide) ? $bloc->pronoext : '-'; ?></p>
                                <p class="team_result2"><?php echo strtoupper($bloc->equipeext); ?></p>
                                <p class="flags2">
                                    <img src="<?php $view->front('img/flags/'.strtolower($bloc->slugext).'.png'); ?>" alt="<?php echo $bloc->equipeext; ?>">
                                </p>
                            </div>
                        </div>
                        <?php
                          }
                          
                          unset($blocs);
                        }
                        ?>
                        
                        
                    </div>
                </div>
            </div>


        </div>
        <!-- #main -->

    </div>
    <!-- #main-container -->
    
    <?php $view->extend("bottombar",null,array("active" => "resultats")); ?>
     <script>
        function resize(event) {
            var content = $('.result_content').width();
            var change = $('.result_bloc').width((content/2)-20);
        };
        window.onresize = resize;
        
        $(document).ready(resize);
    </script>
    
</body>

</html>