<?php
date_default_timezone_set('Asia/Kolkata');
class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session');
		$this->load->model('super-admin/Auth_model','auth');

	}
	
	
	public function index()
	{
	    $data['page'] = 'front/signup';
		 $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
             'font_path'     => base_url() .'system/fonts/texb.ttf',
			'img_width'     => '200',
			'img_height'    => 50,
			'word_length'   => 4,
			'font_size'     => 100
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        
        // Pass captcha image to view
        $data['captchaImg'] = $captcha['image'];
		if($this->session->userdata('admin_id'))
		{
			redirect('super-admin/dashboard/');

		}else{
		$this->load->view('super-admin/login',$data);	
		}
		
	}
	public function logindone()
	{
		//$this->auth->isLoggedIn();
			$inputCaptcha = $this->input->post('captcha');
		$sessCaptcha = $this->session->userdata('captchaCode');
		if($inputCaptcha === $sessCaptcha)
		{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		//$type = $this->input->post('type');
		if($username==NULL)
		{
			//$this->session->set_flashdata('error','Please enter email.');
			redirect('auth/','refesh');
			
		}if($password==NULL)
		{
			//$this->session->set_flashdata('error','Please enter password.');
			redirect('auth/','refesh');
		}else{
	
        $hashpassword = md5($password);
      
        $query =  $this->auth->login($username,$hashpassword);
		if($query)
		{
			   if($query->status=='Y')
			   {
				
			      //$this->session->set_userdata('distributor_name', $query->distributor_name);
			      //$this->session->set_userdata('email', $query->username);
		           $this->session->set_userdata('superadmin_id', $query->superadmin_id);
			       $this->session->set_userdata('superadmin_name', $query->name);
			       $this->session->set_userdata('superadmin_username', $query->username);
			       $this->session->set_userdata('superadmin_email', $query->email);
			       $url = base_url().'super-admin/dashboard/';
			     //  $response = array(
        //             'status' => 'success',
        //             'message' => 'Login Successfully.',
        //             'url' => $url
        //           );
                            $this->session->set_flashdata('success','Login Successfully.');
	                          redirect($url);
				
			   }else
			   {
			    $this->session->set_flashdata('error','Your account is inactive');
			     $url = base_url().'super-admin/auth/';
			       redirect($url);
			     //  $response = array(
        //             'status' => 'error',
        //             'message' => 'Your account is inactive.',
        //             'url' => $url
        //              );
				
			   }
			
			
		    }else
		    {
			   $this->session->set_flashdata('error','Invaild Usernmae & password');
			   $url = base_url().'super-admin/auth/';
			       redirect($url);
			     //$url = base_url().'auth/';
			     //  $response = array(
        //             'status' => 'error',
        //             'message' => 'Invaild Usernmae & password.',
        //             'url' => $url
        //           );
			  //redirect('auth/','refesh');
		   }
        }
        }else
		{
		      $this->session->set_flashdata('error','Captcha not validated.');
		      $url = base_url().'super-admin/auth/';
			       redirect($url);
		  //  $response = array('status' => 'error',
    //                           'message' => 'Captcha not validated.');
		}
		echo  json_encode($response);
    }
	
	public function change_password()
	{
		//$data['view_data']= $this->profile->view_data($this->session->userdata('login_id'));
	    //$this->load->view('admin/category/list', $this->data, FALSE);
	    $this->auth->isLoggedIn();
		$data['profile']= $this->auth->getProfile($this->session->userdata('company_id'));
		$data['page'] = "profile/change-password";
        $this->load->view("template",$data);
	}
	  public function logout(){
            $this->session->sess_destroy();
            redirect(base_url().'admin/' ,'refresh');
            exit;
        }
		//Change the Password
	public function passwordChange()
	{
		
		 
		$admin_id = $this->session->userdata('superadmin_id');
		$old_password = trim($this->input->post('current_password'));
		//$current_password = $this->encrypt->encode($old_password);
		$new_password = $this->input->post('new_password');
		$confirm_password =  $this->input->post('confirm_password');
		//$newsPassword = password_hash($new_password, PASSWORD_DEFAULT);
		$newsPassword   = md5($new_password);
		//Check OldPassword
		$query =$this->db->query("SELECT  superadmin_id, password AS hash FROM super_admin WHERE 1=1 AND superadmin_id = ".$this->db->escape($admin_id)."  LIMIT 1");
		$row = $query->row();
		//$row = $query->result_array();
		//$result = $query->num_rows();
		if(md5($old_password) == $row->hash)
		{
			 $data = array('password'   => $newsPassword,
                      'updated_at'    => date("Y-m-d h:i:s"));
					   
        $this->db->where('superadmin_id', $admin_id);
        $this->db->update('super_admin', $data);
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
		 $user_id = $this->session->userdata('superadmin_id');
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
									   $this->db->where('user_id', $user_id);
									   $update = $this->db->update('users',$data);

                            $this->session->set_flashdata('success', 'Image update successfully.');
                             redirect('auth/my_profile/');
                }else{
                    $product_image1 = '';
					 $this->session->set_flashdata('error', 'Image not update successfully.');
                             redirect('auth/my_profile/');
                }
             }else
			 {
                $product_image1 = '';
				 //$this->session->set_flashdata('error', 'Please upload vaild image.');
                             //redirect('auth/my_profile/');
                 }
				 
		 if($this->input->post('name')  || $this->input->post('mobile_no')|| $this->input->post('email') || $this->input->post('username') )
		 {
			 
			 $data = array('name' => $this->input->post('name'),
			               'mobile_no' => $this->input->post('mobile_no'),
						         'email' => $this->input->post('email'),
						         'username' => $this->input->post('username'),     
						         'updated_at' => date('Y-m-d h:s:i'));
						   
									   $this->db->where('superadmin_id', $user_id);
									   $update = $this->db->update('super_admin',$data);
									   
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
        
	 
}

?>