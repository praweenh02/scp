<?php
class Dashboard extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session','database');
		$this->load->model('super-admin/Auth_model','auth');
		$this->load->model('super-admin/Dashboard_model','dash_model');
		$this->auth->isLoggedIn();
	}
	public function index()
	{
		$data['page'] =  "super-admin/dashboard";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['total_group'] = $this->dash_model->getTotalGroups();
		$data['taotal_gmanager'] = $this->dash_model->getTotalGroupManager();
		$data['taotal_users'] = $this->dash_model->getTotalUsers();
		$data['total_new_member_request'] = $this->dash_model->newMemberRequest();
        $data['total_que'] = $this->dash_model->totalQue();
		$this->load->view('super-admin/template',$data);
		
		
	}
	public function password_change()
	{
		$data['page'] =  "super-admin/password_change";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$this->load->view('super-admin/template',$data);
		
		
	}
	public function profile()
	{
		$data['page'] =  "super-admin/profile";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$this->load->view('super-admin/template',$data);
		
		
	}
	
	//Change the Password
	public function passwordChange()
	{
		
		 
		$admin_id = $this->session->userdata('admin_id');
		$old_password = $this->input->post('current_password');
		//$current_password = $this->encrypt->encode($old_password);
		$new_password = $this->input->post('new_password');
		$confirm_password =  $this->input->post('confirm_password');
		//$newsPassword = password_hash($new_password, PASSWORD_DEFAULT);
		$newsPassword   = sha1($new_password);
		//Check OldPassword
		$query =$this->db->query("SELECT  admin_id, password AS hash FROM super_admin WHERE 1=1 AND admin_id = ".$this->db->escape($admin_id)."  LIMIT 1");
		$row = $query->row();
		//$row = $query->result_array();
		//$result = $query->num_rows();
		if(password_verify($old_password, $row->hash))
		{
			 $data = array('password'   => $newsPassword,
                       'update_at'    => date("Y-m-d h:i:s"));
					   
        $this->db->where('admin_id ', $id);
        $this->db->update('super_admin', $data);
        $this->session->set_flashdata('message', 'New password update successfully.');
         redirect('profile/change-password/');
			 
			
		}elseif($new_password!==$confirm_password)
		{
			   $this->session->set_flashdata('danger', 'New password & confirm password dose not match.');
               redirect('profile/change-password/');
			
		}else{
		  $this->session->set_flashdata('danger', 'Current Password dose not match.');
               redirect('profile/change-password/');
			  //$this->load->view('super/profile/chanage-password');
		
		 }
     }
}


?>