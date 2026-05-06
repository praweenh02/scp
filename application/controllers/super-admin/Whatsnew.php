<?php
class Whatsnew extends CI_controller
{
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form');
		$this->load->library('session','database');
		$this->load->model('super-admin/Auth_model','auth');
		$this->load->model('super-admin/Whatsnew_model','whtn_model');
		$this->load->model('Home_model','Home_model');
		$this->auth->isLoggedIn();
	}
	public function index()
	{
		$data['page'] =  "super-admin/whats-new/index";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['groups'] = $this->whtn_model->getAllWhatsnew();
		$this->load->view('super-admin/template',$data);
	}
	public function add($whatsnew_id='')
	{
		$data['page'] =  "super-admin/whats-new/create";
		$data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
		$data['sdo_list'] = $this->Home_model->getAllSDO(); 
		$data['result'] = $this->whtn_model->getOneWhatsnew($whatsnew_id);
		$this->load->view('super-admin/template',$data);


	}
	public function save_data()
	{
		extract($_POST);
		$whatsnew_id = $this->input->post('whatsnew_id');
    // $num_padded = sprintf("%02d", $this->input->post('group_admin'));

		if($whatsnew_id)
		{
			if(!empty($_FILES['whatsnew_file']['name']))
			{
				$dir_name = 'uploads/whats-new/';
                   if (!is_dir($dir_name)) {

					   mkdir($dir_name);
				    }
				$new_name  = time().url_title($_FILES["whatsnew_file"]['name']).'.'.pathinfo($_FILES["whatsnew_file"]["name"], PATHINFO_EXTENSION);;
				$config['upload_path'] = $dir_name;
				$config['allowed_types'] = 'pdf|doc|docx';
				$config['file_name'] = $new_name;
				$config['fileExt']  = pathinfo($_FILES["whatsnew_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('whatsnew_file'))
				{
					$uploadData = $this->upload->data();
					$whatsnew_file = $new_name;

					$query = $this->db->where('whatsnew_id ',$whatsnew_id)->set('whatsnew_file',$whatsnew_file)->update('whats_new');

				}else
				{
					$whatsnew_file = '';

				}
			}


			$data_array = array('whatsnew_title' => $this->input->post('whatsnew_title'),
				'whatsnew_status' => $this->input->post('status'),
				'updated_at' => date('Y-m-d h:s:i a'));
			$insert =  $this->whtn_model->update_data($data_array,$whatsnew_id);
			if($insert ===true)
			{
				$response = array('status' => 'success',
					'message' => 'Whats new updated successfully.');

			}else
			{

				$response = array('status' => 'error',
					'message' => 'Whats new  not updated!');
			}


		}else{
			  if(!empty($_FILES['whatsnew_file']['name']))
			{
				 	$dir_name = 'uploads/whats-new/';
                   if (!is_dir($dir_name)) {

					   mkdir($dir_name);
				    }

				$new_name  = time().url_title($_FILES["whatsnew_file"]['name']).'.'.pathinfo($_FILES["whatsnew_file"]["name"], PATHINFO_EXTENSION);;
				$config['upload_path'] = $dir_name;
				$config['allowed_types'] = 'pdf|doc|docx';
				$config['file_name'] = $new_name;
				$config['fileExt']  = pathinfo($_FILES["whatsnew_file"]["name"], PATHINFO_EXTENSION);

                //Load upload library and initialize configuration
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('whatsnew_file'))
				{
					$uploadData = $this->upload->data();
					$whatsnew_file = $new_name;

					//$query = $this->db->where('whatsnew_id ',$whatsnew_id)->set('whatsnew_file',$whatsnew_file)->update('whats_new');

				}else
				{
					$whatsnew_file = '';

				}
			}else
			{
			    	$whatsnew_file = '';
			    
			}


			$data_array = array('whatsnew_title' => $this->input->post('whatsnew_title'),
				'whatsnew_file' => $whatsnew_file,
				'updated_at' => date('Y-m-d h:s:i a'));
			$update =  $this->whtn_model->save_data($data_array);


			if($update ===true)
			{
				$response = array('status' => 'success',
					'message' => 'Whats new  added successfully'
				);

			}else
			{

				$response = array('status' => 'error',
					'message' => 'Whats new not added!');
			}

		}

		echo json_encode($response);


	}
	public function delete_data()
	{

		$whatsnew_id = $this->input->post('id');
		$delete = $this->whtn_model->deleteData($whatsnew_id);
		if($delete)
		{

			echo "success";
		}

	}
}
?>