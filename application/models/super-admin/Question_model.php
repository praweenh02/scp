<?php

class Question_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'questions';
		//$this->coordinator = 'coordinator';
		$this->superadmin_id = $this->session->userdata('superadmin_id');

   

	}
	

	public function getOneQuestion($question_id)
	{
		$query = $this->db->select('questions.*, category.category_name, groups.group_title')->join('category','questions.sdo_id=category.category_id','left')->join('groups','questions.group_id=groups.group_id')->where('questions.question_id',$question_id)->get('questions')->row();
		return $query;


	}
	public function getAllQuestion()
	{
		$query = $this->db->select('questions.*, category.category_name, groups.group_title')->join('category','questions.sdo_id=category.category_id','left')->join('groups','questions.group_id=groups.group_id')->order_by('questions.question_id','DESC')->get('questions')->result();
		return $query;


	}
	public function save_data($value)
	{
		  $insert = $this->db->insert($this->table , $value);
         return $insert;

	}
		public function update_data($value,$category_id)
	{
		  $insert = $this->db->where('question_id',$category_id)->update($this->table , $value);
         return $insert;

	}
	public function delete_data($question_id)
	{
		$delete = $this->db->where('question_id',$question_id)->delete($this->table);	
       return $delete;	


	}

	
	
	
}


?>