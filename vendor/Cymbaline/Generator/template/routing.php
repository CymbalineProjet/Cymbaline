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
            foreach ($view->variables['routes'] as $id => $route) {
               
        ?>
            <tr>
                <td><a target="_blank" href="<?php $view->link($route['path']); ?>"><?php echo $id ?></a></td>
                <td><?php echo $route['path'] ?></td>
                <td><?php echo $route['controller'] ?></td>
                <td><?php echo $route['action'] ?></td>
                <td><?php echo $route['template'] ?></td>
            </tr>
        <?php
            }
        ?>   
            </tbody>
        </table>

<?php
$view->extend("gen_footer"); 

