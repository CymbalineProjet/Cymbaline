<?php
$view->extend("administration_header", "Administration");
?>
<div class="wrapper">
        <div class="container">
            <div class="row">

                <?php
                $view->extend("administration_menu");
                ?>

                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Forms</h3>
                            </div>
                            <div class="module-body">
                            <?php 
                                $labels = $view->form['form_parameters']->getLabels();
                                $view->form['form_parameters']->open(); 
                                
                            ?>
                           
                                <?php foreach ($view->form['form_parameters']->getFields() as $i => $field) { ?>
                                    
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput"><?php echo $labels[$i]; ?></label>
                                            <div class="controls">
                                                <?php 
                                                if(is_array($field)) {
                                                    foreach ($field as $key => $value) {
                                                        echo $value;
                                                    }
                                                } else {
                                                    echo $field; 
                                                }
                                                ?>
                                                <!--input type="text" id="basicinput" placeholder="Type something here..." class="span8">
                                                <span class="help-inline">Minimum 5 Characters</span-->
                                            </div>
                                        </div>

                                <?php } ?>
                            </form>

                            </div>
                        </div>

                        
                        
                    </div><!--/.content-->
                </div><!--/.span9-->
            </div>
        </div><!--/.container-->
    </div><!--/.wrapper-->

    
<?php
$view->extend("administration_footer"); 

