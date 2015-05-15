<?php
$view->extend("gen_header", "Generator"); 

?>
<h3>ADD ITEM</h3>
<form id="edit-profile" method="post" class="form-horizontal" action='/generator/add/item'>
    <fieldset>
        <div class="control-group">
            <label for="path" class="control-label">Add :</label>
            <div class="controls"> 
                <input type="checkbox" name="controller_item" id="controller_item" class="" > Controller&nbsp;&nbsp;
                <input type="checkbox" name="form_item" id="form_item" class="" > Form&nbsp;&nbsp;
                <input type="checkbox" name="service_item" id="service_item" class="" > Service
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->

        <div class="control-group">
            <label for="crud_item" class="control-label">CRUD :</label>
            <div class="controls"> 
                <input type="checkbox" name="crud_item" id="crud_item" class="" > CRUD&nbsp;&nbsp;
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


<script>
    $(document).ready(function() {
      
       $(".submit").click(function() {
          if (confirm("Etes vous sur ?")) { // Clic sur OK
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

       $("#crud_item").click(function() {
            if($(this).is(":checked")) {
                $("#controller_item").attr("checked",true);
                $("#form_item").attr("checked",true);
            } else {
                $("#controller_item").attr("checked",false);
                $("#form_item").attr("checked",false);
            }
       });

       $("#form_item, #controller_item").click(function() {
            if( $("#crud_item").is(":checked"))
                return false;
       });
       
    });
</script>

<?php
$view->extend("gen_footer"); 

