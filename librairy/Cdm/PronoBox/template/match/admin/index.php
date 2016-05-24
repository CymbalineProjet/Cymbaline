<?php
$view->extend("header", "prono14 | admin matchs "); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

?>
<style>
    th {text-align: left;}
</style>
<table cellspacing="0" cellpadding="0" style="padding:2px;width:900px;" id="dynatable">
    <thead>
    <tr>
        <th>#</th>
        <th>Domicile</th>
        <th>Exterieur</th>
        <th>Stade</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Maj</th>
    </tr>
    </thead>
    <tbody>
<?php
foreach($view->variables['matchs'] as $match) {
    
    $scoredom = "";
    $scoreext = "";
    if($match->getJoue()) {
        $scoredom = $match->getScoredom();
        $scoreext = $match->getScoreext();
    }
    echo "<tr>"
    . "<td>".$match->getId()."</td>"
    . "<td>".$match->getEquipedom()."  <b>$scoredom</b></td>"
    . "<td><b>$scoreext</b>  ".$match->getEquipeext()."</td>"
    . "<td>".$match->getStade()."</td>"
    . "<td>".$match->getDate()."</td>"
    . "<td><a href='".$view->link("admin_match_edit",$match->getId())."'>Edit</a></td>"
    . "<td><a href='".$view->link("admin_match_maj",$match->getId())."'>Maj</a></td>"
    . "</tr>";
            
}
?>
    </tbody>
</table>
<?php
$view->extend("admin_footer");