<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_controller
{
		public function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session');
		$this->load->model('Login_model','auth');
		$this->load->model('Home_model','Home_model');
		$this->load->model('Dashboard_model','dash_model');
		$this->auth->isLoggedIn();

	}
	public function index($group_id='')
	{
	    $this->session->set_userdata('group_id',$group_id);
		$data['page'] = 'user/dashboard';
		$data['sdo_list'] = $this->Home_model->getAllSDO(); 
		$data['group_meetings'] = $this->dash_model->getAllMeetings();
		
        $this->load->view('user/template',$data);
	}

	public function select_sdo()
	{
	    $data['page'] = 'user/select-sdo';
		$data['sdo_list'] = $this->Home_model->getAllSDO(); 
		$data['group_meetings'] = $this->dash_model->getAllMeetings();
        $this->load->view('user/template',$data);


	}
	public function groupAction($sdo_id, $group_id)
	{
			$data['page'] = 'user/member-group-action';
		    $data['group_data'] = $this->dash_model->getActiveGroup($group_id); 
		    $data['document_expiry_date'] = $this->dash_model->getDocumentExpiryDate($group_id);
		    $data['sdo_list'] = $this->Home_model->getAllSDO(); 
            $this->load->view('user/template',$data);

	}
	public function profile()
	{
		$data['page'] =  "user/profile";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['sdo_list'] = $this->Home_model->getAllSDO(); 
		$this->load->view('user/template',$data);
		
		
	}
	public function password_change()
	{
		$data['page'] =  "user/password_change";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['sdo_list'] = $this->Home_model->getAllSDO(); 
		$this->load->view('user/template',$data);
		
		
	}
	
	//Change the Password
	public function passwordChange()
	{
		
		 
		$admin_id = $this->session->userdata('user_id');
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
     	public  function change_usertype()
	{
		 $user_id = $this->session->userdata('user_id');
		 $user_email = $this->input->post('user_email');
		 $user_type = $this->input->post('user_type');

		 $query = $this->auth->change_user_type($user_id,$user_email,$user_type);
		 if($query)
		 {
		     if($query->user_type =='group_manager')
		     {
		         $gm_value = $this->db->select('*')->where('member_id',$user_id)->get('group_managers')->row();
		         
		             //$this->session->set_userdata('group_id', $gm_value->group_id);
		             $this->session->set_userdata('user_id', $query->user_id);
			         $this->session->set_userdata('user_name', $query->name);
			         $this->session->set_userdata('user_surname', $query->surname);
			         $this->session->set_userdata('user_email', $query->email);
			         $this->session->set_userdata('user_type', $query->user_type);
		             redirect('dashboard/selectgroup','refesh');
		         
		     }else {
		 	         $this->session->set_userdata('user_id', $query->user_id);
			         $this->session->set_userdata('user_name', $query->name);
			         $this->session->set_userdata('user_surname', $query->surname);
			         $this->session->set_userdata('user_email', $query->email);
			         $this->session->set_userdata('user_type', $query->user_type);
		             redirect('dashboard','refesh');
		      }
		 }
	}
	public function load_event()
	{

		$events = $this->dash_model->get_event_list();
		 foreach($events as $result)
		 {
		 	$response[] = array( 'title' =>'Group Name:'.$result->group_title.' '.'Meeting Title:'. $result->meeting_title,

		 		                 'start' => $result->meeting_date,
		 		                   'end' => $result->meeting_end_date);

		 	
		 }
		 echo  json_encode($response);
	}
	public function selectgroup()
	{
	    $data['page'] =  "user/select-group";
	    $user_id = $this->session->userdata('user_id');
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['sdo_list'] = $this->Home_model->getAllSDO(); 
		$data['group_list'] = $this->db->select('groups.shortform,groups.category_id,group_managers.*')->join('groups','groups.group_id=group_managers.group_id','left')->where('group_managers.member_id',$user_id)->get('group_managers')->result();
		$this->load->view('user/template',$data);
	    
	}
        


}


?>