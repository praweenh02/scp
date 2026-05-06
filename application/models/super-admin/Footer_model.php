<?php

class Footer_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'questions';
		//$this->coordinator = 'coordinator';
		$this->superadmin_id = $this->session->userdata('superadmin_id');

   

	}
	

	
	public function getFooter()
	{
		$query = $this->db->select('*')->order_by('footer_id','DESC')->limit('1')->get('footer_management')->row();
		return $query;


	}
	public function insertFooter($value)
	{
		  $insert = $this->db->insert('footer_management' , $value);
         return $insert;

	}
	public function updateFooter($dataarray, $footer_id)
	{
		  $insert = $this->db->where('footer_id',$footer_id)->update('footer_management' , $dataarray);
         return $insert;

	}

	
	
	
	
	
}


?>