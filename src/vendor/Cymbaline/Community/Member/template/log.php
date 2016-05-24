<?php $view->extend("head", "prono14 | Access");?>


<body id="inscription">
    <img src="<?php $view->front('prono/css/image/cover_inscription.jpg'); ?>" id="bg" alt="">
	<div id="form_inscription">
    <form action="<?php $view->link('home'); ?>" method="post">
        <h1>Connexion</h1>
        <img src="<?php $view->front('prono/img/boba.gif'); ?>" alt="Photo de profil" />
		
        <input id="forename" name="forename" type="text" value="test" onblur="if (this.value == '') {this.value = 'VOTRE PRÉNOM';}" onfocus="if (this.value == 'VOTRE PRÉNOM') {this.value = '';}" />
        <input id="lastname" name="lastname" type="text" value="test" onblur="if (this.value == '') {this.value = 'VOTRE NOM';}" onfocus="if (this.value == 'VOTRE NOM') {this.value = '';}" />
        <input id="password" name="password" type="text" value="test" onblur="if (this.value == '') {this.value = 'VOTRE MOT DE PASSE';} if(this.type == 'password') {this.type = 'text'}" onfocus="if (this.value == 'VOTRE MOT DE PASSE') {this.value = '';}if(this.type == 'text') {this.type = 'password'}" />
		<input type="hidden" name="access" value="1" />
        <button>CONNEXION</button>
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
});
</script>

</html>

