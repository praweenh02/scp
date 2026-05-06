<?php

class Meeting_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'groups';
		$this->coordinator = 'coordinator';
		$this->superadmin_id = $this->session->userdata('superadmin_id');

   

	}
	public function save_data($value='')
	{

         $insert = $this->db->insert($this->table , $value);
         //$insert_id = $this->db->insert_id();
         return $insert;
	}
	public function allmeeting()
	{

			$query = $this->db->select('group_meeting.*, groups.group_title')->join('groups','groups.group_id=group_meeting.group_id','left')->order_by('group_meeting.meeting_id','DESC')->get('group_meeting');
			return $query->result();
	}
		public function getOneMeeting($meeting_id)
	{

			$query = $this->db->select('group_meeting.*, groups.group_title')->join('groups','groups.group_id=group_meeting.group_id','left')->where('group_meeting.meeting_id',$meeting_id)->order_by('group_meeting.meeting_id','DESC')->get('group_meeting');
			return $query->row();
	}
	public function delete_data($meeting_id)
	{
	    $delete = $this->db->where('meeting_id',$meeting_id)->delete('group_meeting');
	    return $delete;
	}
		public function getAllMyGroups()
	{

		$query = $this->db->select('category.category_name,groups.group_title, group_managers.group_id, group_managers.*')->join('groups','group_managers.group_id=groups.group_id','left')->join('category','category.category_id=groups.category_id','INNER')->get('group_managers')->result();
		return $query;
	}
	public function updateMeeting($value,$meeting_id)
	{
		return $this->db->where('meeting_id',$meeting_id)->update('group_meeting',$value);

	}




	
	
	
}


?>