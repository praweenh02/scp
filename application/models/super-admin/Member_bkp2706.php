<?php
class Member extends CI_controller
{
	public function __construct()
	{
	  parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session','database');
		$this->load->model('super-admin/Auth_model','auth');
		$this->load->model('super-admin/Member_model','member_modal');
		$this->auth->isLoggedIn();


    }

    public function member_list()
	{
		$data['page'] =  "super-admin/member/member-list";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['groups'] = $this->member_modal->getAllMember();
		$this->load->view('super-admin/template',$data);
		
		
	}
    public function group_manager_list()
    {
        $data['page'] =  "super-admin/member/group-manager-list";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['groups'] = $this->member_modal->getAllGroupManager();
        $this->load->view('super-admin/template',$data); 

    }

     public function recommend_new_member_requests()
    
    {
        $data['page'] =  "super-admin/member/recommend-new-member-requests";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['groups'] = $this->member_modal->getAllnewRecommendUserList();
        $this->load->view('super-admin/template',$data);
        
        
    }
    public function view_recommend_user_details($user_id)
    {
        $data['page'] =  "super-admin/member/view-recommend-user-details";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['result'] = $this->member_modal->getrecommeduserDetails($user_id);
        $this->load->view('super-admin/template',$data);

    }
    public function view_member_list($user_id='')
    {
        $data['page'] =  "super-admin/member/view-member-details";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['result'] = $this->member_modal->getrecommeduserDetails($user_id);
        $this->load->view('super-admin/template',$data);
    }

    public function make_group_manager($user_id='')
    {
        $data['page'] =  "super-admin/member/make-group-manager";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['result'] = $this->member_modal->getrecommeduserDetails($user_id);
        $data['group_category'] = $this->member_modal->getAllSDO();
        $this->load->view('super-admin/template',$data);
    }
    public  function getAllGroups()
    {
        $category_id = $this->input->post('category_id');
        $working_group = $this->member_modal->getAllWorkingGroup($category_id);
        $output ='';
        $output .='<option value="">----Select Working Group----</option>';
                                     
                             foreach($working_group as $wrd_grup):
                          
                             $output .='<option value='.$wrd_grup->group_id.'>'.$wrd_grup->group_title.'</option>';

                         
                                 endforeach;
            echo $output;
    }
    public function create_group_manager()
    {

        $member_id = $this->input->post('member_id');
        $sdo_id = $this->input->post('sdo_id');
        $group_id = $this->input->post('group_id');
           if(!empty($member_id))
                {

                    $data_array = array('group_manager_id'=>$member_id,
                                         'updated_at' => date('Y-m-d h:s:i a'));
                      $update1 =  $this->member_modal->update_groupdata($data_array,$group_id,$sdo_id);
                      $data_array2 =  array('user_type'=>'group_manager',
                                            'assign_group_manager' =>'Y',
                                         'updated_at' => date('Y-m-d h:s:i a'));
                      $update2 =  $this->member_modal->update_data($data_array2,$member_id);

                              if($update1 ===true && $update2 ===true)
                              {
                               $response = array('status' => 'success',
                               'message' => 'Group manager created successfully.');

                               }else
                               {

                              $response = array('status' => 'error',
                               'message' => 'Member not updated!');
                              }
                      
                }
                echo json_encode($response);
    }

    public function accecpt_new_recommend_user()
    {
        extract($_POST);
         $member_id = $this->input->post('member_id');
               if(!empty($member_id))
                {

                    $data_array = array('suerp_admin_status'=>$suerp_admin_status,
                                         'updated_at' => date('Y-m-d h:s:i a'));
                      $update =  $this->member_modal->update_data($data_array,$member_id);

                              if($update ===true)
                              {
                               $response = array('status' => 'success',
                               'message' => $suerp_admin_status.'successfully.');

                               }else
                               {

                              $response = array('status' => 'error',
                               'message' => 'Member not updated!');
                              }
                      
                }
                echo json_encode($response);



    }
    public function update_status($value='')
    {
         extract($_POST);
         $member_id = $this->input->post('member_id');
               if(!empty($member_id))
                {

                    $data_array = array('status'=>$status,
                                         'updated_at' => date('Y-m-d h:s:i a'));
                      $update =  $this->member_modal->update_data($data_array,$member_id);

                              if($update ===true)
                              {
                               $response = array('status' => 'success',
                               'message' => 'Status updated successfully.');

                               }else
                               {

                              $response = array('status' => 'error',
                               'message' => 'Status not updated!');
                              }
                      
                }
                echo json_encode($response);
    }
	public function create($coordinator_id=0)
	{
		
		
		
		
        	$data['page'] =  "super-admin/coordinator/create";
            //$group_id = $this->input->post('group_id');
            $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
            $data['result'] = $this->member_modal->getOneCoordinator($coordinator_id);
            $this->load->view('super-admin/template',$data);
    }
        public function edit($coordinator_id=0)
    {
        
        
        
        
            $data['page'] =  "super-admin/coordinator/edit";
            //$group_id = $this->input->post('group_id');
            $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
            $data['result'] = $this->member_modal->getOneCoordinator($coordinator_id);
            $this->load->view('super-admin/template',$data);
    }
    public function save_data()
	{
       //error_reporting(0);
       extract($_POST);
	     $coordinator_id = $this->input->post('coordinator_id');
               if(empty($coordinator_id))
                {
                       $email      = $this->input->post('email');
                	   $contact_no = $this->input->post('contact_no');
                	   $check      = $this->member_modal->checkemailAndmobile_no($email,$contact_no);
                        if($check==0)
                        {

                         $data_array = array('name' => $name,
                            'email' => $this->input->post('email'),
                            'user_type' => 'coordinator',
                            'uniquId' => uniqid('coord'.rand(000,999)),
                            'password' => md5($this->input->post('paaword')),
                            'contact_no' => $this->input->post('contact_no'),
                            'time_zone' => $this->input->post('time_zone'),
                            'created_at' => date('Y-m-d h:s:i a'));
                	      $insert =  $this->member_modal->save_data($data_array);
                	    }else
                	    {
                	    	$response = array('status' => 'error',
                               'message' => 'Coordinator already exit.');

                	    }
                   if($insert ===true)
                   {
          	            $response = array('status' => 'success',
                               'message' => 'Coordinator created successfully.');

                        }else
                       {

                        $response = array('status' => 'error',
                               'message' => 'Coordinator not created!');
                    }
                	

                }else{
                	   
                            $data_array = array('name' => $name,
                                  'email' => $this->input->post('email'),
                                 'contact_no' => $this->input->post('contact_no'),
                                 'user_type' => 'coordinator',
                                 'time_zone' => $this->input->post('time_zone'),
                                 'status' => $this->input->post('status'),
                                 'updated_at' => date('Y-m-d h:s:i a'));
                	         $update =  $this->member_modal->update_data($data_array,$coordinator_id);

                              if($update ===true)
                              {
          	                   $response = array('status' => 'success',
                               'message' => 'Coordinator updated successfully.');

                               }else
                               {

                              $response = array('status' => 'error',
                               'message' => 'Coordinator not updated!');
                              }
                      

                }
                   
          echo json_encode($response);
    }
    public function delete_data()
    {
    		  $coordinator_id = $this->input->post('id');
    		  $delete = $this->member_modal->delete_data($coordinator_id);
	          echo 'success';

    }
    public function view_change_password($user_id)
    {
        $data['page'] =  "super-admin/member/view-change-password";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['result'] = $this->member_modal->getrecommeduserDetails($user_id);
        $this->load->view('super-admin/template',$data);

    }
   public function passwordChange()
    {
        
         
        $member_id = $this->input->post('member_id');
        //$old_password = md5($this->input->post('current_password'));
        //$current_password = $this->encrypt->encode($old_password);
        $new_password     =      $this->input->post('password');
        $confirm_password =      $this->input->post('confirm_password');
        //$newsPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $newsPassword   = md5($new_password);
        //Check OldPassword
        $query =$this->db->query("SELECT  user_id, password AS hash FROM users WHERE 1=1  AND user_id = ".$this->db->escape($member_id)."   LIMIT 1");
        $row = $query->row();
        //$row = $query->result_array();
        //$result = $query->num_rows();
        if($row && $new_password==$confirm_password)
        {
             $data = array('password'   => $newsPassword,
                            'updated_at'    => date("Y-m-d h:i:s"));
                       
        $this->db->where('user_id', $member_id);
        $this->db->update('users', $data);
        //$this->session->set_flashdata('success', 'New password update successfully.');
         //redirect('auth/change_password/');
           $response = array(
                    'status' => 'success',
                    'message' => 'New password change successfully.');
                
       }else{
          
                $response = array(
                    'status' => 'error',
                    'message' => 'Password & confirm password dose not match.');
        
         }
         echo json_encode($response);
    }
    public function removeGroupManager()
    {
        $groupmanager_id = $this->input->post('user_id');

        $delete = $this->member_modal->deleteGroupManager($groupmanager_id);

        if($delete)
        {

            echo "success";
        }
    }

    public function deleteMember()
    {

        $user_id = $this->input->post('user_id');
        $delete = $this->member_modal->deleteMember($user_id);
        if($delete)
        {
            echo "success";
        }
    }
}


?>