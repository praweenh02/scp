<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_controller
{
		public function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form','captcha');
	    $this->load->library('session');
		$this->load->model('Login_model','auth');

	}
	

	public function index()
	{
		$config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => 'system/fonts/texb.ttf',
			'img_width'     => '200',
			'img_height'    => 50,
			'word_length'   => 4,
			'font_size'     => 100
        );
        $captcha = create_captcha($config);
        
        //Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        
        // Pass captcha image to view
        $data['captchaImg'] = $captcha['image'];
		$this->load->view('user/login',$data);
	}
	public function logindone()
	{
	    error_reporting(0);
		//$this->auth->isLoggedIn();
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$inputCaptcha = $this->input->post('captcha');
		$sessCaptcha = $this->session->userdata('captchaCode');
		if($inputCaptcha === $sessCaptcha)
		{
		    if($email==NULL)
		    {
			    $this->session->set_flashdata('error','Please enter email.');
			     redirect('login/','refesh');
			
		    }if($password==NULL)
		    {
			    $this->session->set_flashdata('error','Please enter password.');
			     redirect('login/','refesh');
		    }else{
	
           $hashpassword = md5($password);
      
            $query =  $this->auth->login($email,$hashpassword);
		           if($query)
		           {
			               if($query->status=='Y' && $query->suerp_admin_status=='accepted')
			               {
			                  $user_id = $query->user_id;
			                  if($query->user_type =='group_manager')
			                  {
			                    //$results = $this->db->select('*')->where('member_id',$user_id)->get('group_managers')->row();
			                    // $group_id =  $results->group_id;
			                   //$this->session->set_userdata('group_id', $group_id);
			                    $this->session->set_userdata('user_id', $query->user_id);
			                    $this->session->set_userdata('user_name', $query->name);
			                    $this->session->set_userdata('user_surname', $query->surname);
			                    $this->session->set_userdata('user_email', $query->email);
			                     $this->session->set_userdata('user_type', $query->user_type);
			                     $this->session->set_userdata('assign_group_manager', $query->assign_group_manager);
			                     $url = base_url().'dashboard/selectgroup/';
			                  }else{
				
			                        //$this->session->set_userdata('distributor_name', $query->distributor_name);
			                       
		                        $this->session->set_userdata('user_id', $query->user_id);
			                    $this->session->set_userdata('user_name', $query->name);
			                    $this->session->set_userdata('user_surname', $query->surname);
			                    $this->session->set_userdata('user_email', $query->email);
			                    $this->session->set_userdata('user_type', $query->user_type);
			                    $this->session->set_userdata('assign_group_manager', $query->assign_group_manager);
			                    $url = base_url().'dashboard';
			                  }
			                 // $response = array(
                    //   'status' => 'success',
                    //   'message' => 'Login Successfully.',
                    //     'url' => $url
                    //      );
                         
                              $this->session->set_flashdata('success','Login Successfully.');
	                          redirect($url);
			              }else
			              {
			                   $this->session->set_flashdata('error','Your account is Inactive. please wait for activation.');
			                    $url = base_url().'login';
			                    redirect($url);
			                   
			                 //  $response = array(
                    //             'status' => 'error'
                    //              //'message' => 'Your account is inactive.',
                    //              // 'url' => $url
                    //             );
				
			                }
			
			
		              }else
		             {
			                $this->session->set_flashdata('error','Invaild Usernmae & password');
			                 $url = base_url().'login';
			                 redirect($url);
			                 //$response = array(
                    //   'status' => 'error1',
                    //   'message' => 'Invaild Email & password.',
                    //   // 'url' => $url
                    //     );
			                 //redirect('auth/','refesh');
		              }
                }//

      }else
      {

      	    $this->session->set_flashdata('error', 'Please validate captcha.');
			$url = base_url().'login';
			                 redirect($url);
				//  $response = array(
    //                   'status' => 'error2',
    //                   'message' => 'Please validate captcha.',
    //                     //'url' => $url
    //                     );
      }
    
	
	// Unset previous captcha and set new captcha word
	$this->session->unset_userdata('captchaCode');
	     
		       echo  json_encode($response);
  }
	
	public function change_password()
	{
		//$data['view_data']= $this->profile->view_data($this->session->userdata('login_id'));
	    //$this->load->view('admin/category/list', $this->data, FALSE);
	    $this->auth->isLoggedIn();
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['page'] = "profile/change-password";
        $this->load->view("template",$data);
	}
	  public function logout(){
            $this->session->sess_destroy();
            redirect(base_url().'/' ,'refresh');
            exit;
        }
		//Change the Password
	public function passwordChange()
	{
		
		 
		$user_id = $this->session->userdata('user_id');
		$old_password = trim($this->input->post('current_password'));
		//$current_password = $this->encrypt->encode($old_password);
		$new_password = $this->input->post('new_password');
		$confirm_password =  $this->input->post('confirm_password');
		//$newsPassword = password_hash($new_password, PASSWORD_DEFAULT);
		$newsPassword   = md5($new_password);
		//Check OldPassword
		$query =$this->db->query("SELECT  user_id, password AS hash FROM users WHERE 1=1 AND user_id = ".$this->db->escape($user_id)."  LIMIT 1");
		$row = $query->row();
		//$row = $query->result_array();
		//$result = $query->num_rows();
		if(md5($old_password) == $row->hash)
		{
			 $data = array('password'   => $newsPassword,
                           'updated_at'    => date("Y-m-d h:i:s"));
					   
          $updatePassword = $this->auth->updateProfile($data,$user_id);
        //$this->session->set_flashdata('success', 'New password update successfully.');
         //redirect('auth/change_password/');
           $response = array(
                    'status' => 'success',
                    'message' => 'New password update successfully.');
				
			 
			
		}elseif($new_password!==$confirm_password)
		{
			  
                  $response = array(
                    'status' => 'error',
                    'message' => 'New password & confirm password dose not match.');
			
		}else{
		  //$this->session->set_flashdata('error', 'Current Password dose not match.');
               //redirect('auth/change_password/');
			    $response = array(
                    'status' => 'error',
                    'message' => 'Current Password dose not match.');
		
		 }
		 echo json_encode($response);
     }
	 
	 //Profile
	 
	 public function my_profile()
	 {
		 $data['page'] = "profile/view";
		 $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $this->load->view("template",$data);
	 }
	 //change Profile
	 public function updateProfile()
     {
		 $user_id = $this->session->userdata('user_id');
		 if(!empty($_FILES['userfile']['name'])){
                $config['upload_path'] = 'uploads/user-image/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['userfile']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('userfile')){
                    $uploadData = $this->upload->data();
                    $product_image1 = $config['upload_path'].$uploadData['file_name'];
					 $data= array('upload_image' => $product_image1,
						 
						               'update_at' => date('Y-m-d h:s:i') );
									   $this->db->where('coordinator_id', $user_id);
									   $update = $this->db->update('coordinator',$data);

                            $this->session->set_flashdata('success', 'Image update successfully.');
                             redirect('dashboard/my_profile/');
                }else{
                    $product_image1 = '';
					 $this->session->set_flashdata('error', 'Image not update successfully.');
                             redirect('dashboard/my_profile/');
                }
             }else
			 {
                $product_image1 = '';
				 //$this->session->set_flashdata('error', 'Please upload vaild image.');
                             //redirect('auth/my_profile/');
                 }
				 
		 if($this->input->post('name')  || $this->input->post('surname') )
		 {
			 
			 $dataarray = array('name' => $this->input->post('name'),
			                'surname' => $this->input->post('surname'),
			                'contact_no' => $this->input->post('contact_no'),
			                 'landline' => $this->input->post('landline'),
			                 'address' => $this->input->post('address'),
			                  'city' => $this->input->post('city'),
			                  'state' => $this->input->post('state'),
			                  'email_subscription' => $this->input->post('email_subscription'),
			                  'pincode' => $this->input->post('pincode'),
						      'updated_at' => date('Y-m-d h:s:i'));
						   
						 $update = $this->auth->updateProfile($dataarray,$user_id);
									   
									           $response = array(
                    'status' => 'success',
                    'message' => 'Profile updated successfully.');
		 }else
		 {
			 $product_image1 = '';
					    $response = array(
                    'status' => 'error',
                    'message' => 'Profile not updated!.');
		 }
				 
				 
			 echo json_encode($response);
		 
	}
	public function reset_password()
	{
	    
	  $inputCaptcha = $this->input->post('captcha');
      $sessCaptcha = $this->session->userdata('captchaCode');
	     if($inputCaptcha === $sessCaptcha)
	    {
            $email = $this->input->post('f_email');
            $post_date = $this->input->post('post_date');
      
	        
			if($this->form_validation->set_rules('f_email', 'Email', 'trim|required|valid_email|xss_clean')):
			
			
			   

				
					$db_check=$this->db->query("SELECT * FROM `users` WHERE email='$email'");
					$count=$db_check->num_rows();
					if($count==1) :
						$row= $db_check->row_array();
						$active_code=md5(uniqid(rand(5, 15), true));
						$link = base_url().'login/rest_password_view?member_id='.$row['user_id'].'&key='.$active_code;         
						$fetch=$this->db->query("UPDATE `users` SET `active_code` = '$active_code' WHERE `email`='$email' ");
						;
					
						$this->load->library('phpmailer_lib');
							
						$mail = $this->phpmailer_lib->load();
						
						// SMTP configuration
						$mail->isSMTP();
						$mail->Host     = 'dssolution.in';
						$mail->SMTPAuth = true;
						$mail->Username = 'info@dssolution.in';
						$mail->Password = 'AdminNew@#$1234';
						$mail->SMTPSecure = 'ssl';
						$mail->Port     = 465;
						$mail->setFrom('info@dssolution.in', 'Standards Coordination Portal');
						$mail->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
						$mail->isHTML(true);
						
						// Add a recipient
						$mail->addAddress($email);
						
						$mail->Subject = 'Email VerificationStandard Coordination Portal | Member Password Recovery Link';
							$mailContent = "<p>Password Recovery Link : '.$link.'</p>";
						$mail->Body = $mailContent;
								$mail->send();
						if($mail->send()) echo 1;
						else echo 0;  
							else :
							echo 0;
							endif;
							else :
							redirect('login/index');
							endif;
				

		    }else{
			      /*$response = array(
				   'status' => 'error',
				    'message' => 'Please validate captcha.',*/
				 //'url' => $url
				 echo 2;
				 
		    }		 
	}
	public function rest_password_view()
	{ 
	       $key = $_GET['key'];
	       $member_id = $_GET['member_id'];
	       $res = $this->db->select('active_code')->where('user_id',$member_id)->get('users')->row();
	       if($res->active_code)
	       {
	    
	    	//$this->load->view('user/reset-password');
	    	   $data['page'] = 'front/reset-password';
	    	 $this->load->view('front/template',$data);
	       }else
	       {
	            redirect('login/');
	           
	       }
	    
	    
	}
	public function submit_password()
	{
	    extract($_POST);
     	if($_POST['password']!=""):
          $pass_encrypt=md5(($_POST['password']));
          $user_id= $_POST['member_id'];
           $fetch=$this->db->query("UPDATE `users` SET `password` = '$pass_encrypt'  ,`active_code`='' WHERE user_id ='$user_id'");
         if($fetch): echo 1;  
            else : echo 0;
            endif;
            else :
            redirect('login/index/');
            endif;
	}
	public function refresh(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
             'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '200',
		    'img_height'    => 50,
			'word_length'   => 4,
			'font_size'     => 100
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];
    }


	 
}





?>