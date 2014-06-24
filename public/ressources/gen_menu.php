<ul id="menu1">
    <li><a href="#">GENERATORUS 1.0</a>
        <ul>
            <li><a href="#">a</a></li>
            <li><a href="#">bb</a></li>
            <li><a href="#">ccc</a></li>
            <li><a href="#">ddd</a></li>
            <li><a href="#">eeee</a></li>
            <li><a href="#">fffff</a></li>
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
        <a href="#">DOCUMENTATION</a>
    </li>
</ul>