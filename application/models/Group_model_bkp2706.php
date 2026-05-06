<?php

class Group_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'groups';
		$this->coordinator = 'coordinator';
		$this->user_id = $this->session->userdata('user_id');
		$this->user_type = 'student';

   

	}
	public function save_data($value='')
	{

         $insert = $this->db->insert($this->table , $value);
         return $insert;
	}
	public function getAllGroup()
	{

		$query = $this->db->select('*')->order_by('group_id','DESC')->get('groups')->result();
		return $query;
	}
	public function getOneGroup($group_id)
	{

		$query = $this->db->select('groups.*,category.category_name')->join('category','groups.category_id= category.category_id','left')->where('group_id', $group_id)->get($this->table)->row();
		return $query;
	}
	public  function update_data($value='',$group_id='')
	{
		 $update = $this->db->where('group_id',$group_id)->update($this->table , $value);
         return $update;
	}
	public  function delete_data($group_id='')
	{
       $delete = $this->db->where('group_id',$group_id)->delete($this->table);	
       return $delete;	

	}
	

	
	
	
	public  function getAllQuestion($group_id='')
	{
		$query = $this->db->select('*')->where('group_id',$group_id)->where('question_status','Y')->get('questions');
		return $query->result();
	}
	public  function getAllMeeting($group_id='')
	{
		$query = $this->db->select('group_meeting.*')->join('document_expiry_date','document_expiry_date.meeting_id=group_meeting.meeting_id','inner')->where('group_meeting.group_id',$group_id)->where('group_meeting.meeting_status','Y')->order_by('group_meeting.meeting_id','DESC')->limit(1)->get('group_meeting');
		return $query->result();
	}
	public function getAllWorkItem($group_id='')
	{
			$query = $this->db->select('*')->where('group_id',$group_id)->where('work_item_status','Y')->get('work_item');
		return $query->result();


	}
	public function savefileReg($dataarray)
	{

		$insert =  $this->db->insert('group_contributions',$dataarray);
		return $this->db->insert_id();

	}
	public function LastRegNo($sdo_id, $group_id, $contribution_id)
	{
		$query = $this->db->select('*')->where('group_id',$group_id)->where('contribution_id',$contribution_id)->get('group_contributions');
		return $query->row();


	}
	public function getAllWorkingParty($sdo_id,$group_id)
	{
		$query = $this->db->select('*')->where('sdo_id',$sdo_id)->where('group_id',$group_id)->get(' working_parties');
		return $query->result();

	}
	public function getAllDocRegistion($group_id)
	{
		$query = $this->db->select('group_contributions.*, groups.group_title')->join('groups','group_contributions.group_id = groups.group_id','left')->where('group_contributions.file_status','blank')->where('group_contributions.group_id',$group_id)->where('delete','Y')->get('group_contributions');
		return $query->result();

	}
	public function deleteDocRegistration($contribution_id)
	{
		return $this->db->set('delete','N')->where('contribution_id',$contribution_id)->update('group_contributions');


	}
	public function getActContribution($sdo_id,$group_id,$contribution_id)
	{
      
      return $this->db->select('*')->where('sdo_id',$sdo_id)->where('group_id',$group_id)->where('contribution_id',$contribution_id)->get('group_contributions')->row();

	}
	public function getActContributor($contribution_id)
	{
		$query  =  $this->db->select('*')->where('contribution_id',$contribution_id)->get('group_contributors');
		return $query->result();

	}
	public function updatefileReg($dataarray,$contribution_id)
	{
		return $this->db->where('contribution_id',$contribution_id)->update('group_contributions',$dataarray);
	}
	public function deleteContributer($contributer_id)
	{

		return $this->db->where('contributor_id',$contributer_id)->delete('group_contributors');
	}
	public function docFileUpload($dataarray,$sdo_id, $group_id,$contribution_id )
	{

		return $this->db->where('sdo_id',$sdo_id)->where('group_id',$group_id)->where('contribution_id',$contribution_id )->update('group_contributions',$dataarray);
	}
	public function getDownloadFile($sdo_id, $group_id, $contribution_id)
	{
			return $this->db->select('*')->where('sdo_id',$sdo_id)->where('group_id',$group_id)->where('contribution_id',$contribution_id)->get('group_contributions')->row();


	}
	public function getAllMemberUploadeddoc($group_id,$user_id)
	{
		 $query = $this->db->select('group_contributions.*, groups.group_title')->join('groups','group_contributions.group_id = groups.group_id','left')->where('file_status','uploaded')->where('group_contributions.group_id',$group_id)->where('group_contributions.user_id',$user_id)->where('delete','Y')->get('group_contributions');
		 return $query->result();

	}
	public function getAllmemberDocfile($group_id)
	{
		 $gm_status = 'reject';
		 $query = $this->db->select('group_contributions.*, groups.group_title,group_meeting.meeting_title,users.name,users.surname,questions.question_no,questions.question_name')->join('groups','group_contributions.group_id = groups.group_id','left')->join('group_meeting','group_contributions.meeting_id=group_meeting.meeting_id','left')->join('users','group_contributions.user_id=users.user_id','left')->join('questions','group_contributions.question_id=questions.question_id','left')->where('group_contributions.group_id',$group_id)->where('group_contributions.file_status=','uploaded')->where('group_contributions.group_manager_status!=', 'reject')->order_by('group_contributions.contribution_id','DESC')->where('group_contributions.delete','Y')->get('group_contributions');
		return $query->result();

	}
	public function getAllgroupFileList($sdo_id, $group_id,$contribution_id)
	{
		 $query = $this->db->select('old_group_contriboution_file.*, group_contributions.title')->join('group_contributions','old_group_contriboution_file.contribution_id=group_contributions.contribution_id')->where('old_group_contriboution_file.contribution_id',$contribution_id)->where('old_group_contriboution_file.group_id',$group_id)->where('old_group_contriboution_file.sdo_id',$sdo_id)->order_by('old_group_contriboution_file.old_file_id','DESC')->get('old_group_contriboution_file');

		 return $query->result();


	}
	public function insertContributionOldfile($dataarray2)
	{
		$insert = $this->db->insert('old_group_contriboution_file',$dataarray2);
		return $insert;


	}
	public function getAllActSDOBulletin($group_id)
	{

		//$query = $this->db->query("Select public_sdo_bulletin.*, groups.group_title,category.category_name from public_sdo_bulletin left join groups ON public_sdo_bulletin.group_id = groups.group_id left join category ON  public_sdo_bulletin .sdo_id = category.category_id where public_sdo_bulletin.bulletin_status='Y' order by public_sdo_bulletin.sdobulletin_id");
		$query = $this->db->select("*")->where('group_id',$group_id)->order_by('groupbulletin_id','DESC')->get('group_bulletin');
		return $query->result();
		//return $query->result();
	}

	public function getAllOutcomeDocumnts($group_id)
	{
		 $query = $this->db->select('outcome_documents.*, groups.group_title, group_meeting.meeting_title,group_meeting.meeting_date')->join('groups', 'outcome_documents.group_id=groups.group_id','left')->join('group_meeting','outcome_documents.meeting_id=group_meeting.meeting_id','left')->where('outcome_documents.outcomedocument_staus','Y')->where('outcome_documents.group_id',$group_id)->order_by('outcome_documents.outcome_document_id','DESC')->get('outcome_documents');
		  return $query->result();
	}
	public function getAllminuteofmeeting($group_id)
	{
		  $query = $this->db->select('*')->where('group_id',$group_id)->where('minutes_of_meeting_status','Y')->get('minutes_of_meeting');
		   return $query->result();
	}
	public function getAllDocumentfromITUsite($group_id)
	{

		$query =  $this->db->select('document_from_iut_site.*, groups.group_title, group_meeting.meeting_title,group_meeting.meeting_date')->join('groups', 'document_from_iut_site.group_id=groups.group_id','left')->join('group_meeting','document_from_iut_site.meeting_id=group_meeting.meeting_id','left')->where('document_from_iut_site.group_id',$group_id)->where('document_from_iut_site.document_status','Y')->get('document_from_iut_site');
		return $query->result();

	}
	public function getALlCirculars($group_id)
	{
	   return  $this->db->where('group_id',$group_id)->where('circulars_status','Y')->order_by('circulars_id','DESC')->get('circulars')->result();
	    
	}
	
	
	
	
	
}


?>