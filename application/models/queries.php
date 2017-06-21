<?php


class queries extends CI_Model{
	
	
	
	
	public function getPost()
	{
		
		$query= $this->db->get('tbl_posts');
		
		if($query->num_rows() > 0){
			
			return $query->result();
			
		}
		else{
			
			//n			o data
		}
		
	}
	
	
	public function addPost($data)
	{
		
		// 		echo $data;
		
		return $this->db->insert('tbl_posts',$data);
		
	}
	
	
	public function getSinglePost($id)
	{
		
		// 		echo $data;
		
		$query= $this->db->get_where('tbl_posts',array('id'=>$id));
		
		if($query->num_rows() > 0){
			
			return $query->row();
			
		}
		
	}
	
	
	public function updatePost($data,$id){
	
	$this->db->where('id',$id);
	if($this->db->update('tbl_posts',$data)){
        return true;
    }else{
        return false;
    }
    
		
	}
	
    public function deletePost($id){

 return $this->db->delete('tbl_posts',['id'=>$id]);
    }
	
	
}

