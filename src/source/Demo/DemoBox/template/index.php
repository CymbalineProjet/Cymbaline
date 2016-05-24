<?php
$view->extend("header", "test"); 

echo "<h1>Test</h1>";
echo "<table width='100%' border='1' cellspacing='0' cellpadding='0'>";
echo "<tr>
		<td>id</td>
		<td>label</td>
		<td>edit</td>
		<td>delete</td>
	  </tr>";

foreach($view->variables["items"] as $item) {
	echo "<tr>";
	echo "<td>".$item->getId()."</td>";
	echo "<td>".$item->getLabel()."</td>";
	echo "<td><a href='".$view->link('test_edit', $item->getId())."'>click</a></td>";
	echo "<td><a href='".$view->link('test_delete', $item->getId())."'>click</a></td>";
	echo "</tr>";
}
echo "</table>";

echo "<p><a href='".$view->link('test_new')."'>New item</a></p>";

$view->extend("footer");