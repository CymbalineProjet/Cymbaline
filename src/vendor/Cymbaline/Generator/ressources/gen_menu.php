<ul id="menu1">
    <li><a href="#">GENERATORUS 1.0</a>
        <ul>
            <li><a href="<?php echo $view->link('generator_parameters'); ?>">Parameters</a></li>
            <li><a href="<?php echo $view->link('generator_add_item'); ?>">Add item</a></li>
            <li><a href="<?php echo $view->link('generator_add_box'); ?>">Add box</a></li>
            <li><a href="<?php echo $view->link('generator_add_zone'); ?>">Add zone</a></li>
        </ul>
    </li>
    <li><a href="#">Menu2</a></li>
    <li>
        <a href="#">COMPONENT</a>
        <ul>
            <li><a href="<?php echo $view->link('generator_route'); ?>">Routes</a></li>
            <li><a href="<?php echo $view->link('generator_code'); ?>">Codex</a></li>
        </ul>
    </li>
    <li>
        <a href="">TODO</a>
         <ul>
            <li><a href="<?php echo $view->link('generator_todo'); ?>">Liste</a></li>
            <li><a href="<?php echo $view->link('generator_new_todo'); ?>">Ajout</a></li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $view->link('documentation'); ?>">DOCUMENTATION</a>
    </li>
</ul>