<?php
class Member_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'users';
		$this->superadmin_id = $this->session->userdata('user_id');

   

	}

	public  function getAllnewRecommendUserList($value='')
	{
		$query = $this->db->select('users.*,category.category_name,groups.group_title')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','INNER')->where('users.user_type','member')->where('users.suerp_admin_status','')->order_by('users.user_id','DESC')->get('users');
		return $query->result();
	}
	public function getrecommeduserDetails($user_id='')
	{
		$query = $this->db->select('users.*,category.category_name,groups.group_title, users.status as status1')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','INNER')->where('users.user_id',$user_id)->order_by('users.user_id','DESC')->get('users');
		return $query->row();
		 
	}
	public function getAllMember($group_id='')
	{
				$query = $this->db->select('users.*,category.category_name,groups.group_title,users.status as status1')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','left')->where('users.group_id',$group_id)->where('users.verified_email','Y')->where('users.suerp_admin_status',NULL)->order_by('users.user_id','DESC')->get('users');
		       return $query->result();
	}
	public function getAllGroupMember($group_id='')
	{
		$query = $this->db->select('users.*,category.category_name,groups.group_title,users.status as status1')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','left')->where('users.group_id',$group_id)->where('users.verified_email','Y')->where('users.group_manager_recommend_status','Y')->order_by('users.user_id','DESC')->get('users');
		       return $query->result();

	}
	public function getAllWorkingGroup($category_id)
	{

         $insert = $this->db->select('*')->where('category_id',$category_id)->where('status','Y')->get('groups')->result();
         return $insert;
	}
	
	

	public  function update_data($value='',$user_id='')
	{
		 $update = $this->db->where('user_id',$user_id)->update($this->table , $value);
         return $update;
	}
	public function getAllMyGroups($user_id,$group_id)
	{

		$query = $this->db->select('category.category_name,category.category_id,groups.group_title,groups.group_name, group_managers.group_id, group_managers.*')->join('groups','group_managers.group_id=groups.group_id','left')->join('category','category.category_id=groups.category_id','INNER')->where('group_managers.member_id',$user_id)->where('group_managers.group_id',$group_id)->get('group_managers')->result();
		return $query;
	}
	public function getActGroup($group_id='')
	{
		return $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
	}
	
	
	


}