<?php

class Welcome extends CI_Controller {
	
	public function index()
		{
		$this->load->library('session');
		$this->load->model('queries');
		$posts= $this->queries->getPost();
		$this->load->view('welcome_message',['posts' => $posts]);
	}
	
	public function create()
		{
		$this->load->view('create');
		
	}

	public function update($id)
		{
		$this->load->model('queries');
		$post =$this->queries->getSinglePost($id);
		$this->load->view('update',['post' => $post]);
		
	}	
	public function delete($id)
		{
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
	public function view($id)
		{

					$this->load->model('queries');
		$post =$this->queries->getSinglePost($id);
		$this->load->view('view',['post' => $post]);
 
		
	}

	public function save()
		{
			

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
		$res =$this->queries->addPost($data);
	
			if($res) 
			{
				$this->session->set_flashdata('msg','post save');
				
			}
			else
			{
				$this->session->set_flashdata('msg','post fail to save');
			}
			return redirect('welcome');
		}
		else{
			$this->load->view('create');
		}
		
		
		
	}



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
}
