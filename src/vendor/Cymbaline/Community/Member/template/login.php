<?php $view->extend("head", "prono14 | Access");?>

<body id="inscription">
    <img src="<?php $view->front('prono/css/image/cover_inscription.jpg'); ?>" id="bg" alt="">
    <div id="form_inscription">
        <h1>Inscritpion</h1>
		<?php
		
		if(isset($view->variables['error'])) {
			echo '<p>'.$view->variables['error'].'</p>';
		}
		
		?>
        <img id="av" src="<?php $view->front('prono/img/boba.gif'); ?>" alt="Photo de profil" />
        <label>Ajouter une photo <span style="font-size:12px">(carré de 160px par 160px)</span></label>
		<input type="text" name="search" placeholder="Recherche dans google image" />
        
		<p>OU</p>
		
		<form method="post" action="<?php $view->link('login'); ?>" enctype="multipart/form-data">
        <input type="file" name="avatar" id="avatar"/>
		
        <input id="firstname" name="forename" type="text" value="VOTRE PRÉNOM" onblur="if (this.value == '') {this.value = 'VOTRE PRÉNOM';}" onfocus="if (this.value == 'VOTRE PRÉNOM') {this.value = '';}" />
        <input id="lastname" name="lastname" type="text" value="VOTRE NOM" onblur="if (this.value == '') {this.value = 'VOTRE NOM';}" onfocus="if (this.value == 'VOTRE NOM') {this.value = '';}" />
        <input id="email" name="email" type="email" value="VOTRE EMAIL" onblur="if (this.value == '') {this.value = 'VOTRE EMAIL';}" onfocus="if (this.value == 'VOTRE EMAIL') {this.value = '';}" />
        <input id="password" name="password" type="text" value="VOTRE MOT DE PASSE" onblur="if (this.value == '') {this.value = 'VOTRE MOT DE PASSE';} if(this.type == 'password') {this.type = 'text'}" onfocus="if (this.value == 'VOTRE MOT DE PASSE') {this.value = '';}if(this.type == 'text') {this.type = 'password'}" />
		<input type="hidden" name="access" value="1" />
        <button>INSCRIPTION</button>
		</form>
        
    </div>
</body>
<script>
$(window).load(function() {    
    var theWindow        = $(window),
        $bg              = $("#bg"),
        aspectRatio      = $bg.width() / $bg.height();
    function resizeBg() {
        if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
            $bg
                .removeClass()
                .addClass('bgheight');
        } else {
            $bg
                .removeClass()
                .addClass('bgwidth');
        }
    }
    theWindow.resize(resizeBg).trigger("resize");
	
	//var upload = $.cymbupload('avatar');
	
});
</script>

</html>

