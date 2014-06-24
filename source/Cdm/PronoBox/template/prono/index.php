<?php
$view->extend("head", "prono14 | vos pronos"); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...


//var_dump($view->variables['stades']);
?>
<div class="main-container">

        <?php $view->extend("sidebar"); ?>

        <div class="main">
            <header>
                <h1>vos pronostiques</h1>
                <h2>VOUS AVEZ PRONOSTIQUÉ <?php echo $view->variables['nombreprono']; ?> sur 48 MATCHS</h2>
                <ul class="match_date">
                    <li><a href="#j12" title="jeudi 12">jeu.<span>12</span></a></li>
                    <li><a href="#j13" title="vendredi 13">ven.<span>13</span></a></li>
                    <li><a href="#j14" title="samedi 14">sam.<span>14</span></a></li>
                    <li><a href="#j15" title="dimanche 15">dim.<span>15</span></a></li>
                    <li><a href="#j16" title="lundi 16">lun.<span>16</span></a></li>
                    <li><a href="#j17" title="mardi 17">mar.<span>17</span></a></li>
                    <li><a href="#j18" title="mercredi 18">mer.<span>18</span></a></li>
                    <li><a href="#j19" title="jeudi 19">jeu.<span>19</span></a></li>
                    <li><a href="#j20" title="vendredi 20">ven.<span>20</span></a></li>
                    <li><a href="#j21" title="samedi 21">sam.<span>21</span></a></li>
                    <li><a href="#j22" title="dimanche 22">dim.<span>22</span></a></li>
                    <li><a href="#j23" title="lundi 23">lun.<span>23</span></a></li>
                    <li><a href="#j24" title="mardi 24">mar.<span>24</span></a></li>
                    <li><a href="#j25" title="mercredi 25">mer.<span>25</span></a></li>
                    <li><a href="#j26" title="jeudi 26">jeu.<span>26</span></a></li>
                </ul>
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
                        
                        $datetime = new \core\component\tools\Date("2014-06-12 22:00:00");
                        echo "<h1 id='j12' style='margin-bottom:10px;'>".$datetime->affiche()."</h1>";
                        echo "<div style='clear:both;'></div>";
                        
                        foreach($view->variables['blocs'] as $bloc) {
                            
                        $date = new \core\component\tools\Date($bloc->heurematch);
                        $d = $datetime;
                        
                        if($d->format("Ymd") != $date->format("Ymd")) {
                            echo "<div style='clear:both;'></div>";
                            echo "<h1 id='j".$date->format('d')."' style='margin-bottom:10px;'>".$date->affiche()."</h1>";
                            echo "<div style='clear:both;'></div>";
                            $datetime = $date;
                        } 
                        
                        
                        ?>
                        
                            <!-- team 01 -->
                            <div class="bloc team">
                                <div class="team_head">
                                    <div class="flag_team_1">
                                        <img src="public/img/flags/<?php echo strtolower($bloc->slugdom); ?>.png" alt="<?php echo $bloc->equipedom; ?>">
                                    </div>
                                    <div class="team_title">
                                        <div class="names">
                                            <span class="name_team_1"><?php echo strtoupper($bloc->equipedom); ?></span>
                                            <em>-</em>
                                            <span class="name_team_2"><?php echo strtoupper($bloc->equipeext); ?></span>
                                        </div>
                                        <div class="stade"><?php echo $bloc->nomstade; ?> (<?php echo $bloc->capacitestade; ?> places) - <?php echo substr(str_replace(":","h",$bloc->heurematch), 11,5); ?></div>
                                    </div>
                                    <div class="flag_team_2">
                                        <img src="public/img/flags/<?php echo strtolower($bloc->slugext); ?>.png" alt="<?php echo $bloc->equipeext; ?>">
                                    </div>
                                </div>
                                <div class="team_content">
                                    <div class="pic_team_1">
                                        <img src="public/img/pictures/pic_<?php echo strtolower(str_replace("'","",str_replace(" ","",$bloc->equipedom))); ?>.jpg" alt="<?php echo $bloc->equipedom; ?>">
                                    </div>
                                    <div class="team_pronos">
                                        <div class="group"><?php echo $bloc->nomgroupe; ?></div>
                                        <form method="post" action="" onsubmit="return false;" name="form_save">
                                            <div class="score">
                                                <?php
                                                if($bloc->pronovalide) {
                                                ?>
                                                    <input type="text" name="score_team_1" class="score_team_1" id="scoredom_<?php echo $bloc->idmatch; ?>" value="<?php echo $bloc->scoredom; ?>"  />
                                                    <input type="text" name="score_team_2" class="score_team_2" id="scoreext_<?php echo $bloc->idmatch; ?>" value="<?php echo $bloc->scoreext; ?>"  />
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" name="score_team_1" class="score_team_1" placeholder="0" id="scoredom_<?php echo $bloc->idmatch; ?>" />
                                                    <input type="text" name="score_team_2" class="score_team_2" placeholder="0" id="scoreext_<?php echo $bloc->idmatch; ?>" />
                                                <?php } ?>
                                            </div>
                                            <div class="result">
                                                <!--span class="result_team_1">Victoire</span>
                                                <span class="result_team_2">Défaite</span-->
                                            </div>
                                            <div class="save">
                                                <?php
                                                if($bloc->pronovalide) {
                                                ?>
                                                    <button class="submit-ajax" id="<?php echo $bloc->idmatch; ?>">MODIFIER PRONOSTIQUE</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class="submit-ajax" id="<?php echo $bloc->idmatch; ?>">VALIDER</button>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="pic_team_2">
                                        <img src="public/img/pictures/pic_<?php echo strtolower(str_replace("'","",str_replace(" ","",$bloc->equipeext))); ?>.jpg" alt="<?php echo $bloc->equipeext; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- End : team 01 -->
                        <?php } ?>
                    </div>
                </div>
            </div>


        </div>
        <!-- #main -->

    </div>
    <!-- #main-container -->

    <?php $view->extend("bottombar",null,array("active" => "none")); ?>

    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')
    </script>
    <script src="js/main.js"></script>
    
    <script>
        
        $(document).ready(function() {
            
            function isInteger(value) {
                if ((undefined === value) || (null === value)) {
                    return false;
                }
                return value % 1 == 0;
            }
            
            $(".submit-ajax").click(function() {
                
                var idmatch = $(this).attr('id');
                var scoredom = $("#scoredom_"+idmatch).val();
                var scoreext = $("#scoreext_"+idmatch).val();
                if(scoredom == "" || scoreext == "" || !isInteger(scoredom) || !isInteger(scoreext)) {
                    alert('Saisir un prono valide.');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $view->link('prono_save_ajax') ?>",
                        data: { match: idmatch, dom: scoredom, ext: scoreext }
                    })
                    .done(function( msg ) {
                      alert( msg );
                      $("#"+idmatch).text("MODIFIER PRONOSTIQUE");
                    });
                }
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