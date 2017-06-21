//.htaccess
Options +FollowSymLinks
Options -Indexes
DirectoryIndex index.php
  RewriteEngine On
  RewriteCond $1 !^(index\.php|assests|images|css|js|install|robots\.txt|favicon\.ico)
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule ^(.*)$ index.php?/$1 [L]
  
//autoLoad
  $autoload['libraries'] = array('database', 'session','form_validation');
  $autoload['helper'] = array('url', 'form', 'html');
 
//config   
  $config['base_url'] = "http://".$_SERVER['HTTP_HOST'];
  $config['base_url'] .= preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])).'/';
  $config['encryption_key'] = '123456789';
  
//bosstrap   
  
  https://bootswatch.com/flatly/#tables
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">

//controller
		$this->load->library('session');
		$this->load->library('form_validation');
//view
		<?php include_once('header.php'); ?>
		<?php include_once('footer.php'); ?>
		<?php echo anchor('welcome','< < - Go To Main Page',['class'=> 'btn btn-info']);?>   
   
		
//select function 
(controller)
		$this->load->model('queries');
		$posts= $this->queries->getPost();
		$this->load->view('welcome_message',['posts' => $posts]);	
	
(model)	
	public function getPost()
	{
		$query= $this->db->get('tbl_posts');
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			//no data
		}
	}	
	
(view)
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


//insert
(controller)
	public function save(){
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('title', 'Titel', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if($this ->form_validation->run()){
			
		$data = $this->input->post();
		$today=date('Y-m-d');
		$data['date_created']=$today;
		unset($data['submit']);			
		$this->load->model('queries');
		$res =$this->queries->addPost($data);
	
			if($res){
				$this->session->set_flashdata('msg','post save');
			}
			else{
				$this->session->set_flashdata('msg','post fail to save');
			}
			return redirect('welcome');
		}
		else{
			$this->load->view('create');
		}
	}
(model)
	public function addPost($data){
		return $this->db->insert('tbl_posts',$data);
	}
(view)	
 <div>
    <?php echo form_open('welcome/save',['class' => 'form-horizontal']);  ?>
 
        <?php  
        $data = array(
        'type'  => 'text',
        'name'  => 'title',
        'id'    => 'title',
        'class' => 'form-control'
        );

        echo form_input($data);
        ?>

<?php echo form_error('title', '<div class="text-danger">', '</div>'); ?>

        <?php  
        $data = array(
        'name'  => 'description',
        'id'    => 'description',
        'placehoder' => 'Description',
        'class' => 'form-control'
        );

        echo form_textarea($data);
        ?>        
 
<?php echo form_error('description', '<div class="text-danger">', '</div>'); ?>
 
 
<?php echo form_reset([ 'class'=> 'btn btn-default','name' => 'Cancel','value' => 'Cancel']); ?>
<?php echo form_submit(['name' => 'submit','value' => 'Submit','class'=> 'btn btn-primary']);?>       

<?php echo form_close();  ?>

//delete
(model)
    public function deletePost($id){
		return $this->db->delete('tbl_posts',['id'=>$id]);
    }
(view)
<?php echo anchor("welcome/delete/{$post->id}", 'Delete Item', ['class' => 'label label-danger']);
?>	
(controller)
	public function delete($id){
		$this->load->library('session');
 		$this->load->model('queries');
		$post =$this->queries->deletePost($id);
		if($post){
			$this->session->set_flashdata('msg',"post deleted id was $id");
		}else{
			$this->session->set_flashdata('msg','post deleted failed');
		}
		redirect('welcome');
	}

//search
(model)
	public function getSinglePost($id){
		$query= $this->db->get_where('tbl_posts',array('id'=>$id));
		if($query->num_rows() > 0){
			return $query->row();
		}
	}
(controller)
	public function view($id){
		$this->load->model('queries');
		$post =$this->queries->getSinglePost($id);
		$this->load->view('view',['post' => $post]);
	}
(view)
<?php echo anchor("welcome/view/{$post->id}", 'View Item', ['class' => 'label label-info']);
?> 
 <?php echo $post->title ?></h4>

//update
(controller)
	public function change($id){
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('title', 'Titel', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if($this ->form_validation->run())
		{
		
		$data = $this->input->post();
		$today=date('Y-m-d');
		$data['date_created']=$today;
		unset($data['submit']);			
		$this->load->model('queries');
		$res =$this->queries->updatePost($data,$id);
	
			if($res) 
			{
				$this->session->set_flashdata('msg','post update');
				
			}
			else
			{
				$this->session->set_flashdata('msg','post fail to update');
			}
			return redirect('welcome');
		}
		else{
			$this->load->view('update');
		}


	}
(view)

    <?php echo form_open("welcome/change/{$post->id}",['class' => 'form-horizontal']);  ?>

        <?php  
        $data = array(
        'type'  => 'text',
        'name'  => 'title',
        'id'    => 'title',
        'value' => $post->title,
        'class' => 'form-control'
        
        );

        echo form_input($data);
        ?>

<?php echo form_error('title', '<div class="text-danger">', '</div>'); ?>

        <?php  
        $data = array(
        'name'  => 'description',
        'id'    => 'description',
        'value' => $post->description,
        'placehoder' => 'Description',
        'class' => 'form-control'
        );

        echo form_textarea($data);
        ?>        

<?php echo form_error('description', '<div class="text-danger">', '</div>'); ?>
 
<?php echo form_reset([ 'class'=> 'btn btn-default','name' => 'Cancel','value' => 'Cancel']); ?>
<?php echo form_submit(['name' => 'submit','value' => 'Update','class'=> 'btn btn-primary']);?>       
<?php echo form_close();  ?>

(model)
	public function updatePost($data,$id){
	$this->db->where('id',$id);
	if($this->db->update('tbl_posts',$data)){
        return true;
    }else{
        return false;
    }
	}
	
	
	
	
	
	
	
//model
$username = $this->input->post('username');
$password = $this->input->post('password');
$this->load->model('registermodel');
$this->registermodel->registeruser($username,$password);

//model
return $this->db->insert('users',['username'=>$username,'password'=>$password]);

		$this->form_validation->set_rules('description', 'Description', 'required|is_unique[users.username]');

		
//session set
$this->session->set_userdata('name',value);
//session get
$user = $this->session->userdata('name');
echo $user


//ifelse
<?php if($this->session->userdata('userid')): ?>
<?php echo anchor('login/logout','login'); ?>
<?php else: ?>
<?php echo anchor('register','regiter'); ?>
<?php endif ?>
