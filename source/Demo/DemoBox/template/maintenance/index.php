<?php
$view->extend("header", "maintenance"); 

echo "<h1>Maintenance</h1>";
echo "<table width='100%' border='1' cellspacing='0' cellpadding='0'>";
echo "<tr>
		<td>isStop</td>
		<td>time</td>
		<td>edit</td>
		<td>delete</td>
	  </tr>";

foreach($view->variables["items"] as $item) {
	echo "<tr>";
	echo "<td>" .$item->getIsStop(). "</td>";
	echo "<td>" .$item->getTime(). "</td>";
	echo "<td><a href='".$view->link('maintenance_edit', $item->getId())."'>click</a></td>";
	echo "<td><a href='".$view->link('maintenance_delete', $item->getId())."'>click</a></td>";
	echo "</tr>";
}
echo "</table>";

echo "<p><a href='".$view->link('maintenance_new')."'>New item</a></p>";

$view->extend("footer");