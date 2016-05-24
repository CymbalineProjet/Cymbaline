<?php
$view->extend("head", "prono14 | Modification du compte"); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

//$view->get("User/SecurityBox/login");
?>
<div class="main-container">

        <?php $view->extend("sidebar"); ?>

        <div class="main">
            <header>
                <h1>Inscription pour les pronos 2014</h1>
                <h2>creation de votre compte</h2>
                <?php if(is_null($view->variables['retour'])) { ?>
                <h3>inscrivez-vous et commencez vos pronostiques</h3>
                <?php } else { ?>
                <h3><?php echo $view->variables['retour'];?></h3>
                <?php } ?>
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
                <div class="content_left">
                    <div class="bloc">
                        <form method="post" action="<?php echo $view->link('editer_compte_mail'); ?>" name="form1" >
                            <fieldset class="head">
                                <h3>informations principales :</h3>
                                <input type="submit" value="VALIDER" class="submitForm">
                            </fieldset>
                            <fieldset>
                                <input type="email" value="<?php echo $view->session()->get('user')->getMail(); ?>" name="mail" required>
                                <label>Adresse e-mail :</label>
                            </fieldset>
                            <fieldset>
                                <input type="text" value="<?php echo $view->session()->get('user')->getPassword(); ?>" name="password" required>
                                <label>Mot de passe :</label>
                            </fieldset>
                        </form>
                    </div>
                    <div class="bloc">
                        <form method="post" action="<?php echo $view->link('editer_compte_mess'); ?>" name="form2" >
                            <fieldset class="head">
                                <h3>message de publication :</h3>
                                <input type="submit" value="VALIDER" class="submitForm">
                            </fieldset>
                            <fieldset class="textarea">
                                <textarea rows="4" cols="50" name="publication" required>
                                    <?php echo $view->session()->get('user')->getMessage(); ?>
                                </textarea>
                                <label>Votre message :</label>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="content_right">
                    <div class="bloc">
                        <form method="post" action="<?php echo $view->link('editer_compte_identite'); ?>" name="form3"  enctype="multipart/form-data">
                            <fieldset class="head">
                                <h3>informations secondaires :</h3>
                                <input type="submit" value="VALIDER" class="submitForm">
                            </fieldset>
                            <fieldset class="second">
                                <label>Username :</label>
                                <input type="text" value="<?php echo $view->session()->get('user')->getUsername(); ?>" name="username" required>
                                <label>Nom :</label>
                                <input type="text" value="<?php echo $view->session()->get('user')->getNom(); ?>" name="nom" required>
                                <label>Prénom :</label>
                                <input type="text" value="<?php echo $view->session()->get('user')->getPrenom(); ?>" name="prenom" required>
                                <label>Modifier votre photo :</label>
                                <input type="file" value="PARCOURIR..." name="photo" class="parcourir">
                            </fieldset>
                            <fieldset class="photo">
                                <label>Votre photo de profil :</label>
                                <img src="<?php $view->front("img/upload/avatar/".$view->session()->get('user')->getUsername().".jpg"); ?>" alt="<?php echo $view->session()->get('user')->getUsername(); ?>" />
                            </fieldset>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
                
            </div>
                </div>

        </div>
        <!-- #main -->

    </div>
    <!-- #main-container -->

    <?php $view->extend("bottombar",null,array("active" => "none")); ?>

    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>');
        
        function post_to_url(path, params, method) {
            method = method || "post"; // Set method to post by default if not specified.

            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);
            form.setAttribute("enctype", "multipart/form-data");
            

            for(var key in params) {
                if(params.hasOwnProperty(key)) {
                    
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", key);
                        hiddenField.setAttribute("value", params[key]);

                        form.appendChild(hiddenField);
                    
                 }
            }

            document.body.appendChild(form);
            form.submit();
        }
        
        $(document).ready(function() {
            $("#valideConnect").click(function() {
                $("#formConnect").submit();
            });
            $('.inscriptionForm').submit(function() {
                var errors = 0;
                var array = new Array();
                $("#mainForm :input").map(function(){
                    if( !$(this).val() ) {                          
                        errors++;
                    } else {
                        array[$(this).attr('name')] = $(this).val();
                    }  
                });
                $("#persoForm :input").map(function(){
                    if( !$(this).val() ) {                          
                        errors++;
                    } else {
                        array[$(this).attr('name')] = $(this).val();
                    }  
                });
                
                if($("textarea").val() == "") {
                    errors++;
                } else {
                    array['message'] = $("textarea").val();
                }
                
                if(errors > 0){
                    //console.log(array);
                    alert('Il faut renseigner les 3 formulaires.');
                    return false;
                } else {
                   
                   if($("#go").val() == "go") {
                       
                       return true;
                   }
                   
                   $("#persoForm").append("<input type='hidden' value='"+array['mail']+"' name='mail' />");
                   $("#persoForm").append("<input type='hidden' value='"+array['password']+"' name='password' />");
                   $("#persoForm").append("<input type='hidden' value='"+array['message']+"' name='message' />");
                   $("#persoForm").append("<input type='hidden' value='go' name='go' id='go' />");

                   $("#persoForm").submit();
                   
                }
                  
            });        
           
        });
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
-->
</body>

</html>


