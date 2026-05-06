<?php
class Group extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session','database');
		$this->load->model('Login_model','auth');
		$this->load->model('Dashboard_model','dash_model');
		$this->load->model('Group_model','group_model');
		$this->load->model('Home_model','Home_model');
		$this->auth->isLoggedIn();
	}
    public function generate_numbers($start, $count, $digits) {
       $result = '';
       for ($n = $start; $n < $start + $count; $n++) {
 
        $result = str_pad($n, $digits, "0", STR_PAD_LEFT);
 
       }
       return $result;
    }
	public function documents($sdo_id, $group_id)
	{
		$data['page']   =   "user/group/document";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['group_data']= $this->group_model->getOneGroup($group_id);
        $data['doc_reg_list'] = $this->group_model->getAllmemberDocfile($group_id);
        $data['sdo_list'] = $this->group_model->getAllActSDOBulletin($group_id);
        $data['outcome_list'] = $this->group_model->getAllOutcomeDocumnts($group_id);
        $data['meeting_list'] = $this->group_model->getAllminuteofmeeting($group_id);
        $data['documentfromitu_list'] = $this->group_model->getAllDocumentfromITUsite($group_id);
        $data['circulars_list'] = $this->group_model->getALlCirculars($group_id);
		$this->load->view('user/template',$data);
		
		
	}
    public function upload_new_contributions($sdo_id, $group_id)
    {
        $data['page']   =   "user/group/upload-new-contributions";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_data']= $this->group_model->getOneGroup($group_id);
        $data['get_que_list'] = $this->group_model->getAllQuestion($group_id);
        $data['get_meeting_list'] = $this->group_model->getAllMeeting($group_id);
        $data['workitem_list'] = $this->group_model->getAllWorkItem($group_id);
        $data['sdo_list'] = $this->Home_model->getAllSDO();
        $data['workingparty_list'] = $this->group_model->getAllWorkingParty($sdo_id,$group_id); 
        $data['document_expiry_date'] = $this->dash_model->getDocumentExpiryDate($group_id);
        $data['doc_reg_list'] = $this->group_model->getAllDocRegistion($group_id);
        $this->load->view('user/template',$data);
        
        
    }
    public function upload_doc_file($sdo_id, $group_id)
    {
        $data['page']   =   "user/group/doc-file-upload";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_data']= $this->group_model->getOneGroup($group_id);
        $data['document_expiry_date'] = $this->dash_model->getDocumentExpiryDate($group_id);
        $data['doc_reg_list'] = $this->group_model->getAllDocRegistion($group_id);
        //$data['last_reg_no'] = $this->group_model->LastRegNo($sdo_id, $group_id, $contribution_id);  
        $this->load->view('user/template',$data);
        
        
    }
    public function add_upload_doc_file($sdo_id, $group_id,$contribution_id)
    {
        $data['page']   =   "user/group/add-doc-file-upload";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_data']= $this->group_model->getOneGroup($group_id);
        $data['get_que_list'] = $this->group_model->getAllQuestion($group_id);
        $data['get_meeting_list'] = $this->group_model->getAllMeeting($group_id);
        $data['workitem_list'] = $this->group_model->getAllWorkItem($group_id);
        $data['sdo_list'] = $this->Home_model->getAllSDO();
        $data['workingparty_list'] = $this->group_model->getAllWorkingParty($sdo_id,$group_id); 
        $data['document_expiry_date'] = $this->dash_model->getDocumentExpiryDate($group_id);
        $data['doc_reg_list'] = $this->group_model->getAllDocRegistion($group_id);
        $data['last_reg_no'] = $this->group_model->LastRegNo($sdo_id, $group_id, $contribution_id); 
        $data['reupload_file'] = $this->group_model->getAllgroupFileList($sdo_id, $group_id,$contribution_id);
        $this->load->view('user/template',$data);
        
        
    }
    public function re_upload_doc_file($sdo_id, $group_id,$contribution_id)
    {
        $data['page']   =   "user/group/re-doc-file-upload";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_data']= $this->group_model->getOneGroup($group_id);
        $data['get_que_list'] = $this->group_model->getAllQuestion($group_id);
        $data['get_meeting_list'] = $this->group_model->getAllMeeting($group_id);
        $data['workitem_list'] = $this->group_model->getAllWorkItem($group_id);
        $data['sdo_list'] = $this->Home_model->getAllSDO();
        $data['workingparty_list'] = $this->group_model->getAllWorkingParty($sdo_id,$group_id); 
        $data['document_expiry_date'] = $this->dash_model->getDocumentExpiryDate($group_id);
        $data['doc_reg_list'] = $this->group_model->getAllDocRegistion($group_id);
        $data['last_reg_no'] = $this->group_model->LastRegNo($sdo_id, $group_id, $contribution_id); 
        $data['reupload_file'] = $this->group_model->getAllgroupFileList($sdo_id, $group_id,$contribution_id);
        $this->load->view('user/template',$data);
        
        
    }
    public function revision_of_existing_contribution($group_id)
    {
        $data['page']   =   "user/group/revision-of-existing-contribution";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_data']= $this->group_model->getOneGroup($group_id);
        $this->load->view('user/template',$data);
        
        
    }
    public function add_upload_new_contributions($sdo_id, $group_id)
    {
        $data['page']   =   "user/group/add-upload-new-contributions";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_data']= $this->group_model->getOneGroup($group_id);
        $data['get_que_list'] = $this->group_model->getAllQuestion($group_id);
        $data['get_meeting_list'] = $this->group_model->getAllMeeting($group_id);
        $data['workitem_list'] = $this->group_model->getAllWorkItem($group_id);
        $data['sdo_list'] = $this->Home_model->getAllSDO();
        $data['workingparty_list'] = $this->group_model->getAllWorkingParty($sdo_id,$group_id); 
        $data['document_expiry_date'] = $this->dash_model->getDocumentExpiryDate($group_id);
        $this->load->view('user/template',$data);
        
        
    }
    public function doc_registration()
    {
    	extract($_POST);
        $current_y = date('Y');
    	 $query = $this->db->select('*')->where('group_id',$group_id)->where('sdo_id',$sdo_id)->where('year(created_at)',$current_y)->get('group_contributions');
        $count = $query->num_rows();
        $rows = $query->row();
        $group = $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
         $meeting = $this->db->select('*')->where('meeting_id',$meeting_id)->get('group_meeting')->row();
         $start_date = $meeting->meeting_date;
         $end_date = $meeting->meeting_end_date;
        //$idscount = $rows->c_id;
          $count;
    	/*if($count ==0)
    	{
    		$count = 1;
    	}else
    	{
    		$count= $count+1;
    	}
    	 $count ++;*/
    	 $counts = $this->generate_numbers('1',$count,'4');
         $unique_no = url_title($shortform).'-'.date('Y').'-'.$counts;
         $contribution_id = $this->input->post('contribution_id');
         $password =base64_encode(random_bytes(12));
         $user_id = $this->session->userdata('user_id');
         $profile = $this->db->select('*')->where('user_id',$user_id)->get('users')->row();
         $question = $this->db->select('*')->where('question_id',$question_id)->get('questions')->row();

          if($this->input->post('contribution_id'))
		    {



			    $dataarray = array('group_id' =>$group_id,
	                             'sdo_id' =>$sdo_id,
                                 'user_id' => $this->session->userdata('user_id'),
	                             'question_id' => $question_id,
	                             'workitem_id' => $workitem_id,
                                 'meeting_id' => $meeting_id,
                                 'title' => $title,
                                 'workingparty_id' => $workingparty_id,
                                 'unique_no' => $unique_no,
	                             'created_at' => date('Y-m-d h:s:i a'));


			       $update =  $this->group_model->updatefileReg($dataarray,$contribution_id);

                       $all_contributor_name = $this->input->post('all_contributor_name'); 
                       if($all_contributor_name)
                       {


                           for ($i=0; $i < count($all_contributor_name); $i++)
                           {

                                $dataarray2 = array('contributor_name' => $all_contributor_name[$i],
                                                'organization' => $all_organization[$i],
                                                'contribution_id' =>$contribution_id, 
                                                'group_id' =>$group_id,
                                                'created_at' => date('Y-m-d h:s:i a'));

                                 $insert_2 = $this->db->insert('group_contributors', $dataarray2);

                            }
                        }
                        //Update
                         $all_contributor_name1 = $this->input->post('all_contributor_name1'); 
                         $contributor_id = $this->input->post('contributor_id');
                        if($all_contributor_name1)
                        { 
                           for ($i=0; $i < count($all_contributor_name1); $i++)
                           {

                            $dataarray3 = array('contributor_name' => $all_contributor_name1[$i],
                                                'organization' => $all_organization1[$i],
                                                'contribution_id' =>$contribution_id, 
                                                'group_id' =>$group_id,
                                                'updated_at' => date('Y-m-d h:s:i a'));

                            $update_2 = $this->db->where('contributor_id',$contributor_id[$i])->update('group_contributors', $dataarray3);

                            }  
                        }
                        $group_manager = $this->db->select('users.email,group_managers.member_id')->join('users','users.user_id=group_managers.member_id','left')->where('group_managers.group_id',$group_id)->get('group_managers')->result();	
				foreach($group_manager as $gm_value)
				{
					$gm_email[] = $gm_value->email;	

				}
       //Email for group member
        $this->load->library('phpmailer_lib');
      // PHPMailer object
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
         $mail->addAddress($profile->email,$gm_email);

         $mail->Subject = '['.$group->shortform.'] Document Registered ["Edited"] '.$profile->name.'&nbsp;'.$profile->surname.' - Standards Coordination Portal';

        // Email body content
         $mailContent = '<style>
    a:hover {text-decoration: underline !important;}
</style>
<body>
    <table  border="1"  width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family:"Open Sans", sans-serif; width:100%;">
        <tr>
            <td>
            <img src="https://tec1.dssolution.in/assets/images/icon.png"  >
            </td>
            <td colspan="1" ><h2>TEC ['.$unique_no.']: Document Registered</h2></td>
                
         
        </tr>
        <tr>
        <td colspan="2" align="center"><p>Document envelope information</p></td>
        </tr>
    </table>
       <table  border="2"  width="100%" bgcolor="#fff"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif; width:100%; color:#000000; font-size:12px;">
        <tr>
        <td style="width:20%;">
        <span>Document Number :</span>
        </td>
        <td style="width:80%;">
       <strong style="color:red">'.$unique_no.'</strong>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Posting Password :</span>
        </td>
        <td style="width:80%;">
        <a  href="#"><strong style="color:red">'.$password.'</strong></a>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Study Group :</span>
        </td>
        <td style="width:80%;">
        '.$group->study_periord.'
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Date of Meeting :</span>
        </td>
        <td style="width:80%;">
        <span> '.$start_date.' to '.$end_date.'</span>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Document Title :</span>
        </td>
        <td style="width:80%;">
        <p>'.$title.'</p>
        </td>
        </tr>
          <tr>
        <td style="width:20%;">
        <span>Document Sources :</span>
        </td>
        <td style="width:80%;">
        <p>'.$profile->organization.'</p>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Address to Question :</span>
        </td>
        <td style="width:80%;">
        <p>'.$question->question_no.'</p>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Uploaded by:</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->name.'&nbsp;'.$profile->surname.'</span>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Uploader organization name :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->organization.'</span>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Country :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>E-mail :</span>
        </td>
        <td style="width:80%;">
        <span><a href="mailto:'.$profile->email.'">'.$profile->email.'</a></span>
        </td>
        </tr>
		<tr>
        <td style="width:20%;">
        <span>Mobile No. :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->email.'</span>
        </td>
        </tr>
        <tr>
          <tr>
        <td style="width:20%;">
        <span>Mobile No. :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->contact_no.'</span>
        </td>
        </tr>
       
         <tr>
                <td style="width:20%;">
        <span>Fax :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
         
      
         <tr>
                <td style="width:20%;">
        <span>Remark :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
           
        <tr>
                <td style="width:20%;">
        <span>Registration Timetap :</span>
        </td>
        <td style="width:80%;">
        <span>'.date('Y-m-d h:s:i a').'</span>
        </td>
        </tr>
</table>
<br>
<p>Please use the posting password above at the time of uploading contribution.</p>

With best regards,
<strong>TEC Standards Coordination Portal Management Service.</strong>
</p>

</body>
</html>';
         $mail->Body = $mailContent;
         $mail->send();



                    if($update===true OR $update_2===true OR $insert_2===true)
                    {    
              	     $response = array('status' =>'success',
              	                    'message' =>'Data  updated successfully.' );
                    }else
                    {
              	    $response = array('status' =>'success',
              	                    'message' =>'Data not updated.' );
                   }
                   
                   

            }else
            {
                $dataarray = array('group_id' =>$group_id,
                                 'sdo_id' =>$sdo_id,
                                 'question_id' => $question_id,
                                 'workitem_id' => $workitem_id,
                                 'meeting_id' => $meeting_id,
                                 'password' =>$password,
                                 'user_id' => $this->session->userdata('user_id'),
                                 'title' => $title,
                                 'workingparty_id' => $workingparty_id,
                                 'unique_no' => $unique_no,
                                 'created_at' => date('Y-m-d h:s:i a'));


                   $insert =  $this->group_model->savefileReg($dataarray);

                       $all_contributor_name = $this->input->post('all_contributor_name'); 
                      for ($i=0; $i < count($all_contributor_name); $i++)
                        {

                            $dataarray2 = array('contributor_name' => $all_contributor_name[$i],
                                                'organization' => $all_organization[$i],
                                                'contribution_id' =>$insert, 
                                                'group_id' =>$group_id,
                                                'created_at' => date('Y-m-d h:s:i a'));

                            $insert_2 = $this->db->insert('group_contributors', $dataarray2);

                        }
				
				$group_manager = $this->db->select('users.email,group_managers.member_id')->join('users','users.user_id=group_managers.member_id','left')->where('group_managers.group_id',$group_id)->get('group_managers')->result();	
				foreach($group_manager as $gm_value)
				{
					$gm_email[] = $gm_value->email;	

				}
				
                        
          //Email
        $this->load->library('phpmailer_lib');

        // PHPMailer object
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
         $mail->addAddress($profile->email,$gm_email);

         $mail->Subject = '['.$group->shortform.']Document Registered '.$profile->name.'&nbsp;'.$profile->surname.' - Standards Coordination Portal';

        // Email body content
         $mailContent = '<style>a:hover {text-decoration: underline !important;}</style>
		 <body>
        <table  border="1"  width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family:"Open Sans", sans-serif; width:100%;">
        <tr>
            <td>
            <img src="https://tec1.dssolution.in/assets/images/icon.png"  >
            </td>
            <td colspan="1" ><h2>TEC ['.$unique_no.']: Document Registered</h2></td>
                
         
        </tr>
        <tr>
        <td colspan="2" align="center"><p>Document envelope information</p></td>
        </tr>
    </table>
       <table  border="2"  width="100%" bgcolor="#fff"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif; width:100%; color:#000000; font-size:12px;">
        <tr>
        <td style="width:20%;">
        <span>Document Number :</span>
        </td>
        <td style="width:80%;">
       <strong style="color:red">'.$unique_no.'</strong>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Posting Password :</span>
        </td>
        <td style="width:80%;">
        <a  href="#"><strong style="color:red">'.$password.'</strong></a>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Study Group :</span>
        </td>
        <td style="width:80%;">
        '.$group->study_periord.'
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Date of Meeting :</span>
        </td>
        <td style="width:80%;">
        <span> '.$start_date.' to '.$end_date.'</span>
        </td>
        </tr>
      
         <tr>
        <td style="width:20%;">
        <span>Document Type :</span>
        </td>
        <td style="width:80%;">
        <span>Contribution </span>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Document Title :</span>
        </td>
        <td style="width:80%;">
        <p>'.$title.'</p>
        </td>
        </tr>
          <tr>
        <td style="width:20%;">
        <span>Document Sources :</span>
        </td>
        <td style="width:80%;">
        <p>'.$profile->organization.'</p>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Address to Question :</span>
        </td>
        <td style="width:80%;">
        <p>'.$question->question_no.'</p>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Uploaded by :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->name.'&nbsp;'.$profile->surname.'</span>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Uploader organization name :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->organization.'</span>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Country :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>E-mail :</span>
        </td>
        <td style="width:80%;">
        <span><a href="mailto:'.$profile->email.'">'.$profile->email.'</a></span>
        </td>
        </tr>
          <tr>
        <td style="width:20%;">
        <span>Mobile No. :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->contact_no.'</span>
        </td>
        </tr>
        <tr>
       <td style="width:20%;">
        <span>Telephone. :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->email.'</span>
        </td>
        </tr>
       
     
         <tr>
        <td style="width:20%;">
        <span>Remark :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
          
        <tr>
                <td style="width:20%;">
        <span>Registration Timetap :</span>
        </td>
        <td style="width:80%;">
        <span>'.date('Y-m-d h:i:s a').'</span>
        </td>
        </tr>


        </table>
		<p>
		        <p>Please use the posting password above at the time of uploading contribution.</p>

With best regards,
<strong>TEC Standards Coordination Portal Management Service.</strong>
</p>
</body>
</html>';
         $mail->Body = $mailContent;
         $mail->send();
       

                if($insert_2===true)
                {
                 $response = array('status' =>'success',
                                    'message' =>'Document regitration is successfully.');
								    //'message' =>$gm_email );
                }else
                {
                $response = array('status' =>'error',
                                    'message' =>'Document not registered.' );

                }
            
            }


		echo json_encode($response);


    }
    public function upload_document($sdo_id,$group_id)
    {
    	$data['page']   =   "user/group/upload-document-file";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_data']= $this->group_model->getOneGroup($group_id);
        $data['get_que_list'] = $this->group_model->getAllQuestion($group_id);
        $data['get_meeting_list'] = $this->group_model->getAllMeeting($group_id);
        $data['workitem_list'] = $this->group_model->getAllWorkItem($group_id);
        $data['sdo_list'] = $this->Home_model->getAllSDO(); 
        $data['last_reg_no'] = $this->group_model->LastRegNo($group_id); 
        $this->load->view('user/template',$data);

    }
    public function docRegistrationDelete()
    {
        $contribution_id= $this->input->post('id');
        $delete = $this->group_model->deleteDocRegistration($contribution_id);
        if($delete)
        {

            echo "success";
        }
    }
    public function edit_upload_contribution($sdo_id,$group_id,$contribution_id)
    {
        $data['page']   =   "user/group/add-upload-new-contributions";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_data']= $this->group_model->getOneGroup($group_id);
        $data['get_que_list'] = $this->group_model->getAllQuestion($group_id);
        $data['get_meeting_list'] = $this->group_model->getAllMeeting($group_id);
        $data['workitem_list'] = $this->group_model->getAllWorkItem($group_id);
        $data['sdo_list'] = $this->Home_model->getAllSDO();
        $data['workingparty_list'] = $this->group_model->getAllWorkingParty($sdo_id,$group_id); 
        $data['document_expiry_date'] = $this->dash_model->getDocumentExpiryDate($group_id);
        $data['result'] = $this->group_model->getActContribution($sdo_id,$group_id,$contribution_id);
        $data['contributor_list'] = $this->group_model->getActContributor($contribution_id);
        $this->load->view('user/template',$data);


    }
    public function delete_contributoer()
    {
        $contributer_id= $this->input->post('id');
        $delete = $this->group_model->deleteContributer($contributer_id);
        if($delete)
        {

            echo "success";
        }


    }
    public function doc_upload()
    {
        extract($_POST);
        if(!empty($group_id))
        {
            $query = $this->db->select('*')->where('sdo_id',$sdo_id)->where('group_id',$group_id)->where('contribution_id',$contribution_id)->get('group_contributions');
            $count2 = $query->num_rows();
            $result = $query->row();
            $current_y = date('Y');
            $count = $this->db->select('*')->where('sdo_id',$sdo_id)->where('group_id',$group_id)->where('contribution_id',$contribution_id)->where('year(created_at)', $current_y)->get('old_group_contriboution_file')->num_rows();
            if($count==0)
            {
                $count=1;
            }else
            {
                $count = $count+1;
            }
            //
            $meeting_id = $result->meeting_id;
            $title = $result->title;
            $result->password;
            $unique_no =  $result->unique_no;
            $questions = $this->db->select('*')->where('question_id',$result->question_id)->get('questions')->row();
            //$contr_rows = $this->db->select()->where('contribution_id',$$contribution_id)->get('group_contributions')->row();
            $group = $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
         $meeting = $this->db->select('*')->where('meeting_id',$meeting_id)->get('group_meeting')->row();
         $start_date = $meeting->meeting_date;
         $end_date = $meeting->meeting_end_date;
            $user_id = $this->session->userdata('user_id');
          $profile = $this->db->select('*')->where('user_id',$user_id)->get('users')->row();
           if(!empty($_FILES['docfile']['name']))
           {
                $new_name  = time().url_title($_FILES["docfile"]['name']).'.'.pathinfo($_FILES["docfile"]["name"], PATHINFO_EXTENSION);;
                $config['upload_path'] = 'uploads/files/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $new_name;
                $config['fileExt']  = pathinfo($_FILES["docfile"]["name"], PATHINFO_EXTENSION);
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('docfile'))
                {
                    $uploadData = $this->upload->data();
                    $docfile = $new_name;
                     
                }else
                {
                    $docfile = '';
                   
                }
            }       
                    $old_unqiue_no = $result->unique_no;
                    if($count2==1)
                    {
                        
                         $new_unqiue_no = 'R'.$count; 

                    }else{

                         $new_unqiue_no = NULL;  
                    }
            if($result->password == $password)
              {
                  //Mail NOtifications
                   $mail_notification =$this->db->select('*')->where('email_subscription','Y')->where('group_id',$group_id)->get('email_subscription')->result();
                    foreach($mail_notification as $mail_not)
                    {
                        $foremail = $mail_not->user_email;
                        //$mailarray[]= array('email'=>$mail_not->user_email);
                        //Email
                     
         $this->load->library('phpmailer_lib');

        // PHPMailer object
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
         $mail->addAddress($foremail);

         $mail->Subject = 'Document Uploaded  notification - Standards Coordination Portal';

        // Email body content
         $mailContent = '<style>
    a:hover {text-decoration: underline !important;}
</style>
<body>
    <table  border="1"  width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family:"Open Sans", sans-serif; width:100%;">
        <tr>
            <td>
            <img src="https://tec1.dssolution.in/assets/images/icon.png"  >
            </td>
            <td colspan="1" ><h2>TEC ['.$unique_no.']: Document Uploaded</h2></td>
                
         
        </tr>
        <tr>
        <td colspan="2" align="center"><p>Document envelope information</p></td>
        </tr>
    </table>
       <table  border="2"  width="100%" bgcolor="#fff"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif; width:100%; color:#000000; font-size:12px;">
        <tr>
        <td style="width:20%;">
        <span>Group Name :</span>
        </td>
        <td style="width:80%;">
       <strong style="color:red">'.$group->group_title.'</strong>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Document Number :</span>
        </td>
        <td style="width:80%;">
       <strong style="color:red">'.$unique_no.'</strong>
        </td>
        </tr>
           
        <tr>
        <td style="width:20%;">
        <span>Study Group :</span>
        </td>
        <td style="width:80%;">
        '.$group->study_periord.'
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Date of Meeting :</span>
        </td>
        <td style="width:80%;">
        <span> '.$start_date.' to '.$end_date.'</span>
        </td>
        </tr>
       
         <tr>
        <td style="width:20%;">
        <span>Document Type :</span>
        </td>
        <td style="width:80%;">
        <span>Contribution </span>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Document Title :</span>
        </td>
        <td style="width:80%;">
        <p>'.$title.'</p>
        </td>
        </tr>
          <tr>
        <td style="width:20%;">
        <span>Document Sources :</span>
        </td>
        <td style="width:80%;">
        <p>'.$profile->organization.'</p>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Address to Question :</span>
        </td>
        <td style="width:80%;">
        <p>'.$questions->question_no.'</p>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Uploaded by :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->name.'&nbsp;'.$profile->surname.'</span>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>member organization :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->organization.'</span>
        </td>
        </tr>
        
        <tr>
        <td style="width:20%;">
        <span>E-mail :</span>
        </td>
        <td style="width:80%;">
        <span><a href="mailto:'.$profile->email.'">'.$profile->email.'</a></span>
        </td>
        </tr>
          <tr>
        <td style="width:20%;">
        <span>Mobile No. :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->contact_no.'</span>
        </td>
        </tr>
      
         <tr>
                <td style="width:20%;">
        <span>Cc to :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
       
         <tr>
                <td style="width:20%;">
        <span>Remark :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
         
                <td style="width:20%;">
        <span>Registration Timetap :</span>
        </td>
        <td style="width:80%;">
        <span>'.date('Y-m-d h:i:s a').'</span>
        </td>
        </tr>


        </table>
<p>Please use the posting password above at the time of uploading contribution.</p>
<p>With best regards,</br>
<strong>TEC Standards Coordination Portal Management Service<strong> </p
</body>
</html>';
         $mail->Body = $mailContent;
         $mail->send();
                    }
                  //End Mail Notifications
                  
                  //Email
                     
         $this->load->library('phpmailer_lib');

        // PHPMailer object
         $mail1 = $this->phpmailer_lib->load();

        // SMTP configuration
         $mail1->isSMTP();
       $current_url = $_SERVER['SERVER_NAME'];
		if($current_url=='tec1.dssolution.in')
        {
        $mail1->Host     = 'dssolution.in';
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
        $mail1->Host     = 'relay.nic.in';
        $mail1->SMTPAuth = false;
        $mail1->Username = '';
        $mail1->Password = '';
        $mail1->SMTPSecure = '';
        $mail1->Port     = 25;
       $mail1->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail1->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }
         $mail1->isHTML(true);

       // Add a recipient
         $mail1->addAddress($profile->email);

         $mail1->Subject = 'Document Uploaded - Standards Coordination Portal';

        // Email body content
         $mailContent1 = '<style>
    a:hover {text-decoration: underline !important;}
</style>
<body>
    <table  border="1"  width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family:"Open Sans", sans-serif; width:100%;">
        <tr>
            <td>
            <img src="https://tec1.dssolution.in/assets/images/icon.png"  >
            </td>
            <td colspan="1" ><h2>TEC ['.$unique_no.']: Document Uploaded</h2></td>
                
         
        </tr>
        <tr>
        <td colspan="2" align="center"><p>Document envelope information</p></td>
        </tr>
    </table>
       <table  border="2"  width="100%" bgcolor="#fff"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif; width:100%; color:#000000; font-size:12px;">
        <tr>
        <td style="width:20%;">
        <span>Document Number :</span>
        </td>
        <td style="width:80%;">
       <strong style="color:red">'.$unique_no.'</strong>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Posting Password :</span>
        </td>
        <td style="width:80%;">
        <a  href="#"><strong style="color:red">'.$result->password.'</strong></a>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Study Group :</span>
        </td>
        <td style="width:80%;">
        '.$group->study_periord.'
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Date of Meeting :</span>
        </td>
        <td style="width:80%;">
        <span> '.$start_date.' to '.$end_date.'</span>
        </td>
        </tr>
       
         <tr>
        <td style="width:20%;">
        <span>Document Type :</span>
        </td>
        <td style="width:80%;">
        <span>Contribution </span>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Document Title :</span>
        </td>
        <td style="width:80%;">
        <p>'.$title.'</p>
        </td>
        </tr>
          <tr>
        <td style="width:20%;">
        <span>Document Sources :</span>
        </td>
        <td style="width:80%;">
        <p>'.$profile->organization.'</p>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Address to Question :</span>
        </td>
        <td style="width:80%;">
        <p>'.$questions->question_no.'</p>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Uploaded by  :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->name.'&nbsp;'.$profile->surname.'</span>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Uploader organization name :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->organization.'</span>
        </td>
        </tr>
         
        <tr>
        <td style="width:20%;">
        <span>E-mail :</span>
        </td>
        <td style="width:80%;">
        <span><a href="mailto:'.$profile->email.'">'.$profile->email.'</a></span>
        </td>
        </tr>
          <tr>
        <td style="width:20%;">
        <span>Mobile No. :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->contact_no.'</span>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Telephone. :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->landline.'</span>
        </td>
        </tr>
         
        
        <tr>
                <td style="width:20%;">
        <span>TIELS Account :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
         <tr>
                <td style="width:20%;">
        <span>Remark :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
            <tr>
                <td style="width:20%;">
        <span>Additional Contacts :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
        <tr>
                <td style="width:20%;">
        <span>Registration Timetap :</span>
        </td>
        <td style="width:80%;">
        <span>'.date('Y-m-d h:i:s a').'</span>
        </td>
        </tr>


        </table>
        <p>Please use the posting password above at the time of uploading contribution.</p>
<p>With best regards,</br>
<strong>TEC Standards Coordination Portal Management Service<strong> </p>
</body>
</html>';
         $mail1->Body = $mailContent1;
         $mail1->send();
//for Group admin mail
$group_manager = $this->db->select('users.email,group_managers.member_id')->join('users','users.user_id=group_managers.member_id','left')->where('group_managers.group_id',$group_id)->get('group_managers')->result();	
				foreach($group_manager as $gm_value)
				{
					$gm_email[] = $gm_value->email;	

				}
                $this->load->library('phpmailer_lib');

        // PHPMailer object
         $mail2 = $this->phpmailer_lib->load();

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
        $mail2->SMTPAuth = false;
        $mail2->Username = '';
        $mail2->Password = '';
        $mail2->SMTPSecure = '';
        $mail2->Port     = 25;
       $mail2->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail2->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
            
        }
         $mail2->isHTML(true);

       // Add a recipient
         $mail2->addAddress($profile->email);
         $mail2->Subject = '['.$group->shortform.'] Document Uploaded '.$unique_no.' '.$profile->name.'&nbsp;'.$profile->surname.' - Standards Coordination Portal';

        // Email body content
         $mailContent2 = '<p>Dear Sir/Madam,<br>
         A new document/contribution has been uploaded. Please take necessary action for approval/rejection.<p>
         <p>With best regards,<br>
         <strong>TEC Standards Coordination Portal Management Service.</strong></p>
         ';
         $mail2->Body = $mailContent2;
         $mail2->send();



                    $dataarray= array('file' => $docfile,
                         'file_status' =>'uploaded',
                        'file_uploaded_date' => date('Y-m-d h:i:s')

                    );
                    $insert  = $this->group_model->docFileUpload($dataarray,$sdo_id, $group_id,$contribution_id);
                           
                     if($insert===true)
                   {
                          $response = array('status' =>'success',
                                    'message' =>'File uploaded successfully.' );
                    }else
                    {
                           $response = array('status' =>'error',
                                    'message' =>'File not uploaded.' );

                    }
                  
              }else
              {
                   $response = array('status' =>'error',
                                    'message' =>'Your document password not match.' );
              }

                       
                 

           }else{
            $response = array('status' =>'success',
                                    'message' =>'Somthing went to wrong.' );


        }  

        echo json_encode($response); 




    }
    public function Submit_upload_doc_file()
    {
        extract($_POST);
        if(!empty($group_id))
        {
            $query = $this->db->select('*')->where('sdo_id',$sdo_id)->where('group_id',$group_id)->where('contribution_id',$contribution_id)->get('group_contributions');
            $count2 = $query->num_rows();
            $result = $query->row();
            $current_y = date('Y');
            $count = $this->db->select('*')->where('sdo_id',$sdo_id)->where('group_id',$group_id)->where('contribution_id',$contribution_id)->where('year(created_at)', $current_y)->get('old_group_contriboution_file')->num_rows();
            if($count==0)
            {
                $count=1;
            }else
            {
                $count = $count+1;
            }
            $meeting_id = $result->meeting_id;
            $title = $result->title;
            $password = $result->password;
            $unique_no =  $result->unique_no;
            $questions = $this->db->select('*')->where('question_id',$result->question_id)->get('questions')->row();
            //$contr_rows = $this->db->select()->where('contribution_id',$$contribution_id)->get('group_contributions')->row();
            $group = $this->db->select('*')->where('group_id',$group_id)->get('groups')->row();
         $meeting = $this->db->select('*')->where('meeting_id',$meeting_id)->get('group_meeting')->row();
         $start_date = $meeting->meeting_date;
         $end_date = $meeting->meeting_end_date;
            $user_id = $this->session->userdata('user_id');
          $profile = $this->db->select('*')->where('user_id',$user_id)->get('users')->row();
          $password = $this->input->post('password');
           if(!empty($_FILES['docfile']['name']))
           {
                $new_name  = time().url_title($_FILES["docfile"]['name']).'.'.pathinfo($_FILES["docfile"]["name"], PATHINFO_EXTENSION);;
                $config['upload_path'] = 'uploads/files/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $new_name;
                $config['fileExt']  = pathinfo($_FILES["docfile"]["name"], PATHINFO_EXTENSION);
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('docfile'))
                {
                    $uploadData = $this->upload->data();
                    $docfile = $new_name;
                     
                }else
                {
                    $docfile = '';
                   
                }
            }       
                    $old_unqiue_no = $result->unique_no;
                    if($count2==1)
                    {
                        
                         $new_unqiue_no = 'R'.$count; 

                    }else{

                         $new_unqiue_no = NULL;  
                    }
                   

                      if($result->password == $password)
                    {                   
                    $dataarray= array('file' => $docfile,
                        're_upload_no' => $new_unqiue_no,
                        'file_status' =>'re-uploaded',
                        'file_uploaded_date' => date('Y-m-d h:i:s')

                    );
                    $insert  = $this->group_model->docFileUpload($dataarray,$sdo_id, $group_id,$contribution_id);

                       
                             $dataarray2 = array('unique_no' =>$old_unqiue_no.'-'.$result->re_upload_no,
                                         'sdo_id'   => $sdo_id,
                                         'group_id' => $group_id,
                                         'contribution_id' => $contribution_id,
                                         'old_file' => $result->file,
                                         'created_at' => date('Y-m-d h:i:s'));
                                         

                           $insert2 = $this->group_model->insertContributionOldfile($dataarray2);
                               if($insert===true)
                   {
                          $response = array('status' =>'success',
                                    'message' =>'File uploaded successfully.' );
                    }else
                    {
                           $response = array('status' =>'error',
                                    'message' =>'File not uploaded.' );

                    }
                    }else
                    {
                         $response = array('status' =>'error',
                                    'message' =>'Your document password not match.' );
                        
                    }
                    //Mail Notification
                    
                    $mail_notification1 = $this->db->select('*')->where('email_subscription','Y')->where('group_id',$group_id)->get('email_subscription')->result();
                    foreach($mail_notification as $mail_not)
                    {
                         $subcriber_users[] = $mail_not->user_email;
                    }
                      

                     //Email
                      
          $this->load->library('phpmailer_lib');

        // PHPMailer object
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
         $mail->addAddress($profile->email,$subcriber_users);

         $mail->Subject = 'Document Uploaded ["Re-uploaded"]- Standards Coordination Portal';

        // Email body content
         $mailContent = '<style>
    a:hover {text-decoration: underline !important;}
</style>
<body>
    <table  border="1"  width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family:"Open Sans", sans-serif; width:100%;">
        <tr>
            <td>
            <img src="https://tec1.dssolution.in/assets/images/icon.png"  >
            </td>
            <td colspan="1" ><h2>TEC ['.$old_unqiue_no."-".$new_unqiue_no.']: Document Uploaded</h2></td>
                
         
        </tr>
        <tr>
        <td colspan="2" align="center"><p>Document envelope information</p></td>
        </tr>
    </table>
       <table  border="2"  width="100%" bgcolor="#fff"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif; width:100%; color:#000000; font-size:12px;">
        <tr>
        <td style="width:20%;">
        <span>Document Number :</span>
        </td>
        <td style="width:80%;">
       <strong style="color:red">'.$old_unqiue_no."-".$new_unqiue_no.'</strong>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Posting Password :</span>
        </td>
        <td style="width:80%;">
        <a  href="#"><strong style="color:red">'.$result->password.'</strong></a>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Study Group :</span>
        </td>
        <td style="width:80%;">
        '.$group->study_periord.'
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Date of Meeting :</span>
        </td>
        <td style="width:80%;">
        <span> '.$start_date.' to '.$end_date.'</span>
        </td>
        </tr>
       
         <tr>
        <td style="width:20%;">
        <span>Document Type :</span>
        </td>
        <td style="width:80%;">
        <span>Contribution </span>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Document Title :</span>
        </td>
        <td style="width:80%;">
        <p>'.$title.'</p>
        </td>
        </tr>
          <tr>
        <td style="width:20%;">
        <span>Document Sources :</span>
        </td>
        <td style="width:80%;">
        <p>'.$profile->organization.'</p>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>Address to Question :</span>
        </td>
        <td style="width:80%;">
        <p>'.$questions->question_no.'</p>
        </td>
        </tr>
         <tr>
        <td style="width:20%;">
        <span>Full name :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->name.'&nbsp;'.$profile->surname.'</span>
        </td>
        </tr>
        <tr>
        <td style="width:20%;">
        <span>member organization :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->organization.'</span>
        </td>
        </tr>
       
        <tr>
        <td style="width:20%;">
        <span>E-mail :</span>
        </td>
        <td style="width:80%;">
        <span><a href="mailto:'.$profile->email.'">'.$profile->email.'</a></span>
        </td>
        </tr>
          <tr>
        <td style="width:20%;">
        <span>Mobile No. :</span>
        </td>
        <td style="width:80%;">
        <span>'.$profile->contact_no.'</span>
        </td>
        </tr>
       
      
         <tr>
                <td style="width:20%;">
        <span>Cc to :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
       
         <tr>
         <td style="width:20%;">
        <span>Remark :</span>
        </td>
        <td style="width:80%;">
        <span></span>
        </td>
        </tr>
           
        <tr>
                <td style="width:20%;">
        <span>Registration Timetap :</span>
        </td>
        <td style="width:80%;">
        <span>'.date('Y-m-d h:s:i a').'</span>
        </td>
        </tr>


        </table>
        <p>With best regards,</br>
<strong>TEC Standards Coordination Portal Management Service<strong> </p>
</body>
</html>';
         $mail->Body = $mailContent;
         $mail->send();
        }
           
         if($mail->send())
         {
             $response = array('status' =>'success',
                                    'message' =>'Email send successfully.');
           }else{
            $response = array('status' =>'error',
                                    'message' =>'Somthing went to wrong.' );


           }  

        echo json_encode($response); 




    }
    public function filedownload($sdo_id, $group_id, $contribution_id)
    {
        if(!empty($sdo_id)){
            
            $fileInfo = $this->group_model->getDownloadFile($sdo_id, $group_id, $contribution_id);
            
            //file path
              $data = base_url().'uploads/files/'.$fileInfo->file;
              $this->load->helper('download');
             //$data = get_contents(getDocument($fileInfo['file'], 'uploads/file/'));
              $name = $fileInfo->file;
            
            //download file from directory
             force_download($name, $data);
        }
    }
    public function upload_revision_of_existing_contribution($sdo_id=0,$group_id=0)
    {
        $data['page']   =   "user/group/revision-of-existing-contribution";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_data']= $this->group_model->getOneGroup($group_id);
        $data['get_que_list'] = $this->group_model->getAllQuestion($group_id);
        $data['get_meeting_list'] = $this->group_model->getAllMeeting($group_id);
        $data['workitem_list'] = $this->group_model->getAllWorkItem($group_id);
        $data['sdo_list'] = $this->Home_model->getAllSDO(); 
        $data['doc_reg_list'] = $this->group_model->getAllMemberUploadeddoc($group_id,$this->session->userdata('user_id')); 
        $this->load->view('user/template',$data);


    }

  
    
    
	




}


?>