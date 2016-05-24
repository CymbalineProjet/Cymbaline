<?php
$view->extend("gen_header", "Generator"); 

?>
<h3>ADD BOX</h3>

<form id="edit-profile" method="post" class="form-horizontal" action='/generator/add/box'>
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


<script>
    $(document).ready(function() {
       
       $(".submit").click(function() {
          if (confirm("Etes vous sur ?")) { // Clic sur OK
            return true;
          } else {
            return false;  
          }
       });

    });
</script>

<?php
$view->extend("gen_footer"); 

