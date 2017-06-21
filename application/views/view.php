<?php include_once('header.php'); ?>


    <?php echo anchor('welcome','< < - Go To Main Page',['class'=> 'btn btn-info']);?>   
    <br>

    
    <div class="container">
    <h3>View Post</h3>
    <h4>Title : <?php echo $post->title ?></h4>
    <p>Description : <?php echo $post->description ?></p>
    <p>Date : <?php echo $post->date_created ?></p>
    </div>
<?php include_once('footer.php'); ?>