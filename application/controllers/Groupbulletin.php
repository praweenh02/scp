<?php

class GroupBulletin extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form','security');
		$this->load->library('session','database');
		$this->load->model('Login_model','auth');
		$this->load->model('Dashboard_model','dash_model');
		$this->load->model('Groupmanager_model','gm_model');
		$this->load->model('Member_model','member_model');
		$this->load->model('GroupBulletin_model', 'gbulletion');
		$this->group_id = $this->session->userdata('group_id');
		$this->auth->isLoggedIn();
		
	}

	 public function index($value='')
	 {
	 	$data['page']   =   "user/group-bulletin/index";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['result'] = $this->gbulletion->getAllGroupBulletin($this->session->userdata('group_id'));
	    $this->load->view('user/template',$data);

	 }
	 public function create($groupbulletin_id)
	 {
	 	$data['page']   =   "user/group-bulletin/create";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['group_list'] = $this->gm_model->getAllMyGroups($this->session->userdata('user_id'));
		$data['result'] = $this->gbulletion->getOneGroupBulletin($groupbulletin_id);
	    $this->load->view('user/template',$data);

	 }
	 public function save_data()

	 {
	 	extract($_POST);

	 	$groupbulletin_id     = $this->input->post('groupbulletin_id');
        //$newmeetingdate = date('Y-m-d', strtotime($this->input->post('meeting_date')));
	 	if($groupbulletin_id)
	 	{

	 		if(!empty($_FILES['bulletin_file']['name']))
	 		{
	 			$new_name  = time().url_title($_FILES["bulletin_file"]['name']).'.'.pathinfo($_FILES["bulletin_file"]["name"], PATHINFO_EXTENSION);;
	 			$config['upload_path'] = 'uploads/group-bulletin/';
	 			$config['allowed_types'] = 'pdf|doc|docx';
	 			$config['file_name'] = $new_name;
	 			$config['fileExt']  = pathinfo($_FILES["bulletin_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
	 			$this->load->library('upload',$config);
	 			$this->upload->initialize($config);

	 			if($this->upload->do_upload('bulletin_file'))
	 			{
	 				$uploadData = $this->upload->data();
	 				$bulletin_file = $new_name;

	 				$query = $this->db->where('group_id',$group_id)->where('groupbulletin_id',$groupbulletin_id )->set('bulletin_file',$bulletin_file)->update('group_bulletin');

	 			}else
	 			{
	 				$bulletin_file = '';
	 					$response = array('status' =>'error',
				'message' =>'Please select only  doc file.' );
					echo json_encode($response);
			       	die();

	 			}
	 		} 
	 		   if(preg_match('/[^a-z0-9 _]+/i', $bulletin_title))
		{
		       	
		     	$response = array('status' =>'error',
    				'message' =>'Special characters not allowed.');
		    
    	
		    
		}else
		{
	 		$dataarray = array('group_id' => $group_id,
	 			'bulletin_title' => $bulletin_title,
	 			'user_id' => $this->session->userdata('user_id'),
	 			'bulletin_status' => $status,
	 			'updated_at' => date('Y-m-d h:s:i a'));
	 				$dataarray = $this->security->xss_clean($dataarray);

	 		$update =  $this->gbulletion->update_data($dataarray,$groupbulletin_id);
	 		if($update===true)
	 		{
	 			$response = array('status' =>'success',
	 				'message' =>'Group Bulletin  updated successfully.' );
	 		}else
	 		{
	 			$response = array('status' =>'success',
	 				'message' =>'Group Bulletin not updated.' );
	 		}

		}  

	 	}else
	 	{
	 		if(!empty($_FILES['bulletin_file']['name']))
	 		{
	 			$new_name  = time().url_title($_FILES["bulletin_file"]['name']).'.'.pathinfo($_FILES["bulletin_file"]["name"], PATHINFO_EXTENSION);
	 			$config['upload_path'] = 'uploads/group-bulletin/';
	 			$config['allowed_types'] = 'pdf|doc|docx';
	 			$config['file_name'] = $new_name;
	 			$config['fileExt']  = pathinfo($_FILES["bulletin_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
	 			$this->load->library('upload',$config);
	 			$this->upload->initialize($config);

	 			if($this->upload->do_upload('bulletin_file'))
	 			{
	 				$uploadData = $this->upload->data();
	 				$bulletin_file = $new_name;

	 			}else
	 			{
	 				$bulletin_file = '';
	 					$response = array('status' =>'error',
				'message' =>'Please select only  doc file.' );
					echo json_encode($response);
				die();

	 			}
	 		}else
	 		{
	 			$bulletin_file = ''; 
	 		}
	 	
           if(preg_match('/[^a-z0-9 _]+/i', $bulletin_title))
		{
		       	
		     	$response = array('status' =>'error',
    				'message' =>'Special characters not allowed.');
		    
    	
		    
		}else
		{
	 		$dataarray = array('group_id' => $group_id,
	 			'bulletin_title' => $bulletin_title,
	 			'bulletin_file' => $bulletin_file,
	 			'user_id' => $this->session->userdata('user_id'),
	 			'created_at' => date('Y-m-d h:s:i a'));
             	$dataarray = $this->security->xss_clean($dataarray);
	 		$update =  $this->gbulletion->save_data($dataarray);
	 		if($update===true)
	 		{
	 			$response = array('status' =>'success',
	 				'message' =>'Gorup Bulletin added successfully.' );
	 		}else
	 		{
	 			$response = array('status' =>'success',
	 				'message' =>'Group Bulletin not added.' );
	 		}

		}


	 	}
	 	echo json_encode($response);


	 }

	 public function deleteGroupBulletin()
	 {

	 	$id = $this->input->post('id');

	 	$delete = $this->gbulletion->delete_data($id);
	 	if($delete)
	 	{

	 		echo "success";
	 	}
	 }
}

?>