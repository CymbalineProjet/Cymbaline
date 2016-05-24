<?php

$view->extend('header','test');
?>

<script>
$(document).ready(function() {

	function loadRoster(teamId) {
		$.ajax({ xhr: function() {    
		
			var xhr = new window.XMLHttpRequest();  

			//Upload progress 
			xhr.upload.addEventListener("progress", function(evt){ 
				if (evt.lengthComputable) { 
					var percentComplete = evt.loaded / evt.total;
		 			//Do something with upload progress
		 			console.log(percentComplete); 
				} 
			}, 
			false); 

			//Download progress 
			xhr.addEventListener("progress", function(evt){ 
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
			type: 'POST', url: "http://thibaultjeannet.fr/nba/api/data/teams/"+teamId, data: {}, 
			success: function(data){ 
				//Do something success-ish
				$(".data").html(data);
			} 
		});
	}

});
</script>

<?php

echo $view->variables['teams'];


$view->extend("gen_footer"); 
