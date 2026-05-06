<?php

class Dashboard_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'groups';
		$this->table1 = 'document_expiry_date';
		$this->user_id = $this->session->userdata('user_id');
		

   

	}


	public function getActiveGroup ($group_id)
	{

		$query = $this->db->select('*')->where('status','Y')->where('group_id',$group_id)->get($this->table);
		return $query->row();


	}
	public function getDocumentExpiryDate($group_id)
	{
		return $this->db->select('*')->where('group_id',$group_id)->where('status','Y')->order_by('documentexpirydate_id','DESC')->limit('1')->get($this->table1)->row_array();

	}
	public function getAllMeetings()
	{
		$current_date = date('Y-m-d');

		$query = $this->db->select('group_meeting.*, groups.group_title,groups.category_id')->join('groups','group_meeting.group_id=groups.group_id','left')->where('group_meeting.meeting_status','Y')->get('group_meeting');
		return $query->result();
	}
	public function get_event_list()
	{

		$this->db->select("group_meeting.meeting_id, group_meeting.meeting_title,group_meeting.meeting_date,group_meeting.meeting_end_date, groups.group_title")->join('groups','group_meeting.group_id=groups.group_id','left')->where('group_meeting.meeting_status','Y')->order_by('group_meeting.meeting_id','DESC');
           $query = $this->db->get('group_meeting');
        if ($query) {
            return $query->result();
        }
        return NULL;
	}

}

?>


