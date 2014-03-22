<?php
$view->extend("head", "prono14 | Profil de ".$view->variables['utilisateur']->getUsername()); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

//$view->get("User/SecurityBox/login");
?>
<div class="main-container">

        <aside>
            <h1 id="logo">
                <img src="<?php $view->front("img/logo.png"); ?>" alt="FIFA WORLD CUP 2014 BRAZIL" width="100%" />
            </h1>
            <h2 class="title">PRONOSTIQUES
                <br/>FIFA WORLD CUP
                <br/>2014 - BRESIL</h2>
            <h3 class="title_id"><?php echo $view->variables['utilisateur']->getUsername(); ?></h3>
            <div class="connect" style="padding:0px;">
                <img height="100%" width="100%" src="<?php $view->front("img/upload/avatar/".$view->variables['utilisateur']->getUsername().".jpg"); ?>" />
            </div>
        </aside>

        <div class="main">
            <header>
                <h1>Inscription pour les pronos 2014</h1>
                <h2>disponible le 15 avril</h2>
                <h3>site actuellement en developpement</h3>
                
            </header>
            <section>
               
            </section>

        </div>
        <!-- #main -->

    </div>
    <!-- #main-container -->

    <footer>
        <nav>
            <ul>
                <li class="accueil">
                    <a href="#" class="active" title="accueil"></a>
                </li>
                <li class="classement">
                    <a href="#" title="classement"></a>
                </li>
                <li class="resultats">
                    <a href="#" title="résultats"></a>
                </li>
                <li class="calendrier">
                    <a href="#" title="calendrier"></a>
                </li>
                <li class="equipes">
                    <a href="#" title="équipes"></a>
                </li>
                <li class="reglesdujeu">
                    <a href="#" title="règles du jeu"></a>
                </li>
            </ul>
        </nav>
        <a href="/"><button id="deco">DECONNEXION</button></a>
        <blockquote style="font-size: 18px;color:white;">&nbsp;&nbsp;<?php echo $view->variables['utilisateur']->getMessage(); ?></blockquote>
    </footer>

    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>');
        
        
    </script>
    <script src="<?php $view->front("js/main.js"); ?>"></script>

    <!--
        // GOOGLE ANALYTICS
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    
    <div class="tracker" style="display:none;position: fixed;padding:5px;border:1px solid blue;background:black;color:white;"><?php var_dump($view->variables['utilisateur']); ?></div>

<a href="./login">Deconnexion</a>

<script type="text/javascript" src="./public/js/jquery.js"></script>
<script type="text/javascript" src="./public/js/keypress.js"></script>
<script type="text/javascript" src="./public/js/tracker.js"></script>
<script>
    $(document).ready(function() {
        keypress.combo("shift s", function() {
            tracker('.tracker');
        }); 
    });
</script>
-->
</body>

</html>


