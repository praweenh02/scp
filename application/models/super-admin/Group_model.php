<?php

class Group_model extends CI_model
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
	public function getAllGroup()
	{

			$query = $this->db->select('category.category_name,groups.*')->join('category','groups.category_id=category.category_id','LEFT')->where('groups.status','Y')->order_by('groups.display_order','ASC')->get('groups')->result();
		return $query;
	}

	public function getAllSDOGroup($sdo_id)
	{
			$query = $this->db->select('category.category_name,groups.*')->join('category','groups.category_id=category.category_id','LEFT')->where('groups.category_id',$sdo_id)->where('groups.status','Y')->where('category.category_status','Y')->order_by('groups.display_order','ASC')->get('groups')->result();
		return $query;


	}
	public function getOneGroup($group_id)
	{

		$query = $this->db->select('*')->where('group_id', $group_id)->get($this->table)->row();
		return $query;
	}
	public  function update_data($value='',$group_id='')
	{
		 $update = $this->db->where('group_id',$group_id)->update($this->table , $value);
         return $update;
	}
	public  function delete_data($group_id='')
	{
       $delete = $this->db->set('status','N')->where('group_id',$group_id)->update($this->table);	
       return $delete;	

	}
	public function getAllGroupAdmin()
	{

		$query = $this->db->select('*')->where('status','Y')->order_by('name','ASC')->get('coordinator')->result();
		return $query;
	}
	
	

	public function getOneGroupCatgory($category_id)
	{
		$query = $this->db->select('*')->where('category_id',$category_id)->order_by('category_id','DESC')->get('category')->row();
		return $query;


	}
	public function getAllCatgory()
	{
		$query = $this->db->select('*')->where('category_status','Y')->order_by('category_id','DESC')->get('category')->result();
		return $query;


	}
	public function save_category_data($value)
	{
		  $insert = $this->db->insert('category' , $value);
         return $insert;

	}
		public function update_catgory_data($value,$category_id)
	{
		  $insert = $this->db->where('category_id',$category_id)->update('category' , $value);
         return $insert;

	}
	public function delete_category($category_id)
	{
		$delete = $this->db->set('category_status','N')->where('category_id',$category_id)->update('category');	
       return $delete;	


	}
	public function getActGroupCatgory()
	{
		$query = $this->db->select('*')->where('category_status', 'Y')->order_by('category_id','DESC')->get('category')->result();
		return $query;

	}
	//Working Party

	public function getAllWorkingParty()
	{
		//return $query = $this->db->select('*')->order_by('workingparty_id','DSC')->get('working_parties')->result();
		$query = $this->db->select('category.category_name,groups.group_title, working_parties.*')->join('category','working_parties.sdo_id=category.category_id','LEFT')->join('groups','working_parties.group_id=groups.group_id','INNER')->order_by('working_parties.workingparty_id','DESC')->get('working_parties')->result();
		return $query;
		
	}
	public function save_workingparty_data($value='')
	{
		  $insert = $this->db->insert('working_parties' , $value);
         return $insert;

	}
		public function getOneWorkingParty($workingparty_id)
	{
		//return $query = $this->db->select('*')->order_by('workingparty_id','DSC')->get('working_parties')->result();
		$query = $this->db->select('category.category_name,groups.group_title, working_parties.*')->join('category','working_parties.sdo_id=category.category_id','LEFT')->join('groups','working_parties.group_id=groups.group_id','INNER')->where('working_parties.workingparty_id',$workingparty_id)->get('working_parties')->row();
		return $query;
		
	}
	public function update_workingparty_data($value='', $workingparty_id)
	{
		 $update = $this->db->where('workingparty_id',$workingparty_id)->update('working_parties' , $value);
         return $update;
	}
	public function delete_workingparty($workingparty_id='')
	{
			$delete = $this->db->where('workingparty_id',$workingparty_id)->delete('working_parties');	
       return $delete;	
	}
	public function getAllUsers()
	{
		$query = $this->db->select('*')->where('status','Y')->where('verified_email','Y')->where('group_manager_recommend_status','Y')->order_by('name,surname','ASC')->get('users')->result();
		return $query;

	}
	public function saveGroupManagers($value)
	{
            $insert = $this->db->insert('group_managers' , $value);
         return $insert;

	}
	public function groupWiseManager($value='')
	{
		$query = $this->db->select('users.name,users.surname,users.email,users.contact_no,group_managers.groupmanager_id')->join('users','group_managers.member_id=users.user_id','left')->where('group_managers.group_id',$value)->get('group_managers')->result();
		return $query;
	}
	public function deleteGroupManager($groupmanager_id='')
	{
		$delete = $this->db->where('groupmanager_id',$groupmanager_id)->delete('group_managers');	
       return $delete;
	}
	public function  checkexitGroupManager($member_id,$group_id)
	{
		$query = $this->db->select()->where('member_id',$member_id)->where('group_id',$group_id)->get('group_managers')->num_rows();
		return $query;
	}
	public function updateGroupManagers($value, $member_id, $group_id)
	{
		$update = $this->db->where('member_id',$member_id)->where('group_id',$group_id)->update('group_managers',$value);
		return $update;

	}
	public function updateGroupManagerDetails($value='', $user_id='')
	{
		$update = $this->db->where('user_id',$user_id)->update('users',$value);
		return $update;
		
	}
	public function getdeletedGroups()
	{
	    	$query = $this->db->select('category.category_name,groups.*')->join('category','groups.category_id=category.category_id','LEFT')->where('groups.status','N')->order_by('groups.display_order','ASC')->get('groups')->result();
		   return $query;
	    
	}
	public function restoreGroup($group_id)
	{
	    $update = $this->db->set('status','Y')->where('group_id',$group_id)->update('groups');
	    return $update;
	    
	}
	public function getdeletedSDo()
	{
	    	$query = $this->db->select('*')->where('category_status','N')->order_by('category_id','ASC')->get('category')->result();
		   return $query;
	    
	}
	public function restoreSdo($sdo_id)
	{
	    $update = $this->db->set('category_status','Y')->where('category_id',$sdo_id)->update('category');
	    return $update;
	    
	}
	

	
	
	
}


?>