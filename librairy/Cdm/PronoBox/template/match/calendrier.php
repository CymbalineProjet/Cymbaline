<?php
$view->extend("head", "prono14 | classement"); 

?>
<div class="main-container">

        <?php $view->extend("sidebar"); ?>

        <div class="main">
            <header>
                <h1>classement</h1>
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
                        
                        calendrier a venir
                    </div>
                </div>
            </div>


        </div>
        <!-- #main -->

    </div>
    <!-- #main-container -->

    <?php $view->extend("bottombar",null,array("active" => "calendrier")); ?>

</body>

</html>