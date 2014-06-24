<?php
$view->extend("gen_header", "Generator"); //toujours etendre le header

?>
<h3>ROUTES</h3>
        <table  id="my-table" width="940px" style="margin:0px;">
            <thead>
            <tr>
                <th>Name</th>
                <th>Path</th>
                <th>Controller</th>
                <th>Action</th>
                <th>Template</th>
            </tr>
            </thead>
            <tbody>
        <?php
            //var_dump($view->variables['routes']);
            foreach ($view->variables['routes'] as $route) {
        ?>
            <tr>
                <td><?php echo $route['attrib']['name'] ?></td>
                <td><?php echo $route['attrib']['path'] ?></td>
                <td><?php echo $route['attrib']['controller'] ?></td>
                <td><?php echo $route['attrib']['action'] ?></td>
                <td><?php echo $route['attrib']['template'] ?></td>
            </tr>
        <?php
            }
        ?>   
            </tbody>
        </table>

<?php
$view->extend("gen_footer"); 

