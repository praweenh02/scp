<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Outreach extends CI_controller
{
	
		public function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session');
		$this->load->model('Login_model','auth');
		$this->load->model('Home_model','Home_model');
		$this->load->model('Outreach_model','outreach');
		$this->auth->isLoggedIn();

	}
	public function index()
	{

		$data['page'] = 'user/outreach/index';
		$data['outreach_list'] = $this->outreach->getAllOutreach();
        $this->load->view('user/template',$data);

	}
	public function sendemail($group_id)
	{
		$data['page'] = 'user/outreach/sendemail';
		$data['group_id'] = base64_decode($group_id);
		$data['outreach_list'] = $this->outreach->getAllOutreach();
        $this->load->view('user/template',$data);

	}
	 public function memberlist($group_id)
	{
		$data['page'] = 'user/outreach/member-list';
		$data['group_id'] = base64_decode($group_id);
		$data['member_list'] = $this->outreach->getAllMemberlist($group_id);
        $this->load->view('user/template',$data);

	}
	public function send_email_to_all()
	{
        error_reporting(0);
		$group_id = $this->input->post('group_id');
		$email_subject = $this->input->post('email_subject');
		$email_message = $this->input->post('email_message');
		$email_message.= 'With best regards,<br>TEC Standards Coordination Portal Management Service';
		$group_deatils = $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
		$send_type = $this->input->post('member_type');
		//$response = array();
		if($send_type =='website_subscriber')
		{

		   $subscribers = $this->db->select('*')->where('group_id',$group_id)->where('user_type','website_subscriber')->get('email_subscription');
		    
		}if($send_type =='group_member')
		{
		    $subscribers = $this->db->select('*')->where('group_id',$group_id)->where('user_type','group_member')->get('email_subscription');
		    
		}if($send_type =='group_member' AND $send_type =='website_subscriber')
		{
		    $subscribers = $this->db->select('*')->where('group_id',$group_id)->get('email_subscription');
		    
		}
		
		
		foreach ($subscribers->result() as $result) 
		{
			 $email_subscribers =   $result->user_email;
		
			
		

        $this->load->library('phpmailer_lib');
			   
        $mail = $this->phpmailer_lib->load();
        
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
        $mail->addAddress($email_subscribers);
        
        $mail->Subject =  '['.$group_deatils->shortform.']'.$email_subject.'-Email from Group admin';
        $mailContent   =  $email_message;;
        $mail->Body    =  $mailContent;
        //$mail->send();
       
        if($mail->send())
        {
        	$response = array('status'=>'success',
                               'message' => 'Email send successfully.');
        }else
        {
        	$response = array('status'=>'error',
                               'message' => 'Email not send successfully.');
 

        }
         
		} 
        echo  json_encode($response);
       
        
        
	}
		
	
}

?>
