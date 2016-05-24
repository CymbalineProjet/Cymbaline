<?php

$view->extend('gen_header','test');
?>


<script>
$(document).ready(function() {
	$.ajax({
	  headers: { 'X-Auth-Token': '203f1f36b553453aa022dcd393c160aa' },
	  url: 'http://api.football-data.org/alpha/fixtures?timeFrame=n1',
	  dataType: 'json',
	  type: 'GET',
	}).done(function(response) {
	  // do something with the response, e.g. isolate the id of a linked resource        
	  var regex = /.*?(\d+)$/; // the ? makes the first part non-greedy
	  var res = regex.exec(response.fixtures[0]._links.awayTeam.href);
	  var teamId = res[1];
	  console.log(teamId);
	}); 
})
</script>


<?php
$view->extend("gen_footer"); 


