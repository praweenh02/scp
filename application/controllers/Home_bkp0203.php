<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_controller
{
		public function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form','file','security');
	        $this->load->library('session','database','email');
	        $this->load->model('Home_model','Home_model');
	        $this->load->model('Dashboard_model','dash_model');
	        $this->load->library('phpmailer_lib');
	        $this->load->model('super-admin/Page_model','page_model');
		

	}
	public function index()
	{
	     $data['page'] = 'front/signup';
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
        $this->session->set_userdata('captchaCode', $captcha['word']);
        
        // Pass captcha image to view
        $data['captchaImg'] = $captcha['image'];
		$data['page'] = 'front/home';
		$data['sdo_list'] = $this->Home_model->getAllSDO(); 
		$data['working_group_list'] = $this->Home_model->getAllLatestWorkingGroups(); 
		$data['sdobulletin_list'] = $this->Home_model->getAllSDOBulletin(); 
        $data['faqs'] = $this->Home_model->getAllFaqs();
         $data['whatsnew_lsit'] = $this->Home_model->getAllWhatsnew();
                $this->load->view('front/template',$data);
	}

	public function signup()
	{
	     
		$data['page'] = 'front/signup';
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
        $this->session->set_userdata('captchaCode', $captcha['word']);
        
        // Pass captcha image to view
        $data['captchaImg'] = $captcha['image'];
		$data['group_category'] = $this->Home_model->getAllCatgory();
		//$data['working_group'] = $this->Home_model->getAllWorkingGroup();
               $this->load->view('front/template',$data);


	}
	public function success()
	{
		$data['page'] = 'front/success';
		$data['group_category'] = $this->Home_model->getAllCatgory();
		//$data['working_group'] = $this->Home_model->getAllWorkingGroup();
               $this->load->view('front/template',$data);


	}
	public function groups($sdo_id)
	{
		$data['page'] = 'front/sdo-details';
		$data['sdo_data'] = $this->Home_model->sdoDetails($sdo_id);
		$data['working_group_list'] = $this->Home_model->getAllWorkingGroup($sdo_id);
		$data['latest_working_groups'] = $this->Home_model->getLatestWorkingGroups($sdo_id);
               $this->load->view('front/template',$data);


	}
	public  function getAllGroups()
	{
		$category_id = $this->input->post('category_id');
		$working_group = $this->Home_model->getAllWorkingGroup($category_id);
		$output ='';
		$output .='<option value="">----Select Working Group----</option>';
                         	         
                             foreach($working_group as $wrd_grup):
                          
                             $output .='<option value='.$wrd_grup->group_id.'>'.$wrd_grup->shortform.'</option>';

                         
                                 endforeach;
            echo $output;
	}
public function save_signup()
	{
		extract($_POST);
		
		$inputCaptcha = $this->input->post('captcha');
		$sessCaptcha = $this->session->userdata('captchaCode');
		if($inputCaptcha === $sessCaptcha)
		{     $email = $this->input->post('email');
                $email_en = base64_encode($email);
		$echeckemail = $this->Home_model->Checkemailexit($email);
		if($echeckemail==0)
		{
			$otp = rand(000000,999999);
			 $dataarray = array('name' =>$name,
	                        'surname' =>$surname,
	                       'organization' => $organization,
	                       'designation' => $designation,
	                       'group_category_id' =>$group_category_id,
	                       'group_id' => $group_id,
	                       'contact_no' => $contact_no,
	                       'email' => $email,
	                       'landline' => $landline,
	                       'address' => $address,
	                       'city' =>$city,
	                       'state' =>$state,
	                       'pincode' => $pincode,
	                       'ip_address'=>$this->input->ip_address(),
	                       'created_at' => date('Y-m-d h:s:i a'));
	                        $grousp = $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
	                        $dataarray = $this->security->xss_clean($dataarray);

        $this->load->library('phpmailer_lib');
			   
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $current_url = $_SERVER['SERVER_NAME'];
        {
               // SMTP configuration For Tec.gov
        $mail->Host     = 'relay.nic.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'adic1.tec@gov.in';
        $mail->Password = 'Stec#2020';
        $mail->SMTPSecure = 'tls';
        $mail->CharSet = 'UTF-8';
        $mail->Port     = 25;
        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }

        $mail->isHTML(true);
        
       // Add a recipient
        $mail->addAddress($email);
        
        $mail->Subject = '['.$grousp->shortform.'] signup '.$name.' '.$surname.' - Standards Coordination Portal';
              $mailContent = "<p>Dear Sir/Madam,<br>
Your account verification OTP is  ".$otp."<br>
If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback
</p> <p><b>With best regards,<br>
TEC Standards Coordination Portal Management Service</b><p>";
        $mail->Body = $mailContent;
                $mail->send();

		        $insert = $this->Home_model->save_signup($dataarray,$email,$otp);
		            if($insert===true)
		            {
                           $response = array('status' => 'success',
                           	      'email' =>$email_en,
                                   'message' => 'Account request created successfully, please verify your email with OTP.');

                     }else
                     {
                         
                      $response = array('status' => 'error',
                               'message' => 'Account not created!');
                 
		              }

		}else
		{
			 $response = array('status' => 'error',
                               'message' => 'Email already exists.');
		}

	}else
	{
		$response = array('status' => 'error',
                               'message' => 'Captcha not validated.');

	}
              

		

		echo json_encode($response);

	}
	public function verify_email()
	{
	   // error_reporting(0);
		 $email = $this->input->post('verified_email');
		 $dcemail = base64_encode($email);
		$otp = $this->input->post('otp');
		$our_ipaddress= $this->input->ip_address();
		$date = date('Y-m-d');
		$otp_insertt = $this->db->set('otp',$otp)->set('ip_address',$our_ipaddress)->set('type','signup')->set('created_at',date('Y-m-d'))->insert('user_otp');
		$opt_attemp = $this->db->select('*')->where('ip_address',$our_ipaddress)->where('created_at', $date)->set('type','signup')->get('user_otp')->num_rows();
		if($opt_attemp <= 10)
		{
		       $insert = $this->Home_model->verify_email($email,$otp);

				if($insert)
				{
							$rows = $this->db->select('*')->where('email',$email)->order_by('user_id','DESC')->limit('1')->get('temp_users')->row();
				                 //extract($rows);
					             $dataarray = array('name' =>$rows->name,
			                        'surname' =>$rows->surname,
			                       'organization' => $rows->organization,
			                       'designation' => $rows->designation,
			                       'group_category_id' =>$rows->group_category_id,
			                       'group_id' => $rows->group_id,
			                       'contact_no' => $rows->contact_no,
			                       'email' => $rows->email,
			                       'landline' => $rows->landline,
			                       'address' => $rows->address,
			                        'city' =>$rows->city,
			                       'state' =>$rows->state,
			                       'pincode' => $rows->pincode,
			                        'verified_email'=>'Y',
			                       'created_at' => date('Y-m-d h:s:i a'));
			                        $dataarray = $this->security->xss_clean($dataarray);
			                       $insert2 = $this->db->insert('users',$dataarray);
				}
		
				         
        

		            if($insert2===true)
		            {
		                 $grousp = $this->db->select('*')->where('group_id',$rows->group_id)->get('groups')->row();
						  
				          $this->load->library('phpmailer_lib');
				        
				        // PHPMailer object
				        $mail = $this->phpmailer_lib->load();
				        
				        // SMTP configuration
				        $mail->isSMTP();
				      $current_url = $_SERVER['SERVER_NAME'];
				        {
				               // SMTP configuration For Tec.gov
				        $mail->Host     = 'relay.nic.in';
                                        $mail->SMTPAuth = true;
                                        $mail->Username = 'adic1.tec@gov.in';
                                        $mail->Password = 'Stec#2020';
                                        $mail->SMTPSecure = 'tls';
                                        $mail->CharSet = 'UTF-8';
				        $mail->Port     = 25;
				        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
				        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
				            
				        }

				        $mail->isHTML(true);
				        
				       // Add a recipient
				        $mail->addAddress($email);
				        
				        $mail->Subject ='['.$grousp->shortform.'] signup '.$rows->name.' '.$rows->surname.' - Standards Coordination Portal';
				        
				        // Email body content
				        //$mailContent = "<h3>Dear ".$rows->name."&nbsp;".$rows->surname."</h3>
				            $mailContent="<h3>Dear Sir/Madam,</h3><br>
				            <p>Your email id has been verified and now your request has been forwarded to the concerned Group Admin.
				If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback</p>
				 <p>With best regards,<br>
				<strong>TEC Standards Coordination Portal  Management Service.</strong></p>";
				        $mail->Body = $mailContent;
				        $mail->send();
				        // For Group Admin
				        $group_admin = $this->db->select('group_managers.*,users.*')->join('users','group_managers.member_id=users.user_id','left')->where('group_managers.group_id',$rows->group_id)->get('group_managers');
				      
				        foreach($group_admin->result() as $gm_result)
				        {
				        // SMTP configuration
				        $mail1 = $this->phpmailer_lib->load();
				        $mail1->isSMTP();
				        $current_url = $_SERVER['SERVER_NAME'];
				        {
				               // SMTP configuration For Tec.gov
				        $mail1->Host     = 'relay.nic.in';
                                        $mail->SMTPAuth = true;
                                        $mail->Username = 'adic1.tec@gov.in';
                                        $mail->Password = 'Stec#2020';
                                        $mail->SMTPSecure = 'tls';
                                        $mail->CharSet = 'UTF-8';
				        $mail1->Port     = 25;
				        $mail1->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
				        $mail1->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
				            
				        }
				        $mail1->isHTML(true);
				        
				       // Add a recipient
				        $mail1->addAddress($gm_result->email);
				        
				        $mail1->Subject = '['.$grousp->shortform.'] signup '.$rows->name.' '.$rows->surname.' - Standards Coordination Portal';
				        
				        // Email body content
				        //$mailContent = "<h3>Dear ".$rows->name."&nbsp;".$rows->surname."</h3>
				            $mailContent1="<h3>Dear Sir/Madam,</h3><br>
				            <p>A new member request has been received. It is requested to take necessary action please.</p>
				        <p>With best regards,<br>
				          <strong>TEC Standards Coordination Portal  Management Service.</strong></p>";
				        $mail1->Body = $mailContent1;
				        $mail1->send();
				        }
				        
		                
	                       
                        //   $response = array('status' => 'success',
                        //   	                  'email' =>$email,
                        //   	                  'st1' =>$insert2,
                        //                       'message' => 'Your account request registered successfully.');
                                              
                                $this->session->set_flashdata('success','Your account request registered successfully.');
			                    redirect('home/success/');

                     }else
                     {
                         $url = base_url().'home/signup/?verifyemail='.$dcemail;
                    //   $response = array('status' => 'error',
                    //                      'st1' =>$insert,
                    //                       'message' => 'Your OTP is not correct.');
                                             $this->session->set_flashdata('error','Your OTP is not correct.');
			                                 redirect($url);
                 
		            }

        }else
        {
        // 	 $response = array('status' => 'error',
        //                       'message' => 'Your daily otp limit is exist.');
                                  $url = base_url().'home/signup/?verifyemail='.$dcemail;
                                  $this->session->set_flashdata('error','Your daily otp limit is exist.');
			                       redirect('home/signup/?verifyemail='.$dcemail);

        }
      
		              echo json_encode($response);
      
		
	}
	public function resendotp($email)
	{
	     $dcemail = base64_decode($email);
	     $otp = rand(000000,999999);
	     $our_ipaddress= $this->input->ip_address();
	     $otp_insertt = $this->db->set('otp',$otp)->set('ip_address',$our_ipaddress)->set('type','signup')->set('created_at',date('Y-m-d'))->insert('user_otp');
	  	 $opt_attemp = $this->db->select('*')->where('ip_address',$our_ipaddress)->where('created_at', $date)->set('type','signup')->get('user_otp')->num_rows();
		    if($opt_attemp <= 10)
		 {
	    
	       if($email)
	       {
	           $resendotp = $this->Home_model->resendotp($dcemail,$otp);
	           
	        
                $this->load->library('phpmailer_lib');
			   
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $current_url = $_SERVER['SERVER_NAME'];
        {
               // SMTP configuration For Tec.gov
        $mail->Host     = 'relay.nic.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'adic1.tec@gov.in';
        $mail->Password = 'Stec#2020';
        $mail->SMTPSecure = 'tls';
        $mail->CharSet = 'UTF-8';
        $mail->Port     = 25;
        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }

        $mail->isHTML(true);
        
       // Add a recipient
        $mail->addAddress($dcemail);
        $mail->Subject = 'Resend OTP - Standards Coordination Portal';
              $mailContent = "<p>Dear Sir/Madam,<br>
Your account verification OTP is  ".$otp."<br>
If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback
</p> <p><b>With best regards,<br>
TEC Standards Coordination Portal Management Service</b><p>";
        $mail->Body = $mailContent;
                $mail->send();
                
                if($resendotp)
                {
                            $this->session->set_flashdata('success','OTP sent successfully.');
	           redirect('home/signup/?verifyemail='.$email);
                    
                }else
                {
                     $this->session->set_flashdata('error','OTP is not sent.');
	           redirect('home/signup/?verifyemail='.$email);
                    
                }
                
	    
	       //
	    }else
	       {
	         $this->session->set_flashdata('error','Please enter vaild email.');
	        redirect('home/signup/?verifyemail='.$email);
	       }
		}else
		{
		  //   $response = array('status' => 'error',
    //                           'message' => 'Your daily otp limit is exist.');
    //                             echo json_encode($response);
           $this->session->set_flashdata('error','Your daily otp limit is exist.');
	        redirect('home/signup/?verifyemail='.$email);
		    
		}
		
	    
	    
	}
	public function sdobulletin($sdobulletin_id)
	{
		$data['page'] = 'front/sdo-bulletin-list';
		$data['allsdo_bulletin_list'] = $this->Home_model->getAllSDOBulletinList($sdobulletin_id);
		
                $this->load->view('front/template',$data);


	}
	public function load_event()
	{

		$events = $this->dash_model->get_event_list();
		 foreach($events as $result)
		{
		 	$response[] = array( 'title' => $result->meeting_title,
                                 'start' =>$result->meeting_date,
		 		                 'end' =>$result->meeting_end_date);

		 	
		 }
		 echo  json_encode($response);
	}
	public function setfirsttimepassword($member_id,$token)
	{
	    error_reporting(0);
	    $res1 = $this->db->select('token')->where('user_id',$member_id)->get('users')->row();
	           if($res1->token == $token)
	           {
	               $data['page'] = 'front/first-time-password-set';
	          	$data['set_password'] = $this->Home_model->setToken($member_id,$token);
	          	
		        //$data['working_group'] = $this->Home_model->getAllWorkingGroup();
               $this->load->view('front/template',$data);
	               
	           }else
	           { 
	                redirect(base_url(), 'location');
	               
	           }
	    		
	    
	    
	}
	public function set_password()
	{
	    $member_id = $this->input->post('member_id');
	    $token = $this->input->post('token');
	    $password = md5(trim($this->input->post('password')));
	     $confirm_password = md5($this->input->post('confirm_password'));
	    
	    if($password && $confirm_password)
	    {
	        $update = $this->db->set('password',$password)->set('token','')->where('user_id',$member_id)->update('users');
	        
	          if($update===true)
		            {
		                $this->db->set('token','')->where('user_id',$member_id)->update('users');
                           $response = array('status' => 'success',
                           	      
                                   'message' => 'Password set successfully.');

                     }else
                     {
                      $response = array('status' => 'error',
                               'message' => 'Password not set.');
                 
		              }
	    }
	     echo json_encode($response);
	    
	}
	public  function getAllWorkItem()
	{
		$category_id = $this->input->post('category_id');
		//$working_group = $this->Home_model->getAllWorkingGroup($category_id);
		$working_group = $this->db->select('*')->where('question_id',$category_id)->where('work_item_status','Y')->get('work_item')->result();
		$output ='';
		$output .='<option value="">----Select Work Item----</option>';
                         	         
                             foreach($working_group as $wrd_grup):
                          
                             $output .='<option value='.$wrd_grup->workitem_id.'>'.$wrd_grup->work_item.'</option>';

                         
                                 endforeach;
            echo $output;
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
    public function sumitEmailSubscription()
    {
        extract($_POST);
        if($submitbutton)
        {
        $inputCaptcha = $this->input->post('captcha');
		 $sessCaptcha = $this->session->userdata('captchaCode');
       if($inputCaptcha === $sessCaptcha)
		{
            $emailCheeck = $this->db->select('*')->where('user_email',$email)->where('user_type','website_subscriber')->where('email_verify','Y')->where('group_id',$group_id)->get('email_subscription')->num_rows();
            if($emailCheeck==0)
            {
                 
        
            $dataarray = array('sdo_id'=>$group_category_id,
                                'group_id' =>$group_id,
                                  'first_name' =>$first_name,
                                   'last_name' => $last_name,
                                     'user_email' => $email,
                                      'phone_no'=>$phone_no,
                                      'organization' => $organization,
	                                    'designation' => $designation,
                                      'email_subscription' =>'Y',
                                       'user_type' => 'website_subscriber',
                                        'create_at' => date('Y-m-d H:s:i'));
                                         $dataarray = $this->security->xss_clean($dataarray);
                                        $insert = $this->db->insert('email_subscription', $dataarray);
                                        $lastinter_id = $this->db->insert_id();
                                        if($insert)
                                        {
                                          $otp =rand(000000,999999);
                                            
                                        $otp_insert = $this->db->set('email',$email)->set('otp',$otp)->set('status','pending')->insert('otp');            
                                         //for email  
                                        $group_deatils1 = $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
                                      
            $this->load->library('phpmailer_lib');
        
        // PHPMailer object
       
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
       $current_url = $_SERVER['SERVER_NAME'];
        //print_r($current_url);
        //die();
        {
               // SMTP configuration For Tec.gov
        $mail->Host     = 'relay.nic.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'adic1.tec@gov.in';
        $mail->Password = 'Stec#2020';
        $mail->SMTPSecure = 'tls';
        $mail->CharSet = 'UTF-8';
        $mail->Port     = 25;
        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }
     

        $mail->isHTML(true);
        
       // Add a recipient
        $mail->addAddress($email);
        
        $mail->Subject = '['.$group_deatils1->shortform.']- Email subscription';
        
        // Email body content
        $mailContent = "<h3>Dear Sir/Madam,</h3>
        <p>Your account verification OTP is  ".$otp.".</p>
        <p>If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback</p>

<p>With best regards,<br><strong>TEC Standards Coordination Portal  Management Service.</strong></p>";
        $mail->Body = $mailContent;
                $mail->send();
                                            
                                         //$this->session->set_flashdata('success', 'Please check register email.');
                                       redirect('home/otpsend');
                                        }else
                                        {
                                            $this->session->set_flashdata('error', 'OTP not send  successfully.');
                                       redirect(base_url());
                                            
                                        }
               }else
               {
                 $this->session->set_flashdata('error', 'Email already taken.');
                                       redirect(base_url());
                
              }
          
		  
        }else
        {
             $this->session->set_flashdata('error', 'Captcha not validated.');
                                       redirect(base_url());
            
        }
	    
        }
        
    }
    public function deletesubscibtion($user_id)
    {
      $delete = $this->db->where('emai_subscription_id',$user_id)->delete('email_subscription');
        if($delete)
        {
                $data['page'] = 'front/unsubscriber';
	    		$data['success_type'] ="otp";
		        $data['group_category'] = $this->Home_model->getAllCatgory();
		        //$data['working_group'] = $this->Home_model->getAllWorkingGroup();
                $this->load->view('front/template',$data);
            
          
            
        }else
        {
              redirect(base_url());
            
        }
        
    }
    public function otpsend()
	{
		$data['page'] = 'front/otpsend';
		$data['group_category'] = $this->Home_model->getAllCatgory();
		$data['result'] = $this->db->select('*')->where('email_verify','N')->where('user_type','website_subscriber')->order_by('emai_subscription_id','DESC')->limit('1')->get('email_subscription')->row();
        $this->load->view('front/template',$data);


	}
	public function subresendotp($email)
	{
	       $dcemail = base64_decode($email);
	     	$otp = rand(000000,999999);
	    
	    if($dcemail)
	    {
	           $resendotp = $this->Home_model->resendotp($email,$otp);
	           
	          $from_email = "noreply.tec-dot@gov.in";
                 $to_email = $dcemail;
                //Load email library
                $this->load->library('email');
                $this->email->from($from_email, 'Standards Co-ordination Portal');
                $this->email->to($dcemail);
                $this->email->subject('OTP Email');
                $this->email->message('Your account verification OTP is '.$otp);
                $this->email->send();
                
                 $this->load->library('phpmailer_lib');
        
        // PHPMailer object
       
        $mail = $this->phpmailer_lib->load();
       $current_url = $_SERVER['SERVER_NAME'];
        // SMTP configuration
        $mail->isSMTP();
        {
               // SMTP configuration For Tec.gov
        $mail->Host     = 'relay.nic.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'adic1.tec@gov.in';
        $mail->Password = 'Stec#2020';
        $mail->SMTPSecure = 'tls';
        $mail->CharSet = 'UTF-8';
        $mail->Port     = 25;
        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }
        $mail->isHTML(true);
        
       // Add a recipient
        $mail->addAddress($email);
        
        $mail->Subject = '['.$group_deatils->shortform.']- Email subscription';
        
        $mailContent = "<h3>Dear Sir/Madam,</h3>
        <p>Your account verification OTP is  ".$otp.".</p>
        <p>If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback</p>
        <p>With best regards,<br><strong>TEC Standards Coordination Portal  Management Service.</strong></p>";
        $mail->Body = $mailContent;
                $mail->send();
                if($resendotp)
                {
                         $this->session->set_flashdata('success','OTP sent successfully.');
	                      redirect('home/otpsend');
                    
                }else
                {
                      $this->session->set_flashdata('error','OTP is not sent.');
	                redirect('home/otpsend');
                    
                }
                
	    
	       //
	    }else
	    {
	         $this->session->set_flashdata('error','Please enter vaild email.');
	        redirect('home/otpsend');
	    }
	    
	    
	}
	public function subscriptionverify_email()
	{
	    $email = $this->input->post('verified_email');
		$group_id  =$this->input->post('group_id');
		$otp = $this->input->post('otp');
		if($otp && $email)
		{
		 	$insert = $this->Home_model->verify_email($email,$otp);
		 	
		$update = $this->db->set('email_verify','Y')->set('email_subscription','Y')->where('user_email',$email)->update('email_subscription');
		$user = $this->db->select('*')->where('user_email',$email)->get('email_subscription')->row();
		//$group_id = $user->group_id;
		$group_deatils = $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
	  if($update && $insert)
	    	{
	    	       
				// PHPMailer object
			
				$mail = $this->phpmailer_lib->load();
				
				// SMTP configuration
				$mail->isSMTP();
	   $current_url = $_SERVER['SERVER_NAME'];
        {
               // SMTP configuration For Tec.gov
        $mail->Host     = 'relay.nic.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'adic1.tec@gov.in';
        $mail->Password = 'Stec#2020';
        $mail->SMTPSecure = 'tls';
        $mail->CharSet = 'UTF-8';
        $mail->Port     = 25;
        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }
				$mail->isHTML(true);
				
			// Add a recipient
				$mail->addAddress($email);
				
				$mail->Subject = '['.$group_deatils->shortform.']- Email subscription';
				
				// Email body content
						$mailContent = "<Dear Sir/Madam,<br>
					You have been successfully subscribed to the following service: TEC>SCP>".$group_deatils->shortform."<br>
					<a href='".base_url()."home/deletesubscibtion/".$user->emai_subscription_id."'>Click here</a> to unsubscribe.<br>
					If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback</p>
					<p>With best regards,<br><strong>TEC Standards Coordination Portal  Management Service.</strong></p>";
					$mail->Body = $mailContent;
					$mail->send();
						
		       $response = array('status' => 'success',
                              'message' => 'Email Subscription Successfully.');
                                //$this->session->set_flashdata('success','Email //Subscription Successfully');
	                           //redirect('home/successotp');
		}else
	       {
	     	$response = array('status' => 'error',
                               'message' => 'OTP not send sucessfully.');
                                   //$this->session->set_flashdata('error','Someting went to worng.');
	                          // redirect('home/otpsend');

	        }
		    
		}else{
		    	$response = array('status' => 'error',
                               'message' => 'Please fill OTP.');
                                //'message' => $email);
                               //$this->session->set_flashdata('error','Someting went to worng.');
	                          // redirect('home/otpsend');

		    
		}
		echo json_encode($response);
	    
	}
	public function successotp()
	{
	    		$data['page'] = 'front/success';
	    		$data['success_type'] ="otp";
		        $data['group_category'] = $this->Home_model->getAllCatgory();
		       //$data['working_group'] = $this->Home_model->getAllWorkingGroup();
               $this->load->view('front/template',$data);
	    
	}
	public function about()
	{
	    	  $data['page'] = 'front/about';
	    		$data['success_type'] ="otp";
		        $data['group_category'] = $this->Home_model->getAllCatgory();
		       //$data['working_group'] = $this->Home_model->getAllWorkingGroup();
               $this->load->view('front/template',$data);
	    
	}
		public function helpdesk()
	{
	    	  $data['page'] = 'front/helpdesk';
	    		$data['success_type'] ="otp";
		        $data['group_category'] = $this->Home_model->getAllCatgory();
		       //$data['working_group'] = $this->Home_model->getAllWorkingGroup();
               $this->load->view('front/template',$data);
	    
	}
	public function feedback()
	{
	            $data['page'] = 'front/helpdesk';
	    		$data['success_type'] ="otp";
		        $data['group_category'] = $this->Home_model->getAllCatgory();
		        //$data['working_group'] = $this->Home_model->getAllWorkingGroup();
                $this->load->view('front/template',$data);
	    
	}
	public function page($page_slug)
	{
			$data['page'] = 'front/page';
		    //$data['sdo_data'] = $this->Home_model->sdoDetails($sdo_id);
		    $data['result'] = $this->page_model->getPageDetails($page_slug);
            $this->load->view('front/template',$data);

	}
        
        

 


}
?> 
