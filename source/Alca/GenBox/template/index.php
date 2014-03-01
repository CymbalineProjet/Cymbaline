<?php

$view->extend("head", "Generator"); //toujours etendre le header
//on peut par la suite etendre un menu, un widget, un module, etc ...

//$view->get('User/SecurityBox/login');


//$choices = $view->form['form_parameters']->getChoices('env');
//var_dump($view->form['form_parameters']);
//$view->form['form_parameters']->open();
?>

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">
                        <div class="widget-header">
                            <i class="icon-cogs"></i>
                            <h3>Configuration</h3>
                        </div> <!-- /widget-header -->
					
			<div class="widget-content">
                            <div class="tabbable">
				<ul class="nav nav-tabs">
                    <li class="tabChange active" id="parameter">
                        <a href="javascript:void();" data-toggle="tab" ref="parameter" class="tabClick">Parameters</a>
                    </li>
                    <li class="tabChange" id="route">
                        <a href="javascript:void();" data-toggle="tab" ref="route" class="tabClick">Routes</a>
                    </li>
                    <li class="tabChange" id="item">
                        <a href="javascript:void();" data-toggle="tab" ref="item" class="tabClick">Add Item</a>
                    </li>
                    <li class="tabChange" id="zone">
                        <a href="javascript:void();" data-toggle="tab" ref="zone" class="tabClick">Add Zone</a>
                    </li>
                    <li class="tabChange" id="box">
                        <a href="javascript:void();" data-toggle="tab" ref="box" class="tabClick">Add Box</a>
                    </li>
				</ul>
						
				<br>
						
				<div class="tab-content">
                    <div class="tab-pane active" id="parameters">
                        <?php $view->form['form_parameters']->open(); ?>
                       
                            <fieldset>	
                                
                                <h3 style="margin-left:158px;">Global</h3>
                                <br />
                                 <?php //$view->form['form_parameters']->getField('baseurl'); ?>
                                <div class="control-group">
                                    <label for="env" class="control-label">Environnement : </label>
                                    <div class="controls">                         
                                        <?php //echo $choices[0]; ?>
                                        <?php //echo $choices[1]; ?>
                                        <input type="radio" name="env" id="dev" class="" value="dev" <?php if($view->variables['param']->env == "dev") {echo "checked";} ?> /> dev &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="env" id="prod" class="" value="prod" <?php if($view->variables['param']->env == "prod") {echo "checked";} ?> /> prod
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="baseurl" class="control-label">Base url :</label>
                                    <div class="controls">                         
                                        <input type="text" name="baseurl" id="baseurl" class="span4" value="<?php echo $view->variables['param']->baseurl; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="basetitle" class="control-label">Titre par défaut :</label>
                                    <div class="controls">                         
                                        <input type="text" name="basetitle" id="basetitle" class="span4" value="<?php echo $view->variables['param']->basetitle; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="controllerdefault" class="control-label">Controller par défaut :</label>
                                    <div class="controls">                         
                                        <input type="text" name="controllerdefault" id="controllerdefault" class="span4" value="<?php echo $view->variables['param']->controllerdefault; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                
                                <h3 style="margin-left:158px;">Database configuration (dev)</h3>
                                <br/>
                                <div class="control-group">
                                    <label for="host" class="control-label">Hote :</label>
                                    <div class="controls">                         
                                        <input type="text" name="host" id="host" class="span4" value="<?php echo $view->variables['param']->database[0]->host; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="port" class="control-label">Port :</label>
                                    <div class="controls">                         
                                        <input type="text" name="port" id="port" class="span4" value="<?php echo $view->variables['param']->database[0]->port; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="dbname" class="control-label">Nom de la base :</label>
                                    <div class="controls">                         
                                        <input type="text" name="dbname" id="dbname" class="span4" value="<?php echo $view->variables['param']->database[0]->dbname; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="dbuser" class="control-label">Utilisateur :</label>
                                    <div class="controls">                         
                                        <input type="text" name="dbuser" id="dbuser" class="span4" value="<?php echo $view->variables['param']->database[0]->dbuser; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="dbpass" class="control-label">Mot de passe :</label>
                                    <div class="controls">                         
                                        <input type="text" name="dbpass" id="dbpass" class="span4" value="<?php echo $view->variables['param']->database[0]->dbpass; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <h3 style="margin-left:158px;">Database configuration (prod)</h3>
                                <br />
                                
                                <div class="control-group">
                                    <label for="host_prod" class="control-label">Hote :</label>
                                    <div class="controls">                         
                                        <input type="text" name="host_prod" id="host_prod" class="span4" value="<?php echo $view->variables['param']->database[1]->host; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="port_prod" class="control-label">Port :</label>
                                    <div class="controls">                         
                                        <input type="text" name="port_prod" id="port_prod" class="span4" value="<?php echo $view->variables['param']->database[1]->port; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="dbname_prod" class="control-label">Nom de la base :</label>
                                    <div class="controls">                         
                                        <input type="text" name="dbname_prod" id="dbname_prod" class="span4" value="<?php echo $view->variables['param']->database[1]->dbname; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="dbuser_prod" class="control-label">Utilisateur :</label>
                                    <div class="controls">                         
                                        <input type="text" name="dbuser_prod" id="dbuser_prod" class="span4" value="<?php echo $view->variables['param']->database[1]->dbuser; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="dbpass_prod" class="control-label">Mot de passe :</label>
                                    <div class="controls">                         
                                        <input type="text" name="dbpass_prod" id="dbpass_prod" class="span4" value="<?php echo $view->variables['param']->database[1]->dbpass; ?>">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
											
                                <div class="form-actions">
                                        <button type="submit" class="submit btn btn-primary">Save</button> 
                                </div> <!-- /form-actions -->
                            </fieldset>
                        </form>
                    </div>
                </div>
                
                <div class="tab-content">
                    <div class="tab-pane" id="routes">
                        <form id="edit-profile" method="post" class="form-horizontal" action=''>
                            <fieldset>
                                
                                <h3 style="margin-left:158px;">Routes</h3>
                                <br />
                                
                                <div class="control-group">
                                    <label for="dbpass_prod" class="control-label">Mot de passe :</label>
                                    <div class="controls">                         
                                        <input type="text" name="dbpass_prod" id="dbpass_prod" class="span4">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
											
                                <div class="form-actions">
                                        <button type="submit" class="submit btn btn-primary">Save</button> 
                                </div> <!-- /form-actions -->
                            </fieldset>
                        </form>
                    </div>
                </div>
                
                <div class="tab-content">
                    <div class="tab-pane" id="items">
                        <form id="edit-profile" method="post" class="form-horizontal" action='createitem'>
                            <fieldset>
                                
                                <h3 style="margin-left:158px;">Configuration Item</h3>
                                <br />
                                
                                <div class="control-group">
                                    <label for="path" class="control-label">Cascade :</label>
                                    <div class="controls">                         
                                        <input type="checkbox" checked name="controller_item" id="all_item" class="" > All &nbsp;&nbsp;
                                        <input type="checkbox" name="controller_item" id="controller_item" class="" > Controller&nbsp;&nbsp;
                                        <input type="checkbox" name="form_item" id="form_item" class="" > Form&nbsp;&nbsp;
                                        <input type="checkbox" name="loader_item" id="loader_item" class="" > Loader&nbsp;&nbsp;
                                        <input type="checkbox" name="service_item" id="service_item" class="" > Service
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="path" class="control-label">Path :</label>
                                    <div class="controls">                         
                                        <input type="text" name="path" id="path_item" class="span4" value="{zone}/{box}">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="name" class="control-label">Name :</label>
                                    <div class="controls">                         
                                        <input type="text" name="name" id="name_item" class="span4">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="author" class="control-label">Author :</label>
                                    <div class="controls">                         
                                        <input type="text" name="author" id="author_item" class="span4" value="author">
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <h4 style="margin-left:158px;">Attributs</h4>
                                <br/>
                                <div class="attributs">
                                    <div class="control-group">
                                        <label for="attr_name[]" class="control-label">Name :</label>
                                        <div class="controls">                         
                                            <input type="text" name="attr_name[]" id="name_attr_1" class="span4">
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->                                    
                                    
                                </div>   
                                
                                <button style="margin-left: 158px;" id="add">Add Attribut</button>
											
                                <div class="form-actions">
                                        <button type="submit" class="submit btn btn-primary">Save</button> 
                                </div> <!-- /form-actions -->
                            </fieldset>
                        </form>
                    </div>
                </div>
                
                
                <div class="tab-content">
                    <div class="tab-pane" id="zones">
                        <form id="edit-profile" method="post" class="form-horizontal" action='addzone'>
                            <fieldset>
                                
                                <h3 style="margin-left:158px;">Zone</h3>
                                <br />
                                
                                <div class="control-group">
                                    <label for="addzone" class="control-label">Name :</label>
                                    <div class="controls">                         
                                        <input type="text" name="addzone" id="addzone" class="span4" required >
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
											
                                <div class="form-actions">
                                        <button type="submit" class="submit btn btn-primary">Save</button> 
                                </div> <!-- /form-actions -->
                            </fieldset>
                        </form>
                    </div>
                </div>
                
                <div class="tab-content">
                    <div class="tab-pane" id="boxs">
                        <form id="edit-profile" method="post" class="form-horizontal" action='addbox'>
                            <fieldset>
                                
                                <h3 style="margin-left:158px;">Box</h3>
                                <br />
                                
                                <div class="control-group">
                                    <label for="zone" class="control-label">Zone :</label>
                                    <div class="controls">                         
                                        
                                        <select name="zone" id="zone" required >
                                            <?php
                                            foreach($view->variables['zone'] as $zone) {
                                              echo "<option value='$zone'>$zone</option>";  
                                            }
                                            ?>
                                        </select>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
                                <div class="control-group">
                                    <label for="addbox" class="control-label">Name :</label>
                                    <div class="controls">                         
                                        <input type="text" name="addbox" id="addbox" class="span4" required >
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                                
											
                                <div class="form-actions">
                                        <button type="submit" class="submit btn btn-primary">Save</button> 
                                </div> <!-- /form-actions -->
                            </fieldset>
                        </form>
                    </div>
                </div>


            </div>





        </div> <!-- /widget-content -->

</div> <!-- /widget -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {
       
       /**
        * permet le changement de page via les onglets
        */
       $('a.tabClick').click(function() {
           var ref = $(this).attr('ref');
           var li = $("#"+ref);
           
           if(li.hasClass('active')) {
               //nothing
           } else {
               $('li.tabChange').each(function(index) {
                  $(this).removeClass('active'); 
                  var id = $(this).attr('id')+"s";
                  $("#"+id).removeClass('active');
               });
               li.addClass('active');
               $("#"+li.attr('id')+"s").addClass('active');
           }
       });
       
       $(".submit").click(function() {
          if (confirm("Voulez-vous changer les parametres ?")) { // Clic sur OK
            return true;
          } else {
            return false;  
          }
       });
       
       $("#add").click(function() {
            $(".attributs").append('<div class="control-group"><label for="attr_name[]" class="control-label">Name :</label><div class="controls"><input type="text" name="attr_name[]" id="name_attr_3" class="span4"></div> <!-- /controls --></div> <!-- /control-group -->');
            //$(".attributs").append("test");
            //alert('test');
            return false;
       });
       
    });
</script>

