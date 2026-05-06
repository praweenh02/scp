<?php 
class Sdobulletin_model extends CI_model
{
    public function __construct()
	{
      	parent::__construct();
		$this->table = 'public_sdo_bulletin';
		//$this->coordinator = 'coordinator';
		$this->superadmin_id = $this->session->userdata('superadmin_id');
	}
	
	public function getOneQuestion($sdobulletin_id)
	{
		$query = $this->db->select('public_sdo_bulletin.*, category.category_name, groups.group_title')->join('category','public_sdo_bulletin.sdo_id=category.category_id','left')->join('groups','public_sdo_bulletin.group_id=groups.group_id')->where('public_sdo_bulletin.sdobulletin_id',$sdobulletin_id)->get('public_sdo_bulletin')->row();
		return $query;


	}
	public function getAllQuestion()
	{
		$query = $this->db->select('public_sdo_bulletin.*, category.category_name, groups.group_title')->join('category','public_sdo_bulletin.sdo_id=category.category_id','left')->join('groups','public_sdo_bulletin.group_id=groups.group_id')->order_by('public_sdo_bulletin.sdobulletin_id','DESC')->get('public_sdo_bulletin')->result();
		return $query;


	}
	public function save_data($value)
	{
		  $insert = $this->db->insert($this->table , $value);
         return $insert;

	}
		public function update_data($value,$sdobulletin_id)
	{
		  $insert = $this->db->where('sdobulletin_id',$sdobulletin_id)->update($this->table , $value);
         return $insert;

	}
	public function delete_data($sdobulletin_id)
	{
		$delete = $this->db->where('sdobulletin_id',$sdobulletin_id)->delete($this->table);	
       return $delete;	


	}

}


?>