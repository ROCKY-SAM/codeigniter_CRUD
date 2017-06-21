<?php include_once('header.php'); ?>


    <?php echo anchor('welcome','< < - Go To Main Page',['class'=> 'btn btn-info']);?>   
    <br>

 <div>
    <?php echo form_open('welcome/save',['class' => 'form-horizontal']);  ?>
  <fieldset>
    <legend>Add New <span class="pf pf-invoice-sign-alt"></span></legend>
    <div class="form-group">
      <label for="inputTitle" class="col-lg-3 control-label">Title</label>
      <div class="col-lg-5">
 
        <?php  
        $data = array(
        'type'  => 'text',
        'name'  => 'title',
        'id'    => 'title',
        'class' => 'form-control'
        
        );

        echo form_input($data);
        ?>
      </div>

      <div class="col-lg-5">
<?php echo form_error('title', '<div class="text-danger">', '</div>'); ?>
      </div>

    </div>
 
    <div class="form-group">
      <label for="description" class="col-lg-3 control-label">Description</label>
      <div class="col-lg-5">
    
        <?php  
        $data = array(
        'name'  => 'description',
        'id'    => 'description',
        'placehoder' => 'Description',
        'class' => 'form-control'
        );

        echo form_textarea($data);
        ?>        
        <span class="help-block">Codeigniter CRUD</span>
      </div>
        <div class="col-lg-5">
<?php echo form_error('description', '<div class="text-danger">', '</div>'); ?>
      </div>
    </div>
 
 
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
 
<?php echo form_reset([ 'class'=> 'btn btn-default','name' => 'Cancel','value' => 'Cancel']); ?>
  <?php echo form_submit(['name' => 'submit','value' => 'Submit','class'=> 'btn btn-primary']);?>       
    
      </div>
    </div>
  </fieldset>
<?php echo form_close();  ?>

</div>


<?php include_once('footer.php'); ?>
