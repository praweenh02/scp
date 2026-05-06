<?php 
class GroupBulletin_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'group_bulletin';
		$this->user_id = $this->session->userdata('user_id');
		
    }


    public function getOneGroupBulletin($groupbulletin_id)
	{
		$query = $this->db->select('*')->where('groupbulletin_id',$groupbulletin_id)->order_by('groupbulletin_id','DESC')->get('group_bulletin')->row();
		return $query;


	}
	public function getAllGroupBulletin($group_id)
	{
		$query = $this->db->select('*')->where('group_id',$group_id)->order_by('groupbulletin_id','DESC')->get('group_bulletin')->result();
		return $query;


	}
	public function save_data($value)
	{
		  $insert = $this->db->insert($this->table , $value);
         return $insert;

	}
		public function update_data($value,$groupbulletin_id)
	{
		  $insert = $this->db->where('groupbulletin_id',$groupbulletin_id)->update($this->table , $value);
         return $insert;

	}
	public function delete_data($groupbulletin_id)
	{
		$delete = $this->db->where('groupbulletin_id',$groupbulletin_id)->delete($this->table);	
       return $delete;	


	}

}


?>