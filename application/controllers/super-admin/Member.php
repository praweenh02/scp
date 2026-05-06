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
                     $rows = $this->db->select('token,name,surname')->where('user_id',$member_id)->get('users')->row();
                     if($suerp_admin_status=='accepted')
                 {

                    $data_array = array('suerp_admin_status'=>$suerp_admin_status,
                                         'updated_at' => date('Y-m-d h:s:i a'));
                      $update =  $this->member_modal->update_data($data_array,$member_id);
                      $token = md5(rand(0000,9999));
                          $settoken = $this->db->set('token',$token)->where('user_id',$member_id)->update('users'); 
                           
                                           
                              
                                       //$this->load->library('phpmailer_lib');
        
        // PHPMailer object
        require_once(APPPATH.'third_party/email/class.phpmailer.php');
        $mail = new PHPMailer();
        
        // SMTP configuration
        $mail->isSMTP();
         $current_url = $_SERVER['SERVER_NAME'];
        if($current_url=='tec1.dssolution.in')
        {
        $mail->Host     = 'dssolution.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@dssolution.in';
        $mail->Password = 'AdminNew@#$1234';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        $mail->setFrom('info@dssolution.in', 'Standards Coordination Portal');
        $mail->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
        }else
        {
               // SMTP configuration For Tec.gov
        $mail->Host     = 'relay.nic.in';
        $mail->SMTPAuth = false;
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = '';
        $mail->Port     = 25;
        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }

        $mail->isHTML(true);
        
       // Add a recipient
        $mail->addAddress($email);
        
        $mail->Subject = 'Account is approved by Tec Management Team - Standards Coordination Portal';
        
        // Email body content
        $mailContent = "<h3>Dear ".$rows->name."&nbsp;".$rows->surname.",</h3>
            <p>Your new account request has been approved<p>
<p>When you now login to the TEC Standards Coordination Portal page with your user name: e-mail:".$email.",you will have portal access. Please set your password. - click url set first time password.</p><p><a href=".base_url()."home/setfirsttimepassword/".$member_id."/".$token." target='_blank'>Set Password</a><br>If you require any further assistance, please contact your focal point at  adgcb.tec-dot@gov.in</p>

<p>Thank you.</p><p>
With best regards,<br>
TEC Standards Coordination Portal  Management Service.</p>";
        $mail->Body = $mailContent;
                $mail->send();
                                  
                               $response = array('status' => 'success',
                               'message' => 'Account is approved by Tec Management Team');
                               
                               
                                             

                               }else if($suerp_admin_status=='rejected')
                               {
                     $rows = $this->db->select('token,name,surname')->where('user_id',$member_id)->get('users')->row();
                    $from_email = "info@dssolution.in";
                    $to_email = $this->input->post('email');
                    //Load email library
                       //$this->load->library('phpmailer_lib');
        
        // PHPMailer object
        require_once(APPPATH.'third_party/email/class.phpmailer.php');
        $mail = new PHPMailer();
        
        // SMTP configuration
        $mail->isSMTP();
         $current_url = $_SERVER['SERVER_NAME'];
      if($current_url=='tec1.dssolution.in')
        {
        $mail->Host     = 'dssolution.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@dssolution.in';
        $mail->Password = 'AdminNew@#$1234';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        $mail->setFrom('info@dssolution.in', 'Standards Coordination Portal');
        $mail->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
        }else
        {
               // SMTP configuration For Tec.gov
        $mail->Host     = 'relay.nic.in';
        $mail->SMTPAuth = false;
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = '';
        $mail->Port     = 25;
        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }
        $mail->isHTML(true);
        
       // Add a recipient
        $mail->addAddress($to_email);
        
        $mail->Subject = 'Account is rejected by Tec Management Team - Standards Coordination Portal';
        
        // Email body content
        $mailContent = "<h3>Dear ".$rows->name."&nbsp;".$rows->surname." </h3>
            <p>Your new account request has been rejected by the Portal Admin (TEC Management Team).<p>
<p>If you require any further assistance, please contact your focal point a<br><strong>at adgcb.tec-dot@gov.in.</strong><br>Thank you.</p><p>
With best regards,<br>
TEC Standards Coordination Portal Management Service.</p>";
        $mail->Body = $mailContent;
                $mail->send();
                $data_array = array('suerp_admin_status'=>$suerp_admin_status,
                                         'updated_at' => date('Y-m-d h:s:i a'));
                      $update =  $this->member_modal->update_data($data_array,$member_id);
                      //$token = md5(rand(0000,9999));
                          //$settoken = $this->db->set('token',$token)->where('user_id',$member_id)->update('users'); 
 
                                           

                              $response = array('status' => 'success',
                               'message' => 'Account is rejected by Tec Management Team.');
                              }
                      
                
                  echo json_encode($response);
            }
              



    }
    public function update_status($value='')
    {
        //error_reporting(0);
         extract($_POST);
         $member_id = $this->input->post('member_id');
               if(!empty($member_id))
                {

                    $data_array = array(  'status'=>$status,
                                         'group_manager_recommend_status' =>$this->input->post('group_manager_recommend_status'),
                                         'suerp_admin_status' => $this->input->post('suerp_admin_status'),
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
        $gm_result = $this->db->select('*')->where('user_id', $member_id)->get('users')->row();
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
         //For Email
               // SMTP configuration
        //$mail1 = $this->phpmailer_lib->load();
         require_once(APPPATH.'third_party/email/class.phpmailer.php');
         $mail1 = new PHPMailer();
        $mail1->isSMTP();
         $current_url = $_SERVER['SERVER_NAME'];
     if($current_url=='tec1.dssolution.in')
         {
            $mail1->Host = 'smtp.hostinger.com';
        $mail1->SMTPAuth = true;
        $mail1->Username = 'info@dssolution.in';
        $mail1->Password = 'AdminNew@#$1234';
        $mail1->SMTPSecure = 'ssl';
        $mail1->Port     = 465;
        $mail1->setFrom('info@dssolution.in', 'Standards Coordination Portal');
        $mail1->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
         }else
         {
                // SMTP configuration For Tec.gov
                       //$mail->isSMTP();
        $mail1->Host     = 'relay.nic.in';
        $mail1->SMTPAuth = true;
        $mail1->Username = 'adic1.tec@gov.in';
        $mail1->Password = 'Stec#2020';
        $mail1->SMTPSecure = 'tls';
        $mail1->CharSet = 'UTF-8';
        $mail1->Port     = 25;
        $mail1->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail1->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
             
         } 
        $mail1->isHTML(true);
        
       // Add a recipient
        $mail1->addAddress($gm_result->email);
        
        $mail1->Subject = 'Passowrd change '.$gm_result->name.' '.$gm_result->surname.' - Standards Coordination Portal';
        
        // Email body content
        //$mailContent = "<h3>Dear ".$rows->name."&nbsp;".$rows->surname."</h3>
            $mailContent1="<h3>Dear Sir/Madam,</h3><br>
            <p>Your SCP portal password has been changed. Your new pasword is - ".$new_password."</p>
 <p>With best regards,<br><strong>TEC Standards Coordination Portal  Management Service.</strong></p>";
        $mail1->Body = $mailContent1;
        $mail1->send();
        
         
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
        $delete = $this->db->where('user_id',$user_id)->delete('users');
        if($delete)
        {
            echo "success";
        }
    }
    public function pending_member_list()
    {
        $data['page'] =  "super-admin/member/pending-member-list";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['groups'] = $this->member_modal->getAllPendingMember();
        $this->load->view('super-admin/template',$data);
        
    }
}


?>