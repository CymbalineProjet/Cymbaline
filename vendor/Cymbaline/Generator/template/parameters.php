<?php
$view->extend("gen_header", "Generator"); 

?>
<h3>EDIT PARAMETERS</h3>
        
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
                <input type="text" name="host" id="host" class="span4" value="<?php echo $view->variables['param']->database->dev->host; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="control-group">
            <label for="port" class="control-label">Port :</label>
            <div class="controls">                         
                <input type="text" name="port" id="port" class="span4" value="<?php echo $view->variables['param']->database->dev->port; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="control-group">
            <label for="dbname" class="control-label">Nom de la base :</label>
            <div class="controls">                         
                <input type="text" name="dbname" id="dbname" class="span4" value="<?php echo $view->variables['param']->database->dev->dbname; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="control-group">
            <label for="dbuser" class="control-label">Utilisateur :</label>
            <div class="controls">                         
                <input type="text" name="dbuser" id="dbuser" class="span4" value="<?php echo $view->variables['param']->database->dev->dbuser; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="control-group">
            <label for="dbpass" class="control-label">Mot de passe :</label>
            <div class="controls">                         
                <input type="text" name="dbpass" id="dbpass" class="span4" value="<?php echo $view->variables['param']->database->dev->dbpass; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <h3 style="margin-left:158px;">Database configuration (prod)</h3>
        <br />

        <div class="control-group">
            <label for="host_prod" class="control-label">Hote :</label>
            <div class="controls">                         
                <input type="text" name="host_prod" id="host_prod" class="span4" value="<?php echo $view->variables['param']->database->prod->host; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="control-group">
            <label for="port_prod" class="control-label">Port :</label>
            <div class="controls">                         
                <input type="text" name="port_prod" id="port_prod" class="span4" value="<?php echo $view->variables['param']->database->prod->port; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="control-group">
            <label for="dbname_prod" class="control-label">Nom de la base :</label>
            <div class="controls">                         
                <input type="text" name="dbname_prod" id="dbname_prod" class="span4" value="<?php echo $view->variables['param']->database->prod->dbname; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="control-group">
            <label for="dbuser_prod" class="control-label">Utilisateur :</label>
            <div class="controls">                         
                <input type="text" name="dbuser_prod" id="dbuser_prod" class="span4" value="<?php echo $view->variables['param']->database->prod->dbuser; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="control-group">
            <label for="dbpass_prod" class="control-label">Mot de passe :</label>
            <div class="controls">                         
                <input type="text" name="dbpass_prod" id="dbpass_prod" class="span4" value="<?php echo $view->variables['param']->database->prod->dbpass; ?>">
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="form-actions">
                <button type="submit" class="submit btn btn-primary">Save</button> 
        </div> <!-- /form-actions -->
    </fieldset>
</form>

<?php
$view->extend("gen_footer"); 

