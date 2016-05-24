<?php $view->extend("header", "prono14 | Access");?>


<body id="inscription">
    <img src="<?php $view->front('prono/css/image/cover_inscription.jpg'); ?>" id="bg" alt="">
	
	<h1>Coming Soon</h1>
	
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

