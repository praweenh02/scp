<?php 
class Faq_model extends CI_model
{
    public function __construct()
	{
      	parent::__construct();
		$this->table = 'faq';
		//$this->coordinator = 'coordinator';
		$this->superadmin_id = $this->session->userdata('superadmin_id');
	}
	
	public function getOneQuestion($faq_id)
	{
		$query = $this->db->select('*')->where('faq_id',$faq_id)->get($this->table)->row();
		return $query;


	}
	public function getAllQuestion()
	{
		$query = $query = $this->db->select('*')->order_by('faq_id','DESC')->get($this->table)->result();
		return $query;


	}
	public function save_data($value)
	{
		  $insert = $this->db->insert($this->table , $value);
         return $insert;

	}
		public function update_data($value,$faq_id)
	{
		  $insert = $this->db->where('faq_id',$faq_id)->update($this->table , $value);
         return $insert;

	}
	public function delete_data($faq_id)
	{
		$delete = $this->db->where('faq_id',$faq_id)->delete($this->table);	
       return $delete;	


	}

}


?>