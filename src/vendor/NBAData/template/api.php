<?php

$view->extend('header','test');
?>


<script>
$(document).ready(function() {

	function get_filesize(url, callback) {
	    var xhr = new XMLHttpRequest();
	    xhr.open("HEAD", url, true); // Notice "HEAD" instead of "GET",
	                                 //  to get only the header
	    xhr.onreadystatechange = function() {
	        if (this.readyState == this.DONE) {
	            callback(parseInt(xhr.getResponseHeader("Content-Length")));
	        }
	    };
	    xhr.send();
	}
	
				
				
				
	$.ajax({ xhr: function() { 
		    
		
		var xhr = new window.XMLHttpRequest(); 

		//Upload progress 
		xhr.upload.addEventListener("progress", function(evt){ 
			alert("in progress upload");
			if (evt.lengthComputable) { 
				var percentComplete = evt.loaded / evt.total;
	 			//Do something with upload progress
	 			console.log(percentComplete); 
			} 
		}, 
		false); 

		//Download progress 
		xhr.addEventListener("progress", function(evt){ 
			console.log(evt.loaded);
			if (evt.lengthComputable) { 
				alert("in progress download dd");
				var percentComplete = evt.loaded / evt.total;
	 			//Do something with download progress 
				console.log(percentComplete); 
			} else {
				console.log(evt.loaded);
			}
		}, 
		false);

	 	return xhr; 
		},
		type: 'POST', url: "http://thibaultjeannet.fr/nba/api/data/teams", data: {}, 
		success: function(data){ 
			//Do something success-ish
			$(".data").html(data);
		} 
	});
				
	
});
</script>
<div class="data"></div>

<?php
$view->extend("gen_footer"); 


