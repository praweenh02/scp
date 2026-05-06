<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Outreach_model extends CI_model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->table = 'group_bulletin';
		$this->user_id = $this->session->userdata('user_id');
		$this->group_id = $this->session->userdata('group_id');
	}

	public function getAllOutreach()
	{
		$query = $this->db->select('email_subscription.*, COUNT(email_subscription.emai_subscription_id) as total_users, groups.group_title')->join('groups','email_subscription.group_id=groups.group_id','left')->where('email_subscription.group_id',$this->group_id)->group_by('email_subscription.group_id')->get('email_subscription');
		return $query;
	}
	public function getAllWebsiteSubscriberslist()
	{
	   $query =  $this->db->select('email_subscription.*, groups.group_title,groups.shortform')->join('groups','email_subscription.group_id=groups.group_id','left')->where('email_subscription.user_id',0)->where('email_subscription.email_verify','Y')->get('email_subscription')->result();
	   return $query;
	    
	}
	public function getAllSdo()
	{
	    $query = $this->db->select('*')->where('category_status','Y')->get('category')->result();
	    return $query;
	}



}
?>