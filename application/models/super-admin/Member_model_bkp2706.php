<?php
class Member_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'users';
		$this->superadmin_id = $this->session->userdata('superadmin_id');

   

	}

	public  function getAllnewRecommendUserList($value='')
	{
		$query = $this->db->select('users.*,category.category_name,groups.group_title')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','INNER')->where('users.user_type','member')->where('users.suerp_admin_status',NULL)->where('group_manager_recommend_status','Y')->order_by('users.user_id','DESC')->get('users');
		return $query->result();
	}
	public function getrecommeduserDetails($user_id='')
	{
		$query = $this->db->select('users.*,category.category_name,groups.group_title, users.status as status1')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','INNER')->where('users.user_id',$user_id)->order_by('users.user_id','DESC')->get('users');
		return $query->row();
		 
	}
	public function getAllMember($value='')
	{
				$query = $this->db->select('users.*,category.category_name,groups.group_title,groups.shortform,users.status as status1')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','INNER')->where('users.user_type','member')->where('group_manager_recommend_status','Y')->where('suerp_admin_status','accepted')->order_by('users.user_id','DESC')->get('users');
		       return $query->result();
	}
	public function getAllWorkingGroup($category_id)
	{

         $insert = $this->db->select('*')->where('category_id',$category_id)->where('status','Y')->get('groups')->result();
         return $insert;
	}
	
	public function getAllSDO()
	{
		$query = $this->db->select('*')->where('category_status','Y')->get('category')->result();
         return $query;


	}
	public  function getAllGroupManager($value='')
	{
			$query = $this->db->select('users.*,group_managers.*,groups.group_title,groups.shortform,groups.group_id,users.status as status1')->join('users','group_managers.member_id=users.user_id','INNER')->join('groups','group_managers.group_id=groups.group_id','left')->where('users.suerp_admin_status','accepted')->where('group_manager_recommend_status','Y')->order_by('users.user_id','DESC')->get('group_managers');
		       return $query->result();
	}
	public  function update_data($value='',$user_id='') 
	{
		 $update = $this->db->where('user_id',$user_id)->update($this->table , $value);
         return $update;
	}
	public function update_groupdata($data_array,$group_id,$sdo_id)
	{
		 $update = $this->db->where('group_id',$group_id)->where('category_id', $sdo_id)->update('groups' , $data_array);
         return $update;

	}
	
	public function save_data($value='')
	{

         $insert = $this->db->insert($this->table , $value);
         return $insert;
	}
	
	public function deleteGroupManager($groupmanager_id)
	{
		$delete = $this->db->where('groupmanager_id',$groupmanager_id)->delete('group_managers');
		return $delete;

	}
	public function getAllPendingMember()
	{
	    	$query = $this->db->select('users.*,category.category_name,groups.group_title,groups.shortform,users.status as status1')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','INNER')->order_by('users.user_id','DESC')->get('users');
		       return $query->result();
	    
	}


}