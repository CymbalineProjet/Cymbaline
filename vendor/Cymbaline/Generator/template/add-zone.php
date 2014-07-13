<?php
$view->extend("gen_header", "Generator"); 

?>
<h3>ADD ZONE</h3>

 <form id="edit-profile" method="post" class="form-horizontal" action='/generator/add/zone'>
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

