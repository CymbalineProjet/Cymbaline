<?php
$view->extend("gen_header", "Generator | todo"); //toujours etendre le header

?>
<h3>TODO</h3>
       <table  id="my-table" width="940px" style="margin:0px;">
            <thead>
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Fermer</th>
                <th>Ouvrir</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
        <?php
            //var_dump($view->variables['routes']);
            foreach ($view->variables['todos'] as $todo) {
				if($todo->getFlag()) {
					echo "<tr>" .
                         "<td><b>#".$todo->getId()."</b></td>" .
                         "<td><span style='text-decoration:line-through;'>".$todo->getContent()."</span> </td>" .
                         "<td></td>" .
                         "<td><a href='".$view->link('generator_open_todo',$todo->getId())."'>Ouvrir</a></td>" .
                         "<td><a href='".$view->link('generator_delete_todo',$todo->getId())."'>Supprimer</a></td>" .
                         "</tr>";
				} else {
					echo "<tr>" .
                         "<td><b>#".$todo->getId()."</b></td>" .
                         "<td>".$todo->getContent()." </td>" .
                         "<td><a href='".$view->link('generator_close_todo',$todo->getId())."'>Fermer</a></td>" .
                         "<td></td>" .
                         "<td></td>" .   
                         "</tr>";
				}
            }
        ?>   
            </tbody>
        </table>

<?php
$view->extend("gen_footer"); 

