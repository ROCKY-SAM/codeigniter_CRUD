<?php include_once('header.php'); ?>


<div class="container">

<?php echo anchor('welcome/create', 'Add Item - > >', ['class' => 'btn btn-primary']);  ?>

<br>
<h3>Post List</h3>
<?php if($msg = $this->session->flashdata('msg')): 
echo $msg;
endif;
?>
<table class="table table-striped table-hover ">
  <thead> 
    <tr class="success">
      <th>Title</th>
      <th>Description</th>
      <th>Creation Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

	<?php if(count($posts)): ?>
	 <?php foreach($posts as $post): ?> 

    <tr>
      <td> <?php echo $post-> title ?> </td>
      <td> <?php echo $post-> description ?> </td>
      <td> <?php echo $post-> date_created ?> </td>
      <td>
<?php echo anchor("welcome/view/{$post->id}", 'View Item', ['class' => 'label label-info']);
?> 
<?php echo anchor("welcome/update/{$post->id}", 'Update Item', ['class' => 'label label-warning']);
?> 
<?php echo anchor("welcome/delete/{$post->id}", 'Delete Item', ['class' => 'label label-danger']);
?>		  
	  </td>
    </tr>
<?php endforeach; ?>
<?php else : ?>
    <tr>
      <td>No data Found</td>
	</tr>
<?php endif; ?>

   </tbody>
</table> 
</div>


<?php include_once('footer.php'); ?>