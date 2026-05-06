<?php
class Dashboard_model extends CI_model
{


	public function __construct()
	{
		parent::__construct();
		$this->grpup = 'groups';
		$this->user = 'users';
		$this->question = 'questions';
		$this->superadmin_id = $this->session->userdata('superadmin_id');

   

	}

	public function getTotalGroups()
	{

		return $this->db->select('*')->get($this->grpup)->num_rows();
	}
	public function getTotalUsers()
	{

		return $this->db->select('*')->get($this->user)->num_rows();
	}
	public function getTotalGroupManager()
	{

		return $this->db->select('*')->where('user_type','group_manager')->get($this->user)->num_rows();
	}
    public function totalQue()
    {
        return $this->db->select('*')->get($this->question)->num_rows();
    }
	public function newMemberRequest()
	{

		return $this->db->select('users.*,category.category_name,groups.group_title')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','INNER')->where('users.user_type','member')->where('users.suerp_admin_status',NULL)->where('group_manager_recommend_status','Y')->order_by('users.user_id','DESC')->get('users')->num_rows();
	}
}


?>