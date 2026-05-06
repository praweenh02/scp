<?php
class Groupmanager_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'document_expiry_date';
		$this->group = 'groups';
		$this->user_id = $this->session->userdata('user_id');



	}

	public function getAllMyGroups($user_id)
	{

		$query = $this->db->select('category.category_name,groups.group_title, group_managers.group_id, group_managers.*')->join('groups','group_managers.group_id=groups.group_id','left')->join('category','category.category_id=groups.category_id','INNER')->where('group_managers.member_id',$user_id)->get('group_managers')->result();
		return $query;
	}
	public function saveExpiryDate($value='')
	{

		$insert = $this->db->insert($this->table, $value);
		return $insert;
	}
	public function updateExpiryDate($value='', $documentexpirydate_id)
	{

		$update = $this->db->where('documentexpirydate_id',$documentexpirydate_id)->update($this->table, $value);
		return $update;
	}
	public  function getOneExpiryDate($documentexpirydate_id)
	{
		$query = $this->db->select('*')->where('documentexpirydate_id',$documentexpirydate_id)->get($this->table)->row();
		return $query;

	}
	public function getDocumntExpriyDate($group_id)
	{
		$current_date = date('Y-m-d');
		$query = $this->db->select('document_expiry_date.*, groups.group_title')->join('groups','document_expiry_date.group_id=groups.group_id','LEFT')->where('document_expiry_date.group_id',$group_id)->order_by('document_expiry_date.documentexpirydate_id','DESC')->get($this->table)->result();
		return $query;

	}
	public function deleteDocumentExpiryDate($documentexpirydate_id)
	{
		return $this->db->where('documentexpirydate_id', $documentexpirydate_id)->delete($this->table);

	}
	public function getActGroup($group_id)
	{
		$query = $this->db->select('groups.*, category.category_name')->join('category','groups.category_id=category.category_id')->where('group_id', $group_id)->get($this->group)->row();
		return $query;
	}
	public function UpdateGroup($value='', $group_id='')
	{

		$update = $this->db->where('group_id',$group_id)->update($this->group, $value);
		return $update;
	}

	public function getAllCorresponding($group_id)
	{

		$query = $this->db->select('*')->where('group_id',$group_id)->order_by('corresponding_id','DESC')->get('group_corresponding');
		return $query->result();


	}
	public function getOneCorresponding($corresponding_id, $group_id)
	{
		$query = $this->db->select('*')->where('corresponding_id',$corresponding_id)->where('group_id',$group_id)->get('group_corresponding');
		return $query->row();
	}

	public function saveCorresponding($value)
	{
		return $this->db->insert('group_corresponding',$value);

	}
	public function updateCorresponding($value,$corresponding_id)
	{
		return $this->db->where('corresponding_id',$corresponding_id)->update('group_corresponding',$value);

	}
	public  function deleteCorresponding($corresponding_id='')
	{
		return $this->db->where('corresponding_id',$corresponding_id)->delete('group_corresponding');
	}

	public function getAllManagementTeam($group_id)
	{
		$query = $this->db->select('*')->where('group_id',$group_id)->order_by('managementteam_id','DESC')->get('group_management_team');
		return $query->result();

	}
	public function getOneManagementTeam($managementteam_id,$group_id)
	{
		$query = $this->db->select('*')->where('managementteam_id',$managementteam_id)->where('group_id',$group_id)->get('group_management_team');
		return $query->row();


	}
	public function saveManagementTeam($value)
	{
		return $this->db->insert('group_management_team',$value);

	}
	public function updateManagementTeam($value,$managementteam_id)
	{
		return $this->db->where('managementteam_id',$managementteam_id)->update('group_management_team',$value);

	}
	public  function deleteManagementTeam($managementteam_id='')
	{
		return $this->db->where('managementteam_id',$managementteam_id)->delete('group_management_team');
	}
	public function getAllMeeting($group_id)
	{
		$query = $this->db->select('group_meeting.*, groups.group_title')->join('groups','group_meeting.group_id=groups.group_id','left')->order_by('group_meeting.meeting_id','DESC')->where('group_meeting.group_id',$group_id)->get('group_meeting')->result();
		return $query;


	}
	public function getAllNWGMeeting($group_id)
	{
	    	$query = $this->db->select('group_meeting.*, groups.group_title')->join('groups','group_meeting.group_id=groups.group_id','left')->where('meeting_type','nwg')->where('group_meeting.group_id',$group_id)->order_by('group_meeting.meeting_id','DESC')->get('group_meeting')->result();
		return $query;
	    
	}
	public function getActGroupMeeting($meeting_id,$user_id)
	{
		$query = $this->db->select('*')->where('meeting_id',$meeting_id)->order_by('meeting_id','DESC')->get('group_meeting')->row();
		return $query;


	}
	public function saveMeeting($value)
	{
		return $this->db->insert('group_meeting',$value);

	}
	public function updateMeeting($value,$meeting_id)
	{
		return $this->db->where('meeting_id',$meeting_id)->update('group_meeting',$value);

	}
	public function deleteMeeting($meeting_id)
	{
		return $this->db->where('meeting_id',$meeting_id)->delete('group_meeting');


	}
	//Work Item
	public function getAllWorkikgItem($group_id,$user_id)
	{
		$query = $this->db->select('work_item.*, groups.group_title')->join('groups','work_item.group_id=groups.group_id','left')->where('work_item.group_id',$group_id)->where('work_item.user_id',$user_id)->order_by('work_item.workitem_id','DESC')->get('work_item')->result();
		return $query;


	}
	public  function getOneWorkItem($workitem_id='',$group_id='')
	{
		return $this->db->select('*')->where('group_id',$group_id)->where('workitem_id',$workitem_id)->get('work_item')->row();
	}
	public function saveWorkItem($value)
	{
		return $this->db->insert('work_item',$value);

	}
	public function updateWorkItem($value,$workitem_id)
	{
		return $this->db->where('workitem_id',$workitem_id)->update('work_item',$value);

	}
	public function deleteWorkItem($workitem_id)
	{
		return $this->db->where('workitem_id',$workitem_id)->delete('work_item');

	}
	public function getAllMemberDocuments($group_id)
	{

		$query = $this->db->select('group_contributions.*, groups.group_title,users.name,users.surname')->join('groups','group_contributions.group_id = groups.group_id','left')->join('users','group_contributions.user_id=users.user_id','left')->where('group_contributions.delete','Y')->where('group_contributions.file_status','uploaded')->or_where('group_contributions.file_status','re-uploaded')->where('group_contributions.group_id',$group_id)->get('group_contributions');
		return $query->result();
	}
	public function getOneMemberDoc($sdo_id='',$group_id='', $contribution_id='' )
	{
		$query = $this->db->select('group_contributions.*, groups.group_title,category.category_name,group_meeting.meeting_title,questions.question_name,questions.question_no,working_parties.party_name,work_item.work_item')->join('groups','group_contributions.group_id = groups.group_id','left')->join('category','group_contributions.sdo_id=category.category_id','left')->join('group_meeting','group_contributions.meeting_id=group_meeting.meeting_id','left')->join('questions','group_contributions.question_id=questions.question_id','left')->join('working_parties','group_contributions.workingparty_id=working_parties.workingparty_id','left')->join('work_item','group_contributions.workitem_id=work_item.workitem_id','left')->where('group_contributions.sdo_id',$sdo_id)->where('group_contributions.group_id',$group_id)->where('group_contributions.contribution_id',$contribution_id )->get('group_contributions');
		return $query->row();
	}
	public function UpdateGroupManagerStatus($dataarray,$contribution_id)
	{

		$update = $this->db->where('contribution_id', $contribution_id)->update('group_contributions',$dataarray);
		return $update;
	}
	public function getAllWorkingGroups($group_id)
	{
		$current_date = date('Y-m-d');
		$query = $this->db->select('*')->where('group_id',$group_id)->where('meeting_status','Y')->where('meeting_type','itu')->order_by('meeting_id', 'DESC')->get('group_meeting');

		return $query->result();

	}
		public function getAllNWGWorkingGroups($group_id)
	{
		$current_date = date('Y-m-d');
  	    $query = $this->db->select('*')->where('group_id',$group_id)->where('meeting_status','Y')->where('meeting_type','nwg')->where('meeting_end_date <=',$current_date)->order_by('meeting_id', 'DESC')->get('group_meeting');

		return $query->result();

	}
	public function getOneGroupInformation($group_information_id,$group_id)
	{

		$query = $this->db->select('*')->where('group_information_id',$group_information_id)->where('group_id',$group_id)->get('group_information');
		return $query->row();
	}
	public function getAllGroupInformation($group_id,$user_id)
	{

		$query = $this->db->select('*')->where('user_id',$user_id)->where('group_id',$group_id)->order_by('group_information_id','DESC')->get('group_information');
		return $query->result();
	}
	
	public function saveGroupinformation($value)
	{
		return $this->db->insert('group_information',$value);

	}
	public function updateGroupinformation($value,$group_information_id)
	{
		return $this->db->where('group_information_id',$group_information_id)->update('group_information',$value);

	}
	public function deleteGroupinformation($group_information_id)
	{
		return $this->db->where('group_information_id',$group_information_id )->delete('group_information');

	}
	public function getAllOutcomeDocument($group_id)
	{
		$query  =  $this->db->select('*')->where('group_id',$group_id)->order_by('outcome_document_id','DESC')->get('outcome_documents');
		return $query->result();
	}
	public  function getOneOutcomeDocument( $outcome_document_id)
	{
		$query = $this->db->select('*')->where('outcome_document_id',$outcome_document_id)->get('outcome_documents');
		return $query->row();
	}
	public function saveOutcomeDocument($dataarray='')
	{
		return $this->db->insert('outcome_documents', $dataarray);
	}
	public  function updateOutcomeDocument($dataarray='', $outcome_document_id='')
	{
		return $this->db->where('outcome_document_id',$outcome_document_id)->update('outcome_documents',$dataarray);
	}
	public function deleteOutcomeDocument($outcome_document_id)
	{
		return $this->db->where('outcome_document_id',$outcome_document_id)->delete('outcome_documents');

	}
	public function getAllDocumentfromITU($group_id)
	{
	   $query = $this->db->select('*')->where('group_id',$group_id)->order_by('document_from_itu_id','DESC')->get('document_from_iut_site');
	   return $query->result();

	}
	public function getOneDocumentfromITU($doc_form_itu_id)
	{
		 $query = $this->db->select('*')->where('document_from_itu_id',$doc_form_itu_id)->get('document_from_iut_site');
		 return $query->row();


	}

	public function updateDocumentfromITU($dataarray,$document_from_itu_id)
	{
		return $this->db->where('document_from_itu_id',$document_from_itu_id)->update('document_from_iut_site',$dataarray);
	}

	public function saveDocumentfromITU($dataarray)
	{
		return $this->db->insert('document_from_iut_site',$dataarray);
	}
	public function deleteDocumentfromITU($document_from_itu_id)
	{
		return $this->db->where('document_from_itu_id',$document_from_itu_id)->delete('document_from_iut_site');


	}
	public function getAllMintuesofMeeting($group_id)
	{
	    
	    $query = $this->db->select('minutes_of_meeting.*,group_meeting.meeting_title')->join('group_meeting','minutes_of_meeting.meeting_id= group_meeting.meeting_id','left')->where('minutes_of_meeting.group_id',$group_id)->get('minutes_of_meeting')->result();
	    return $query;
	}
	public function saveMinutesofMeeting($dataarray)
	{
	    	return $this->db->insert('minutes_of_meeting',$dataarray);
	    
	    
	}
		public function updateminutesofMeeting($dataarray,$id)
	{
	    	return $this->db->where('minutesofmeeting_id',$id)->update('minutes_of_meeting',$dataarray);
	    
	    
	}
	public function oneMinuteofmeeting($minutesofmeeting_id)
	{
	    $query = $this->db->select('*')->where('minutesofmeeting_id',$minutesofmeeting_id)->get('minutes_of_meeting
')->row();
return $query;
	    
	}
	public function getAllCirculars($group_id)
	{
         $query = $this->db->select('*')->where('group_id',$group_id)->get('circulars')->result();
         return $query;
	}
	public function getOneCirculars($circular_id)
	{
	    $query = $this->db->select('*')->where('circulars_id',$circular_id)->get('circulars')->row();
         return $query;
	    
	}
	public function updateCircular($dataarray,$circular_id)
	{
	    return $this->db->where('circulars_id',$circular_id)->update('circulars',$dataarray);
	}
		public function saveCircular($dataarray)
	{
	    return $this->db->insert('circulars',$dataarray);
	}
	
	
	
	
	


}