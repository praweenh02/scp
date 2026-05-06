<?php

class Home_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'groups';
		$this->coordinator = 'coordinator';
		$this->user_id = $this->session->userdata('user_id');
		$this->user_type = 'student';

   

	}
	public function getAllWorkingGroup($category_id)
	{

         $insert = $this->db->select('*')->where('category_id',$category_id)->where('status','Y')->order_by('display_order','ASC')->get('groups')->result();
         return $insert;
	}
	public function getAllCatgory()
	{
		$query = $this->db->select('*')->where('category_status','Y')->get('category')->result();
         return $query;


	}
	public function save_signup($value='',$email,$otp)
	{
		$insert= $this->db->insert('temp_users',$value);
		$insert1 = $this->db->set('email',$email)->set('otp',$otp)->insert('otp');
		return $insert1;
	}
	public function Checkemailexit($email)
	{
		$query = $this->db->select('*')->where('email',$email)->where('verified_email','Y')->where('suerp_admin_status','accepted')->where('group_manager_recommend_status','Y')->get('users')->num_rows();
	    return $query;

		
	}
	public function verify_email($email,$otp)
	{
		$count1 = $this->db->select('*')->where('email',$email)->where('otp',$otp)->where('status','pending')->get('otp')->num_rows();

		if($count1)
		{
            $update1 =  $this->db->set('status','expire')->where('email',$email)->update('otp');
            $update2 =  $this->db->where('email',$email)->set('verified_email','Y')->update('temp_users');
            return $update1;


		}else
		{
			return false;

		}
	}
	
	public function resendotp($email,$otp)
	{
	    $insert = $this->db->set('email',$email)->set('otp',$otp)->set('status','pending')->insert('otp');
	        $ids =  $this->db->insert_id();
	    
	    //$count1 = $this->db->select('*')->where('email',$email)->where('otp',$otp)->where('status','pending')->get('otp')->num_rows();
	    
	         

		if($ids)
		{
		    
            $update1 =  $this->db->where('otp_id!=', $ids)->where('email',$email)->set('status','expire')->update('otp');
            
            return TRUE;


		}else
		{
			return FALSE;

		}
	    
	    
	}
	
	public function getAllSDO()
	{
			$query = $this->db->select('*')->where('category_status','Y')->order_by('category_id','DESC')->get('category')->result();
			return $query;


	}
	public function getAllLatestWorkingGroups()
	{
		    $query = $this->db->select('*')->where('status','Y')->order_by('display_order','ASC')->get('groups')->result();
         return $query;

	}
	public  function sdoDetails($sdo_id='')
	{
		$query = $this->db->select('*')->where('category_id',$sdo_id)->get('category')->row();
		return $query;
	}
	public function getLatestWorkingGroups($sdo_id)
	{
          $query = $this->db->select('*')->where('category_id',$sdo_id)->where('status','Y')->order_by('group_id','DESC')->limit('10')->get('groups')->result();
         return $query;

	}
	public function getGroupsDetails($group_id)
	{
		          $query = $this->db->select('*')->where('group_id',$group_id)->where('status','Y')->get('groups')->row();
                 return $query;


	}
	public function getAllCorresponding($group_id)
	{
		return $this->db->select('*')->where('group_id',$group_id)->where('corrseponding_status','Y')->order_by('corresponding_id','ASC')->get('group_corresponding');


	}
	public function getAllManagementTeam($group_id)
	{
		return $this->db->select('*')->where('group_id',$group_id)->where('managementteam_status','Y')->order_by('managementteam_id','ASC')->get('group_management_team');


	}
	public function getAllMeeting($group_id)
	{
			
		return $this->db->select('*')->where('group_id',$group_id)->where('meeting_status','Y')->where('meeting_type','nwg')->order_by('meeting_id','DSC')->get('group_meeting');

	}
	public function getAllSDOBulletin()
	{

		$query = $this->db->select('*')->where('bulletin_status','Y')->order_by('sdobulletin_id','DESC')->limit('10')->get('public_sdo_bulletin');

		return $query->result();
	}
    public function getAllFaqs()
    {
        $query = $this->db->select('*')->where('faq_status','Y')->order_by('faq_id','ASC')->get('faq');
        return $query->result();
        
    }
    public function getAllGroupInformation($group_id)
    {
        
        $qury  = $this->db->select('*')->where('group_information_status','Y')->where('group_id',$group_id)->get('group_information');
        return $qury;
    }
    public function setToken($member_id, $token)
    {
       return  $this->db->set('token',$token)->where('user_id',$member_id)->update('users');
        
    }
     public function getAllWhatsnew()
    {
    	$query = $this->db->select('*')->where('whatsnew_status','Y')->order_by('whatsnew_id','DESC')->limit('10')->get('whats_new');
    	  return $query->result();
    }
    public function getGroupBulletion($group_id)
    {
        $query = $this->db->select('*')->where('group_id',$group_id)->get('group_bulletin')->result();
        return $query;
    }
	


		

	
}	
