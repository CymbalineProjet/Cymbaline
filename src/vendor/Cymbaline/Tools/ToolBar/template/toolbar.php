<!DOCTYPE html>
<html>
	<head>
	
		
		<style>
		
			th {
				width:200px;
				text-align:left;
				padding:5px;
			}
			
			td {
				width:600px;
				text-align:left;
				padding:5px;
			}
			
			tr, td {
				border: 1px solid black;
			}
		</style>
	
	
	</head>
	
	<body>

			<table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid black;">
				<tr>
					<th>community.member</th>
					<td><?php
					$member = $view->community()->member();
					
					echo "id : ".$member->getId().", ";
					echo "username : ".$member->get('username').", ";
					echo "forename : ".$member->get('forename').", ";
					echo "lastname : ".$member->get('lastname').", ";
					echo "password : ".$member->get('password').", ";
					echo "mail : ".$member->get('mail').", ";
					?></td>
				</tr>
				<tr>
					<th>community.manager</th>
					<td></td>
				</tr>
			</table>
		
		
	</body>
	
</html>