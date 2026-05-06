<?php
class Groupmanager extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form','security','remove_special_helper');
		$this->load->library('session','database');
		$this->load->model('Login_model','auth');
		$this->load->model('Dashboard_model','dash_model');
		$this->load->model('Groupmanager_model','gm_model');
		$this->load->model('Member_model','member_model');
		$this->group_id = $this->session->userdata('group_id');
		$this->auth->isLoggedIn();
	}
	public function manage_restricted_bulletin_board_of_the_working_group()
	{
		$data['page']   =   "user/group-manager/manage-bulletin";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));

		$this->load->view('user/template',$data);
		
		
	}

	public function manage_document_uploaded_by_member()
	{
		$data['page']   =   "user/group-manager/manage-member-upload-document";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['documnet_list'] = $this->gm_model->getAllMemberDocuments($this->group_id);
		$this->load->view('user/template',$data);


	}
	public function document_expiry()
	{
		$data['page']   =   "user/group-manager/document-expiry";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['document_list']= $this->gm_model->getDocumntExpriyDate($this->group_id);
		$this->load->view('user/template',$data);


	}
	public function add_upload_documnt_expiry_date($documentexpirydate_id)
	{
		$data['page']   =   "user/group-manager/add-upload-documnt-expiry-date";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['group_list'] = $this->gm_model->getAllMyGroups($this->session->userdata('user_id'));
		$data['result'] = $this->gm_model->getOneExpiryDate($documentexpirydate_id);
		$this->load->view('user/template',$data);

	}

	public function save_document_expiry_date()
	{
		extract($_POST);

		$documentexpirydate_id = $this->input->post('documentexpirydate_id');
		
		$newstart_date = date("Y-m-d", strtotime($start_date));
		$newend_date = date("Y-m-d", strtotime($end_date));

		if($newstart_date <= $newend_date)
			if($documentexpirydate_id==0)
			{

				$dataarray = array('group_id' =>$group_id,
				                'meeting_id' =>$meeting_id,
					'start_date' =>$newstart_date,
					'end_date' => $newend_date,
					'created_at' => date('Y-m-d h:s:i a'));

                $dataarray = $this->security->xss_clean($dataarray);
				$insert =  $this->gm_model->saveExpiryDate($dataarray);

				if($insert===true)
				{
					$response = array('status' =>'success',
						'message' =>'Expiry date added successfully.' );
				}else
				{
					$response = array('status' =>'success',
						'message' =>'Expiry date not added.' );

				}

			}else
			{		 $dataarray = array('group_id' =>$group_id,
		                     	'meeting_id' =>$meeting_id,
				'start_date' =>$newstart_date,
				'end_date' => $newend_date,
				'status'  => $status,
				'updated_at' => date('Y-m-d h:s:i a'));
                    $dataarray = $this->security->xss_clean($dataarray);
			$update =  $this->gm_model->updateExpiryDate($dataarray,$documentexpirydate_id);

			if($update===true)
			{
				$response = array('status' =>'success',
					'message' =>'Expiry date updated successfully.' );
			}else
			{
				$response = array('status' =>'success',
					'message' =>'Expiry date not updated.' );

			}
		}else
		{
			$response = array('status' =>'error',
				'message' =>'The start date can not be greater then the end date.' );
		}


		echo json_encode($response);


	}
	public function delete_document_expiry_date()
	{

		$documentexpirydate_id =  $this->input->post('id');


		$delete = $this->gm_model->deleteDocumentExpiryDate($documentexpirydate_id);
		if($delete)
		{

			echo "success";
		}
	}
	public function group_list()
	{
		$data['page']   =   "user/group-manager/group-list";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['groups'] = $this->member_model->getAllMyGroups($this->session->userdata('user_id'),$this->session->userdata('group_id'));
		$this->load->view('user/template',$data);


	}
	public function groupedit($group_id)
	{
		$data['page']   =   "user/group-manager/group-edit";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['result'] = $this->gm_model->getActGroup($group_id);
		$this->load->view('user/template',$data);

	}
	public function manage_corresponding($group_id)
	{
		$data['page']   =   "user/group-manager/manage-corresponding";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['group_data'] = $this->gm_model->getActGroup($group_id);
		$data['corresponding_lits'] = $this->gm_model->getAllCorresponding($group_id);
		$this->load->view('user/template',$data);

	}
	public function updateGroup()
	{
		extract($_POST);
		$group_id = $this->input->post('group_id');

		if($group_id)
		{

			$dataarray = array('group_description' => $group_description,
				'updated_at' => date('Y-m-d h:s:i a'));
              $dataarray = $this->security->xss_clean($dataarray);
			$update = $this->gm_model->UpdateGroup($dataarray, $group_id);
			if($update===true)
			{
				$response = array('status' =>'success',
					'message' =>'Group updated successfully.' );
			}else
			{
				$response = array('status' =>'error',
					'message' =>'Group not updated.' );
			}


		}else{
			$response = array('status' =>'error',
				'message' =>'Somthing went to wrong.' );


		}
		echo json_encode($response);

		
	}
	public function add_corresponding_modal()
	{
		$corresponding_id= $this->input->post('corresponding_id');
		$group_id =  $data['group_id'] = $this->input->post('group_id');
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['result'] = $this->gm_model->getOneCorresponding($corresponding_id,$group_id);
		$this->load->view('user/group-manager/add-corresponding-modal',$data);


	}

	public function save_corresponding()
	{
		extract($_POST);

		$corresponding_id = $this->input->post('corresponding_id');

		if($corresponding_id)
		{
			$dataarray = array('group_id' =>$group_id,
				'corresponding_title' =>$title,
				'corresponding_url' => $url,
				'corrseponding_status'  => $status,
				'updated_at' => date('Y-m-d h:s:i a'));
              $dataarray = $this->security->xss_clean($dataarray);
			$update =  $this->gm_model->updateCorresponding($dataarray,$corresponding_id);
			if($update===true)
			{
				$response = array('status' =>'success',
					'message' =>'Corresponding updated successfully.' );
			}else
			{
				$response = array('status' =>'success',
					'message' =>'Corresponding not updated.' );
			}



		}else
		{
			$dataarray = array('group_id' =>$group_id,
				'corresponding_title' =>$title,
				'corresponding_url' => $url,
				'created_at' => date('Y-m-d h:s:i a'));
                $dataarray = $this->security->xss_clean($dataarray);
			$update =  $this->gm_model->saveCorresponding($dataarray);
			if($update===true)
			{
				$response = array('status' =>'success',
					'message' =>'Corresponding data created successfully.' );
			}else
			{
				$response = array('status' =>'success',
					'message' =>'Corresponding not created.' );
			}




		}
		echo json_encode($response);


	}
	public function delete_corresponding()
	{
		$corresponding_id = $this->input->post('id');
		$delete = $this->gm_model->deleteCorresponding($corresponding_id);
		if($delete)
		{

			echo "success";
		}


	}
	public function manage_management_team($group_id)
	{

		$data['page']   =   "user/group-manager/manage-group-management-team";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['group_data'] = $this->gm_model->getActGroup($group_id);
		$data['management_team_lits'] = $this->gm_model->getAllManagementTeam($group_id);
		$this->load->view('user/template',$data);




	}
	public function add_management_team_modal()
	{
		$managementteam_id = $this->input->post('managementteam_id');
		$group_id =  $data['group_id'] = $this->input->post('group_id');
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['result'] = $this->gm_model->getOneManagementTeam($managementteam_id,$group_id);
		$this->load->view('user/group-manager/add-management-team-modal',$data);


	}
	public function save_managementTeam()
	{
		extract($_POST);

		$managementteam_id  = $this->input->post('managementteam_id');

		if($managementteam_id)
		{
			$dataarray = array('group_id' =>$group_id,
				'title' =>$title,
				'description' => trim($description),
				'managementteam_status'  => $status,
				'updated_at' => date('Y-m-d h:s:i a'));
            $dataarray = $this->security->xss_clean($dataarray);
			$update =  $this->gm_model->updateManagementTeam($dataarray,$managementteam_id);
			if($update===true)
			{
				$response = array('status' =>'success',
					'message' =>'Management team updated successfully.' );
			}else
			{
				$response = array('status' =>'success',
					'message' =>'Management team not updated.' );
			}



		}else
		{
			$dataarray = array('group_id' =>$group_id,
				'title' =>$title,
				'description' => trim($description),
				'created_at' => date('Y-m-d h:s:i a'));
                $dataarray = $this->security->xss_clean($dataarray);
			$update =  $this->gm_model->saveManagementTeam($dataarray);
			if($update===true)
			{
				$response = array('status' =>'success',
					'message' =>'Management team added successfully.' );
			}else
			{
				$response = array('status' =>'success',
					'message' =>'Management team not created.' );
			}




		}
		echo json_encode($response);


	}
	public function deleteManagementTeam()
	{
		$managementteam_id = $this->input->post('id');
		$delete = $this->gm_model->deleteManagementTeam($managementteam_id);
		if($delete)
		{

			echo "success";
		}


	}
	//Group Meeting
	public function group_meeting()
	{
		

		$data['page']   =   "user/group-manager/group-meeting";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        //$data['group_data'] = $this->gm_model->getActGroup($group_id);
		$data['meeting_list'] = $this->gm_model->getAllMeeting($this->group_id);
		$this->load->view('user/template',$data);
	}
	public function add_meeting($meeting_id=0)
	{
		$data['page']   =   "user/group-manager/add-group-meeting";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['result'] = $this->gm_model->getActGroupMeeting($meeting_id,$this->session->userdata('user_id'));
		$data['group_list'] = $this->gm_model->getAllMyGroups($this->session->userdata('user_id'));
		$this->load->view('user/template',$data);


	}
	public function save_meeting()
	{
		extract($_POST);
		//error_reporting(0);

		$meeting_id  = $this->input->post('meeting_id');
		$newmeetingdate = date('Y-m-d', strtotime($this->input->post('meeting_date')));
		$newendmeddting_date = date('Y-m-d', strtotime($this->input->post('meeting_end_date')));
		if($meeting_id)
			{ 
			 if(!empty($_FILES['meeting_file']['name']))
		    {
		   	    $new_name  = time().url_title($_FILES["meeting_file"]['name']).'.'.pathinfo($_FILES["meeting_file"]["name"], PATHINFO_EXTENSION);;
			    $config['upload_path'] = 'uploads/meeting-file/';
			    $config['allowed_types'] = 'pdf|doc|docx';
			    $config['file_name'] = $new_name;
		   	    $config['fileExt']  = pathinfo($_FILES["meeting_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			    $this->load->library('upload',$config);
			    $this->upload->initialize($config);

			if($this->upload->do_upload('meeting_file'))
			{
				$uploadData = $this->upload->data();
				$meeting_file = $new_name;

				$query = $this->db->where('meeting_id',$meeting_id)->set('meeting_file',$meeting_file)->update('group_meeting');

			}else
			{
				$meeting_file = '';
				$response = array('status' =>'error',
				'message' =>'Please select only  doc file.' );
					echo json_encode($response);
				die();

			}
		} 
		if(preg_match('/[^a-z0-9 _]+/i', $meeting_title))
		{
		       	
		     	$response = array('status' =>'error',
    				'message' =>'Special characters not allowed.');
		    
    	
		    
		}else
		{
        	   	    $dataarray = array('group_id' =>$group_id,
        			'meeting_title' =>$meeting_title,
        				'meeting_type' =>$meeting_type,
        			'meeting_date' => $newmeetingdate,
        			'meeting_end_date' =>$newendmeddting_date,
        			'user_id'      => $this->session->userdata('user_id'), 
        			'meeting_status'  => $status,
        			'updated_at' => date('Y-m-d h:s:i a'));
                     $dataarray = $this->security->xss_clean($dataarray);
        		$update =  $this->gm_model->updateMeeting($dataarray,$meeting_id);
        		if($update===true)
        		{
        			$response = array('status' =>'success',
        				'message' =>'Meeting  updated successfully.' );
        		}else
        		{
        			$response = array('status' =>'error',
        				'message' =>'Meeting not updated.' );
        		}
		}



	   }else
	   {
		    if($_FILES['meeting_file']['name'])
		    {
			   $new_name  = time().url_title($_FILES["meeting_file"]['name']).'.'.pathinfo($_FILES["meeting_file"]["name"], PATHINFO_EXTENSION);;
			   $config['upload_path'] = 'uploads/meeting-file/';
			   $config['allowed_types'] = 'pdf|doc|docx';
			   $config['file_name'] = $new_name;
			   $config['fileExt']  = pathinfo($_FILES["meeting_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			   $this->load->library('upload',$config);
			   $this->upload->initialize($config);

			   if($this->upload->do_upload('meeting_file'))
			   {
				$uploadData = $this->upload->data();
				$meeting_file = $new_name;


			    }else
			   {
				$meeting_file = '';
					$response = array('status' =>'error',
				'message' =>'Please select only  doc file.' );
					echo json_encode($response);
				die();

			    }
		} 
		  //function check_string($my_string){
    //              $regex = preg_match('[@_!#$%^&*()<>?/|}{~:]', $my_string);
    //              if($regex)
    //               print("String has been accepted");
    //              else
    //               print("String has not been accepted");
    //                   }
		
		//if(preg_match('[@_!#$%^&*()<>?/|}{~:]', $meeting_title))
		if(preg_match('/[^a-z0-9 _]+/i', $meeting_title))
		{
		       	
		     	$response = array('status' =>'error',
    				'message' =>'Special characters not allowed.');
		    
    	
		    
		}else
		{
		    $dataarray = array('group_id' =>$group_id,
    			'meeting_title' =>$meeting_title,
    			'meeting_type' =>$meeting_type,
    			'meeting_date' => $newmeetingdate,
    		    'meeting_end_date' =>$newendmeddting_date,
    			'user_id'      => $this->session->userdata('user_id'), 
    			'meeting_file' => $meeting_file,
    			'created_at' => date('Y-m-d h:s:i a'));
                 $dataarray = $this->security->xss_clean($dataarray);
    		$update =  $this->gm_model->saveMeeting($dataarray);
    		
    		if($update===true)
    		{
    			$response = array('status' =>'success',
    				'message' =>'Meeting  added successfully.' );
    		}else
    		{
    			$response = array('status' =>'error',
    				'message' =>'Meeting not added.' );
    		}
		   
		  
		    
		    
		}
    	



	}
	echo json_encode($response);


   }
   public function deleteMeeting()
   {
	   $meeting_id = $this->input->post('id');
	   $delete = $this->gm_model->deleteMeeting($meeting_id);
	   if($delete)
	   {

		echo "success";
	   }
    }
    //Work Item
public function manage_working_item($group_id)
{
	$data['page']   =   "user/group-manager/manage-group-working-item";
	$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
	$data['group_data'] = $this->gm_model->getActGroup($group_id);
	$data['workitem_lits'] = $this->gm_model->getAllWorkikgItem($group_id,$this->session->userdata('user_id'));
	$this->load->view('user/template',$data);


}

public function add_workitem_modal()
{
	$workitem_id = $this->input->post('workitem_id');
	$data['group_id'] = $group_id = $this->input->post('group_id');
	$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
	$data['result'] = $this->gm_model->getOneWorkItem($workitem_id,$group_id);
	$this->load->view('user/group-manager/add-workitem-modal',$data);



}
public function save_workitem()
{
	extract($_POST);

	$workitem_id  = $this->input->post('workitem_id');
	$newmeetingdate = date('Y-m-d', strtotime($this->input->post('meeting_date')));
	if($workitem_id)
	{
		$dataarray = array('group_id' => $group_id,
			'work_item' =>   $work_item,
			'question_id' => $question_id,
			'user_id' => $this->session->userdata('user_id'),
			'work_item_status' => $status,
			'updated_at' => date('Y-m-d h:s:i a'));
           $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->updateWorkItem($dataarray,$workitem_id);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Work Item  updated successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Work Item not updated.' );
		}



	}else
	{
		$dataarray = array('group_id' =>$group_id,
			'work_item' =>$work_item,
			'question_id' => $question_id,
			'user_id' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d h:s:i a'));
           $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->saveWorkItem($dataarray);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Work Item  added successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Work Item not added.' );
		}




	}
	echo json_encode($response);


    }
   public function deleteWorkItem()
   {
	$workitem_id = $this->input->post('id');
	$delete = $this->gm_model->deleteWorkItem($workitem_id);
	if($delete)
	{

		echo "success";
	}



      }
     public function view_doc_file($sdo_id,$group_id,$contribution_id )
    {


	$data['page']   =   "user/group-manager/view-doc-file";
	$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
	$data['result'] = $this->gm_model->getOneMemberDoc($sdo_id, $group_id,$contribution_id);
	$this->load->view('user/template',$data);


    }
public function UpdateGroupManagerStatus()
{ 
	error_reporting(0);
	extract($_POST);
	$contribution_id = $this->input->post('contribution_id');
    $group_id = $this->group_id;
	$cont_d = $this->db->select('*')->where('contribution_id',$contribution_id)->get('group_contributions')->row();
	$unique_no = $cont_d->unique_no;
	$member_id = $cont_d->user_id;
	$profile = $this->db->select('*')->where('user_id',$member_id)->get('users')->row();
	$group = $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
	//$group_member = $this->db->select()->where()->
	    $sub_value = $this->db->select('*')->where('group_id',$group_id)->get('email_subscription')->result();	
				foreach($sub_value as $sub_user)
				{
					$subs_users[] = $sub_user->user_email;	
					$sub_id[] = $sub_user->emai_subscription_id;

				}

    if($group_manager_status=='accept')
	{
	// For Member
	// 	$this->load->library('phpmailer_lib');

        // PHPMailer object
         // $mail2 = $this->phpmailer_lib->load();
           require_once(APPPATH.'third_party/email/class.phpmailer.php');
           $mail2 = new PHPMailer();

        // SMTP configuration
         $mail2->isSMTP();
       $current_url = $_SERVER['SERVER_NAME'];
		if($current_url=='tec1.dssolution.in')
        {
        $mail2->Host     = 'dssolution.in';
        $mail2->SMTPAuth = true;
        $mail2->Username = 'info@dssolution.in';
        $mail2->Password = 'AdminNew@#$1234';
        $mail2->SMTPSecure = 'ssl';
        $mail2->Port     = 465;
        $mail2->setFrom('info@dssolution.in', 'Standards Coordination Portal');
        $mail2->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
        }else
        {
               // SMTP configuration For Tec.gov
        $mail2->Host     = 'relay.nic.in';
        $mail2->SMTPAuth = true;
        $mail2->Username = 'adic1.tec@gov.in';
        $mail2->Password = 'Stec#2020';
        $mail2->SMTPSecure = 'tls';
        $mail2->CharSet = 'UTF-8';
        $mail2->Port     = 25;
        $mail2->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail2->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }
         $mail2->isHTML(true);

       // Add a recipient
         $mail2->addAddress($profile->email);
         $mail2->Subject = '['.$group->shortform.'] Document Uploaded '.$unique_no.' '.$profile->name.' '.$profile->surname.' - Standards Coordination Portal';

        // Email body content
         $mailContent2 = '<p>Dear Sir/Madam,<br>
		 <p>Your contribution has been approved by your Group Admin. </p>
		 <p>If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback</p>
		 
		 <p> With best regards,<br>
		 <strong>TEC Standards Coordination Portal Management Service</strong>.<p/>';
         $mail2->Body = $mailContent2;
         $mail2->send();
	 //Group Admin Email
	//	 $this->load->library('phpmailer_lib');

        // PHPMailer object
         // $mail3 = $this->phpmailer_lib->load();
           require_once(APPPATH.'third_party/email/class.phpmailer.php');
           $mail3 = new PHPMailer();
          

        // SMTP configuration
         $mail3->isSMTP();
       $current_url = $_SERVER['SERVER_NAME'];
		if($current_url=='tec1.dssolution.in')
        {
        $mail3->Host     = 'dssolution.in';
        $mail3->SMTPAuth = true;
        $mail3->Username = 'info@dssolution.in';
        $mail3->Password = 'AdminNew@#$1234';
        $mail3->SMTPSecure = 'ssl';
        $mail3->Port     = 465;
        $mail3->setFrom('info@dssolution.in', 'Standards Coordination Portal');
        $mail3->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
        }else
        {
               // SMTP configuration For Tec.gov
        $mail3->Host     = 'relay.nic.in';
        $mail3->SMTPAuth = true;
        $mail3->Username = 'adic1.tec@gov.in';
        $mail3->Password = 'Stec#2020';
        $mail3->SMTPSecure = 'tls';
        $mail3->CharSet = 'UTF-8';
        $mail3->Port     = 25;
        $mail3->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail3->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }
         $mail3->isHTML(true);

       // Add a recipient
         $mail3->addAddress($subs_users);
         $mail3->Subject = '['.$group->shortform.'] Document Uploaded '.$unique_no.' '.$profile->name.' '.$profile->surname.' - Standards Coordination Portal';

        // Email body content
         $mailContent3 = '<p>Dear Sir/Madam,<br>
		  <p>A new contribution has been uploded.</p>
          <p>If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback.</p>

		 <p <a href="'.base_url().'/home/deletesubscibtion/'.$sub_id.'"> Click here to unsubscribe.<a></p>
		 
		 <p> With best regards,<br>
		 <strong>TEC Standards Coordination Portal Management Service</strong>.<p/>';
         $mail3->Body = $mailContent3;
         $mail3->send();
    //Email for group members
	$member_list = $this->db->select('*')->where('group_id',$group_id)->get('users')->result();	
	foreach($member_list as $member_user)
	{
		$emails[] = $member_user->email;	
		//$sub_id[] = $member_user->emai_subscription_id;

	}

	// $this->load->library('phpmailer_lib');

	// PHPMailer object
	 // $mail4 = $this->phpmailer_lib->load();
           require_once(APPPATH.'third_party/email/class.phpmailer.php');
           $mail4 = new PHPMailer();

	// SMTP configuration
	 $mail4->isSMTP();
   $current_url = $_SERVER['SERVER_NAME'];
	if($current_url=='tec1.dssolution.in')
	{
	$mail4->Host     = 'dssolution.in';
	$mail4->SMTPAuth = true;
	$mail4->Username = 'info@dssolution.in';
	$mail4->Password = 'AdminNew@#$1234';
	$mail4->SMTPSecure = 'ssl';
	$mail4->Port     = 465;
	$mail4->setFrom('info@dssolution.in', 'Standards Coordination Portal');
	$mail4->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
	}else
	{
		   // SMTP configuration For Tec.gov
	$mail4->Host     = 'relay.nic.in';
	$mail4->SMTPAuth = true;
	$mail4->Username = 'adic1.tec@gov.in';
	$mail4->Password = 'Stec#2020';
	$mail4->SMTPSecure = 'tls';
	$mail4->CharSet = 'UTF-8';
	$mail4->Port     = 25;
	$mail4->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
    $mail4->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
		
	}
	 $mail4->isHTML(true);

   // Add a recipient
	 $mail4->addAddress($emails);
	 $mail3->Subject = '['.$group->shortform.'] Document Uploaded '.$unique_no.' '.$profile->name.' '.$profile->surname.' - Standards Coordination Portal';

	// Email body content
	 $mailContent4 = '<p>Dear Sir/Madam,<br>
	 <p>A new contribution has been uploded. For further details please log in to the www.tec.gov.in/scp.</p>
	 <p>If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback.</p>
	 <p> With best regards,<br>
	 <strong>TEC Standards Coordination Portal Management Service</strong>.<p/>';
	 $mail4->Body = $mailContent4;
	 $mail4->send();

	}else if($group_manager_status=='reject')
	{
				// $this->load->library('phpmailer_lib');

			// PHPMailer object
			// $mail5 = $this->phpmailer_lib->load();
           require_once(APPPATH.'third_party/email/class.phpmailer.php');
           $mail5 = new PHPMailer();

			// SMTP configuration
			$mail5->isSMTP();
		    $current_url = $_SERVER['SERVER_NAME'];
			if($current_url=='tec1.dssolution.in')
			{
			$mail5->Host     = 'dssolution.in';
			$mail5->SMTPAuth = true;
			$mail5->Username = 'info@dssolution.in';
			$mail5->Password = 'AdminNew@#$1234';
			$mail5->SMTPSecure = 'ssl';
			$mail5->Port     = 465;
			$mail5->setFrom('info@dssolution.in', 'Standards Coordination Portal');
			$mail5->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
			}else
			{
				// SMTP configuration For Tec.gov
			$mail5->Host     = 'relay.nic.in';
			$mail5->SMTPAuth = true;
			$mail5->Username = 'adic1.tec@gov.in';
			$mail5->Password = 'Stec#2020';
			$mail5->SMTPSecure = 'tls';
			$mail5->CharSet = 'UTF-8';
			$mail5->Port     = 25;
		    $mail5->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
            $mail5->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
				
			}
			$mail5->isHTML(true);

		// Add a recipient
			$mail5->addAddress($profile->email);
			$mail5->Subject = '['.$group->shortform.'] Document Uploaded '.$unique_no.' '.$profile->name.' '.$profile->surname.' - Standards Coordination Portal';

			// Email body content
			$mailContent5 = '<p>Dear Sir/Madam,<br>
			<p>AYour contribution has been rejected by your Group Admin. Please review the documents and take appropriate action.<p>
			<p>If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback
			</p>
			<p> With best regards,<br>
			<strong>TEC Standards Coordination Portal Management Service</strong>.<p/>';
			$mail5->Body = $mailContent5;
			$mail5->send();

	}

	if($contribution_id)
	{
		$dataarray = array('group_manager_status' =>$group_manager_status,

			'updated_at' => date('Y-m-d h:s:i a'));

		$update =  $this->gm_model->UpdateGroupManagerStatus($dataarray,$contribution_id);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Status updated successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Status not updated.' );
		}


	}
	echo json_encode($response);


}
public function getAllWorkingGroups()
{
	$group_id = $this->input->post('category_id');

	$query = $this->gm_model->getAllWorkingGroups($group_id);
	echo '<option>---Select Meeting---</option>';
	foreach ($query as $result):
		echo '<option value='.$result->meeting_id.'>'.$result->meeting_title."-".$result->meeting_date.'</option>';
	endforeach;
}  

   public function manage_group_information($group_id)
   {
	   $data['page']   =   "user/group-manager/manage-group-information";
	   $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
	   $data['group_data'] = $this->gm_model->getActGroup($group_id);
	   $data['workitem_lits'] = $this->gm_model->getAllGroupInformation($group_id,$this->session->userdata('user_id'));
	   $this->load->view('user/template',$data);
    }

  public function add_groupinformation_modal()
   {
       

	$group_information_id = $this->input->post('group_information_id');
	$data['group_id'] = $group_id = $this->input->post('group_id');
	$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
	$data['result'] = $this->gm_model->getOneGroupInformation($group_information_id,$group_id);
	$this->load->view('user/group-manager/add-groupinformation-modal',$data);

}
public function save_groupinformation()
{
    error_reporting(0);
	extract($_POST);

	$group_information_id  = $this->input->post('group_information_id');
        //$newmeetingdate = date('Y-m-d', strtotime($this->input->post('meeting_date')));
	if($group_information_id)
	{

		if(!empty($_FILES['docfile1']['name']))
		{
			$new_name  = time().url_title($_FILES["docfile1"]['name']).'.'.pathinfo($_FILES["docfile1"]["name"], PATHINFO_EXTENSION);;
			$config['upload_path'] = 'uploads/information/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $new_name;
			$config['fileExt']  = pathinfo($_FILES["docfile1"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('docfile1'))
			{
				$uploadData = $this->upload->data();
				$docfile1 = $new_name;

				$query = $this->db->where('group_id',$group_id)->where('group_information_id',$group_information_id)->set('file',$docfile1)->update('group_information');

			}else
			{
				$docfile1 = '';

			}
		} 
		$dataarray = array('group_id' => $group_id,
			'title' =>   $title,
			'url' =>   $inf_url,
			'user_id' => $this->session->userdata('user_id'),
			'group_information_status' => $status,
			'updated_at' => date('Y-m-d h:s:i a'));
             $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->updateGroupinformation($dataarray,$group_information_id);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Group Information  updated successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Group Information not updated.' );
		}



	}else
	{
		if(!empty($_FILES['docfile1']['name']))
		{
			$new_name  = time().url_title($_FILES["docfile1"]['name']).'.'.pathinfo($_FILES["docfile1"]["name"], PATHINFO_EXTENSION);;
			$config['upload_path'] = 'uploads/information/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $new_name;
			$config['fileExt']  = pathinfo($_FILES["docfile1"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('docfile1'))
			{
				$uploadData = $this->upload->data();
				$docfile1 = $new_name;

			}else
			{
				$docfile1 = '';

			}
		} 

		$dataarray = array('group_id' => $group_id,
			'title' =>   $title,
			'file' => $docfile1,
			'url' =>   $inf_url,
			'user_id' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d h:s:i a'));
             $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->saveGroupinformation($dataarray);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Group Information added successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Group Information not added.' );
		}




	    }
	     echo json_encode($response);


    }
    public function deleteGroupInformation()
    {
	$workitem_id = $this->input->post('id');
	$delete = $this->gm_model->deleteGroupinformation($workitem_id);
	if($delete)
	{

		echo "success";
	}



    }
    //Outcome Documents
    public function outcome_document()
    {
	   $data['page']   =   "user/group-manager/outcome-documents";
	   $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
         //$data['group_data'] = $this->gm_model->getActGroup($group_id);
	   $data['outcome_list'] = $this->gm_model->getAllOutcomeDocument($this->group_id);
	   $this->load->view('user/template',$data);

    }
    public function add_outcome_documents($outcome_document_id)
   {

	   $data['page']   =   "user/group-manager/add-outcome-documents";
	   $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
           //$data['group_data'] = $this->gm_model->getActGroup($group_id);
	   $data['group_list'] = $this->gm_model->getAllMyGroups($this->session->userdata('user_id'));
	   $data['result'] = $this->gm_model->getOneOutcomeDocument($outcome_document_id);
	   $this->load->view('user/template',$data);

   }
   public function save_outcomedocument()
    {
	   extract($_POST);

	   $outcome_document_id   = $this->input->post('outcome_document_id');
        //$newmeetingdate = date('Y-m-d', strtotime($this->input->post('meeting_date')));
	   if($outcome_document_id)
	   {

		if(!empty($_FILES['outcome_file']['name']))
		{
			$new_name  = time().url_title($_FILES["outcome_file"]['name']).'.'.pathinfo($_FILES["outcome_file"]["name"], PATHINFO_EXTENSION);;
			$config['upload_path'] = 'uploads/outcome-documents/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $new_name;
			$config['fileExt']  = pathinfo($_FILES["outcome_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('outcome_file'))
			{
				$uploadData = $this->upload->data();
				$outcome_file = $new_name;

				$query = $this->db->where('group_id',$group_id)->where('outcome_document_id',$outcome_document_id)->set('outcome_file',$outcome_file)->update('outcome_documents');

			}else
			{
				$outcome_file = '';

			}
		} 
		$dataarray = array('group_id' => $group_id,
			'meeting_id' =>   $meeting_id,
			'outcome_document_title' => $outcome_document_title,
			'user_id' => $this->session->userdata('user_id'),
			'outcomedocument_staus' => $status,
			'updated_at' => date('Y-m-d h:s:i a'));
           $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->updateOutcomeDocument($dataarray,$outcome_document_id );
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Outcome Document  updated successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Outcome Document not updated.' );
		}



	}else
	{
		if(!empty($_FILES['outcome_file']['name']))
		{
			$new_name  = time().url_title($_FILES["outcome_file"]['name']).'.'.pathinfo($_FILES["outcome_file"]["name"], PATHINFO_EXTENSION);;
			$config['upload_path'] = 'uploads/outcome-documents/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $new_name;
			$config['fileExt']  = pathinfo($_FILES["outcome_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('outcome_file'))
			{
				$uploadData = $this->upload->data();
				$outcome_files = $new_name;

			}else
			{
				$outcome_files = '';

			}
		}else
		{
		    $outcome_files='';
		}

		$dataarray = array('group_id' => $group_id,
			'meeting_id' =>   $meeting_id,
			'outcome_file' => $outcome_files,
			'outcome_document_title' => $outcome_document_title,
			'user_id' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d h:s:i a'));
            $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->saveOutcomeDocument($dataarray);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Outcome Document added successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Outcome Document not added.' );
		}




	     }
	    echo json_encode($response);

    }
    public function deleteOutcomeDocument()
    {

	    $outcome_document_id = $this->input->post('id');
	    $delete = $this->gm_model->deleteOutcomeDocument($outcome_document_id);
	    if($delete)
	    {
		  echo "success";
	    }
    }
    public function document_from_itu()
    {
    	  $data['page']   =   "user/group-manager/document-from-itu";
	      $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
          //$data['group_data'] = $this->gm_model->getActGroup($group_id);
	      $data['outcome_list'] = $this->gm_model->getAllDocumentfromITU($this->group_id);
	      $this->load->view('user/template',$data);
    }
    public function add_document_from_itu($doc_form_itu_id='')
    {
    	  $data['page']   =   "user/group-manager/add-document-from-itu";
	      $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
           //$data['group_data'] = $this->gm_model->getActGroup($group_id);
	      $data['group_list'] = $this->gm_model->getAllMyGroups($this->session->userdata('user_id'));
	      $data['result'] = $this->gm_model->getOneDocumentfromITU($doc_form_itu_id);
	      $this->load->view('user/template',$data);


    }

    public function save_docfromitusite()
    {
    	extract($_POST);

	   $document_from_itu_id    = $this->input->post('document_from_itu_id');
        //$newmeetingdate = date('Y-m-d', strtotime($this->input->post('meeting_date')));
	   if($document_from_itu_id)
	   {

		if(!empty($_FILES['document_file']['name']))
		{
			$new_name  = time().url_title($_FILES["document_file"]['name']).'.'.pathinfo($_FILES["document_file"]["name"], PATHINFO_EXTENSION);;
			$config['upload_path'] = 'uploads/document-from-itu-site/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $new_name;
			$config['fileExt']  = pathinfo($_FILES["document_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('document_file'))
			{
				$uploadData = $this->upload->data();
				$document_file = $new_name;

				$query = $this->db->where('group_id',$group_id)->where('document_from_itu_id',$document_from_itu_id )->set('document_file',$document_file)->update('document_from_iut_site');

			}else
			{
				$document_file = '';

			}
		} 
		$dataarray = array('group_id' => $group_id,
			'document_title' => $document_title,
			'user_id' => $this->session->userdata('user_id'),
			'document_status' => $status,
			'updated_at' => date('Y-m-d h:s:i a'));
            $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->updateDocumentfromITU($dataarray,$document_from_itu_id);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Document  updated successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Document not updated.' );
		}



	}else
	{
		if(!empty($_FILES['document_file']['name']))
		{
			$new_name  = time().url_title($_FILES["document_file"]['name']).'.'.pathinfo($_FILES["document_file"]["name"], PATHINFO_EXTENSION);
			$config['upload_path'] = 'uploads/document-from-itu-site/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $new_name;
			$config['fileExt']  = pathinfo($_FILES["document_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('document_file'))
			{
				$uploadData = $this->upload->data();
				$document_file = $new_name;

			}else
			{
				$document_file = '';

			}
		} 

		$dataarray = array('group_id' => $group_id,
			'meeting_id' =>   $meeting_id,
			'document_title' =>$document_title,
			'document_file' => $document_file,
			'user_id' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d h:s:i a'));
             $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->saveDocumentfromITU($dataarray);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Document added successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Document not added.' );
		}




	     }
	    echo json_encode($response);


    }
    public function deleteDocumentfromITU()
    {

    	$document_from_itu_id = $this->input->post('id');
    	  $delete = $this->gm_model->deleteDocumentfromITU($document_from_itu_id);
	       if($delete)
	       {
		     echo "success";
	        }
    }
    public function minutes_of_meeting()
    {
        	$data['page']   =   "user/group-manager/minutes-of-meeting";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        //$data['group_data'] = $this->gm_model->getActGroup($group_id);
		$data['meeting_list'] = $this->gm_model->getAllMeeting($this->group_id);
		$data['mintuse_of_meeting_list'] = $this->gm_model->getAllMintuesofMeeting($this->group_id);
		$this->load->view('user/template',$data);
        
        
    }
    public function add_mintues_of_meeting($minutesofmeeting_id)
    {
           	$data['page']   =   "user/group-manager/add-minutes-of-meeting";
	   	    $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
            $data['result'] = $this->gm_model->oneMinuteofmeeting($minutesofmeeting_id);
		    //$data['meeting_list'] = $this->gm_model->getAllNWGMeeting($this->session->userdata('user_id'));
	   	    $data['group_list'] = $this->gm_model->getAllMyGroups($this->session->userdata('user_id'));
	        $this->load->view('user/template',$data);
        
        
    }
    public function save_meeting_of_minutes()
 	{
		extract($_POST);
		error_reporting(0);

		$minutesofmeeting_id  = $this->input->post('minutesofmeeting_id');

		if($minutesofmeeting_id)
			{ 
			    if(!empty($_FILES['meeting_file']['name']))
		    {
		   	    $new_name  = time().url_title($_FILES["meeting_file"]['name']).'.'.pathinfo($_FILES["meeting_file"]["name"], PATHINFO_EXTENSION);;
			   $config['upload_path'] = 'uploads/meeting-file/';
			    $config['allowed_types'] = 'pdf|doc|docx';
			    $config['file_name'] = $new_name;
		   	$config['fileExt']  = pathinfo($_FILES["meeting_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('meeting_file'))
			{
				$uploadData = $this->upload->data();
				$meeting_file = $new_name;

				$query = $this->db->where('minutesofmeeting_id',$minutesofmeeting_id)->set('minutes_of_meeting_file',$meeting_file)->update('minutes_of_meeting');

			}else
			{
				$meeting_file = '';

			}
		} 
		$dataarray = array(
			'meeting_id' =>$meeting_id,
			'user_id'      => $this->session->userdata('user_id'), 
			'group_id' => $this->input->post('group_id'),
			'minutes_of_meeting_status'  => $status,
			'updated_at' => date('Y-m-d h:s:i a'));
           $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->updateminutesofMeeting($dataarray,$minutesofmeeting_id);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Minutes of Meeting  updated successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Minutes of Meeting not updated.' );
		}



	   }else
	   {
		    if(!empty($_FILES['meeting_file']['name']))
		    {
			   $new_name  = time().url_title($_FILES["meeting_file"]['name']).'.'.pathinfo($_FILES["meeting_file"]["name"], PATHINFO_EXTENSION);;
			   $config['upload_path'] = 'uploads/meeting-file/';
			   $config['allowed_types'] = 'pdf|doc|docx';
			   $config['file_name'] = $new_name;
			   $config['fileExt']  = pathinfo($_FILES["meeting_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			   $this->load->library('upload',$config);
			  $this->upload->initialize($config);

			   if($this->upload->do_upload('meeting_file'))
			   {
				$uploadData = $this->upload->data();
				$meeting_file = $new_name;


			    }else
			   {
				$meeting_file = '';

			    }
		} 
		$dataarray = array(
			'meeting_id' =>$meeting_id,

		     'user_id'      => $this->session->userdata('user_id'), 
		     'group_id' => $this->input->post('group_id'),
			'minutes_of_meeting_file' => $meeting_file,
			'created_at' => date('Y-m-d h:s:i a'));
             $dataarray = $this->security->xss_clean($dataarray);
		$update =  $this->gm_model->saveMinutesofMeeting($dataarray);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Minutes of Meeting  added successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Minutes of Meeting not added.' );
		}




	}
	echo json_encode($response);


   }
   public function deleteMinuteofMeeting()
   {
       $id = $this->input->post('id');
       $delete = $this->db->where('minutesofmeeting_id',$id)->delete('minutes_of_meeting');
       if($delete)
       {
           echo "success";
       }
   }
   public function getAllNWGWorkingGroups()
   {
       	$group_id = $this->input->post('category_id');

	$query = $this->gm_model->getAllNWGWorkingGroups($group_id);
	echo '<option>---Select Meeting---</option>';
	foreach ($query as $result):
	    $start_date = date('d-m-Y', strtotime($result->meeting_date));
	    $end_date = date('d-m-Y', strtotime($result->meeting_end_date));
		echo '<option value='.$result->meeting_id.'>'.$result->meeting_title."-".$start_date. "&nbsp;to&nbsp;" .$end_date.'</option>';
	endforeach;
       
   }
   public function deleteMemberUploadDoc()
   {
       
       $cid = $this->input->post('id');
       $delete = $this->db->set('delete','N')->where('contribution_id',$cid)->update('group_contributions');
        //$delete1 = $this->db->where('contribution_id',$cid)->update('group_contributors');
         if($delete)
         {
             echo "success";
             
         }
             
         
   }
   public function circulars()
   {
          $data['page']   =   "user/group-manager/circulars";
	      $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
          //$data['group_data'] = $this->gm_model->getActGroup($group_id);
	      $data['circulars_list'] = $this->gm_model->getAllCirculars($this->group_id);
	      $this->load->view('user/template',$data);
       
       
   }
   public function add_circulars($circulars_id)
   {
         $data['page']   =   "user/group-manager/add-circulars";
	      $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
           //$data['group_data'] = $this->gm_model->getActGroup($group_id);
	      $data['group_list'] = $this->gm_model->getAllMyGroups($this->session->userdata('user_id'));
	      $data['result'] = $this->gm_model->getOneCirculars($circulars_id);
	      $this->load->view('user/template',$data);
       
   }
   public function save_circular()
{
       error_reporting(0);
    	extract($_POST);

	   $circulars_id    = $this->input->post('circulars_id');
        //$newmeetingdate = date('Y-m-d', strtotime($this->input->post('meeting_date')));
        	$group = $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
		$group_member = $this->db->select('*')->where('group_id',$group_id)->get('users')->result();
		foreach($group_member as $member_value)
		{
		    $memeber_list[] = trim($member_value->email);
		}
		$sub_member = $this->db->select('*')->where('group_id',$group_id)->get('email_subscription')->result();
		foreach($sub_member as $sub_value)
		{
		    $sub_list[] = trim($sub_value->user_email);
		    $subs_id[] = $sub_value->	emai_subscription_id;
		}
		//  $this->load->library('phpmailer_lib');
        
        // PHPMailer object
       
        // $mail2 = $this->phpmailer_lib->load();
           require_once(APPPATH.'third_party/email/class.phpmailer.php');
           $mail2 = new PHPMailer();
       // SMTP configuration
        $mail2->isSMTP();
        $current_url = $_SERVER['SERVER_NAME'];
		if($current_url=='tec1.dssolution.in')
        {
        $mail2->Host     = 'dssolution.in';
        $mail2->SMTPAuth = true;
        $mail2->Username = 'info@dssolution.in';
        $mail2->Password = 'AdminNew@#$1234';
        $mail2->SMTPSecure = 'ssl';
        $mail2->Port     = 465;
        $mail2->setFrom('info@dssolution.in', 'Standards Coordination Portal');
        $mail2->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
        }else
        {
               // SMTP configuration For Tec.gov
        $mail2->Host     = 'relay.nic.in';
        $mail2->SMTPAuth = true;
        $mail2->Username = 'adic1.tec@gov.in';
        $mail2->Password = 'Stec#2020';
        $mail2->SMTPSecure = 'tls';
        $mail2->CharSet = 'UTF-8';
        $mail2->Port     = 25;
        $mail2->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail2->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }
         $mail2->isHTML(true);

       // Add a recipient
         $mail2->addAddress($memeber_list,$sub_list);
         $mail2->Subject = '['.$group->shortform.'] Circular- Standards Coordination Portal';

        // Email body content
         $mailContent2 = '<p>Dear Sir/Madam,<br>
		 <p>A circular has been uploaded on Portal by Admin.  For further details, please logon to www.tec.gov.in/scp </p>
         <p>If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback.<p>
         <p>Click here to <a href="'.base_url().'/home/deletesubscibtion/'.$subs_id.'">unsubscribe</a>.</p>
         <p> With best regards,<br>
		 <strong>TEC Standards Coordination Portal Management Service</strong>.<p/>';
         $mail2->Body = $mailContent2;
         $mail2->send();
	   if($circulars_id)
	   {

		if(!empty($_FILES['circulars_file']['name']))
		{
			$new_name  = time().url_title($_FILES["circulars_file"]['name']).'.'.pathinfo($_FILES["circulars_file"]["name"], PATHINFO_EXTENSION);;
			$config['upload_path'] = 'uploads/circulars/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $new_name;
			$config['fileExt']  = pathinfo($_FILES["circulars_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('circulars_file'))
			{
				$uploadData = $this->upload->data();
				$circulars_file = $new_name;

				$query = $this->db->where('group_id',$group_id)->where('circulars_id',$circulars_id )->set('circulars_file',$circulars_file)->update('circulars');

			}else
			{
				$circulars_file = '';

			}
		} 
		$dataarray = array('group_id' => $group_id,
			'circulars_title' => $circulars_title,
			'user_id' => $this->session->userdata('user_id'),
			'circulars_status' => $status,
			'updated_at' => date('Y-m-d h:s:i a'));

		$update =  $this->gm_model->updateCircular($dataarray,$circulars_id);
	
		
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Circular  updated successfully.'
				  //'message'=>$memeber_list
				  );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Circular not updated.' );
		}



	}else
	{
		if(!empty($_FILES['circulars_file']['name']))
		{
			$new_name  = time().url_title($_FILES["circulars_file"]['name']).'.'.pathinfo($_FILES["circulars_file"]["name"], PATHINFO_EXTENSION);
			$config['upload_path'] = 'uploads/circulars/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $new_name;
			$config['fileExt']  = pathinfo($_FILES["circulars_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('circulars_file'))
			{
				$uploadData = $this->upload->data();
				$circulars_file = $new_name;

			}else
			{
				$circulars_file = '';

			}
		}else
		{
		   	$circulars_file = ''; 
		}

	$dataarray = array('group_id' => $group_id,
			'circulars_title' => $circulars_title,
			'circulars_file' => $circulars_file,
			'user_id' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d h:s:i a'));

		$update =  $this->gm_model->saveCircular($dataarray);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Circular added successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Circular not added.' );
		}




	     }
	    echo json_encode($response);


    }
    public function deleteCirculars()
    {
        $circulars_id = $this->input->post('id');
        $delete = $this->db->where('circulars_id',$circulars_id)->delete('circulars');
        if($delete){
            echo "success";
        }
    }






}


?>
