<?php
class Meeting extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session','database');
		$this->load->model('super-admin/Auth_model','auth');
		$this->load->model('super-admin/Meeting_model','group_modal');
        $this->load->model('Home_model','Home_model');
		$this->auth->isLoggedIn();
	}
	public function index()
	{
		$data['page'] =  "super-admin/meeting/index";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['meeting_list'] = $this->group_modal->allmeeting();
		//$data['groups'] = $this->group_modal->getAllGroup();

		$this->load->view('super-admin/template',$data);
		
		
	}
    public function sdo_filter($sdo_id)
    {
           
        $data['page'] =  "super-admin/group/sdo-filer-list";
        $data['profile']= $this->auth->getProfile($this->session->userdata('admin_id'));
        $data['category_list'] = $this->group_modal->getActGroupCatgory();
        $data['groups'] = $this->group_modal->getAllSDOGroup($sdo_id);
        $data['sdo_data'] = $this->group_modal->getOneGroupCatgory($sdo_id);
        $this->load->view('super-admin/template',$data);



    }
    public function edit($group_id)
    {
        $data['page'] =  "super-admin/meeting/edit";
        $data['profile']= $this->auth->getProfile($this->session->userdata('admin_id'));
        $data['result'] = $this->group_modal->getOneMeeting($group_id);
        	$data['group_list'] = $this->group_modal->getAllMyGroups();
        $this->load->view('super-admin/template',$data);
        
        
    }

	public function create()
	{
		
		
		
		if (!empty($_POST) && $this->input->is_ajax_request())
        {
        	//$data['page'] =  "super-admin/group/create";
            $group_id = $this->input->post('group_id');
            $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
            $data['result'] = $this->group_modal->getOneGroup($group_id);
            $data['groupadmin_list'] = $this->group_modal->getAllGroupAdmin();
            $this->load->view('super-admin/group/create',$data);

        }
		
		
	}

	public function profile()
	{
		$data['page'] =  "super-admin/profile";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$this->load->view('super-admin/template',$data);
		
		
	}
	
	//Change the Password
	public function save_data()
	{
    //error_reporting(0);
	$group_id = $this->input->post('group_id');
    $group_title = $this->input->post('group_title');
   // $name = "Jake Awesome Whiteman";
    $separate = explode(" ", $group_title);
    $last = array_pop($separate);
    $group_shortform = implode(' ', $separate)." ".$last[0].".";
   
               if(empty($group_id))
                {
                    

                     $data_array = array('category_id' => $this->input->post('category_id'),
                            'group_title' => $this->input->post('group_title'),
                            'group_name' =>  $this->input->post('group_name'),
                            'study_periord' => $this->input->post('study_periord'),
                             'shortform' =>  $this->input->post('group_short_name'),
                            'itu_website_study_group' => $this->input->post('itu_website_study_group'),
                            'group_description' => $this->input->post('group_desription'),
                            'created_at' => date('Y-m-d h:s:i a'));
                	$insert =  $this->group_modal->save_data($data_array);
                    
                    //$gadmins = array();

                    
                   if($insert ===true)
                   {
          	            $response = array('status' => 'success',
                               'message' => 'Group created successfully.');

                        }else
                       {

                        $response = array('status' => 'error',
                               'message' => 'Group not created!');
                    }
                	

                }else{
                	   

                          $data_array = array('category_id' => $this->input->post('category_id'),
                                      'group_title' => $this->input->post('group_title'),
                                      'group_name' =>  $this->input->post('group_name'),
                                      'study_periord' => $this->input->post('study_periord'),
                                      'itu_website_study_group' => $this->input->post('itu_website_study_group'),
                                      'group_description' => $this->input->post('group_desription'),
                                      'shortform' =>  $this->input->post('group_short_name'),
                                      'status' => $this->input->post('status'),
                                      'updated_at' => date('Y-m-d h:s:i a'));
                	        $update =  $this->group_modal->update_data($data_array,$group_id);
                           
                            
                           if($update ===true)
                           {
          	                   $response = array('status' => 'success',
                               'message' => 'Group updated successfully.'
                                );

                            }else
                            {

                              $response = array('status' => 'error',
                               'message' => 'Group not updated!');
                            }

                }
                   
          echo json_encode($response);
    }



   public function deletemeeting()
   {
	  $meeting_id = $this->input->post('id');

	    $delete = $this->group_modal->delete_data($meeting_id);
	     echo 'success';
    }
    // Group Category
   public function save_meeting()
	{
		extract($_POST);
		error_reporting(0);

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

			}
		} 
		$dataarray = array('group_id' =>$group_id,
			'meeting_title' =>$meeting_title,
				'meeting_type' =>$meeting_type,
			'meeting_date' => $newmeetingdate,
			'meeting_end_date' =>$newendmeddting_date,
			'user_id'      => $this->session->userdata('user_id'), 
			'meeting_status'  => $status,
			'updated_at' => date('Y-m-d h:s:i a'));

		$update =  $this->group_modal->updateMeeting($dataarray,$meeting_id);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Meeting  updated successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Meeting not updated.' );
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
		$dataarray = array('group_id' =>$group_id,
			'meeting_title' =>$meeting_title,
				'meeting_type' =>$meeting_type,
			'meeting_date' => $newmeetingdate,
		    'meeting_end_date' =>$newendmeddting_date,
			'user_id'      => $this->session->userdata('user_id'), 
			'meeting_file' => $meeting_file,
			'created_at' => date('Y-m-d h:s:i a'));

		$update =  $this->group_modal->saveMeeting($dataarray);
		if($update===true)
		{
			$response = array('status' =>'success',
				'message' =>'Meeting  added successfully.' );
		}else
		{
			$response = array('status' =>'success',
				'message' =>'Meeting not added.' );
		}




	}
	echo json_encode($response);


   }


}


?>