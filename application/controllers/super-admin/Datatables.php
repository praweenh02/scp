<?php
error_reporting(0);
class Datatables extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form');
	$this->load->library('session','database');
		$this->load->model('super-admin/Auth_model','auth');
		$this->load->model('super-admin/Dashboard_model','dash_model');
$this->load->model('super-admin/Datatables_model','datatable_model');
$this->load->model('Home_model','Home_model');
$this->load->library('Excel');
		$this->auth->isLoggedIn();
	}
	public function index()
	{
		$data['page'] =  "super-admin/datatables/index";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
    $data['page_list'] = $this->datatable_model->getAllPagelist();
		$this->load->view('super-admin/template',$data);
		
		
	}
	public function create($page_id='')
	{
		$data['page'] =  "super-admin/datatables/create";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['menu_list'] = $this->datatable_model->getAllmenulist();
		$data['result'] = $this->datatable_model->pageDetails($page_id);
		$data['sdo_list'] = $this->Home_model->getAllSDO();
		$this->load->view('super-admin/template',$data);
		
		
	}
	public function view($page_slug)
	{
		$data['page'] =  "super-admin/datatables/view";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['menu_list'] = $this->datatable_model->getAllmenulist();
		$data['result'] = $this->datatable_model->getPageDetails($page_slug);
		$this->load->view('super-admin/template',$data);
		
		
	}
	public function save_data()
	{
//error_reporting(0);
	$page_id = $this->input->post('page_id');
// $num_padded = sprintf("%02d", $this->input->post('group_admin'));
//$url =url_title($this->input->post('title'), '-', true);
if(empty($page_id))
{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$key_area = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$sg = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$work_item = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$subject_title = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$que_no = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$tsdsi_tec_both =$worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$tec_nwg_status =$worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$tec_remarks_title_use_case_of_wg =$worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$tsdsi_status =$worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$tsdsi_remarks_title_use_case_of_wg =$worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$orgn =$worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$name =$worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$email =$worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$global_contribution =$worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$status =$worksheet->getCellByColumnAndRow(14, $row)->getValue();
					$timing =$worksheet->getCellByColumnAndRow(15, $row)->getValue();
					$approval_process =$worksheet->getCellByColumnAndRow(16, $row)->getValue();
					$version =$worksheet->getCellByColumnAndRow(17, $row)->getValue();
					$liaison_relationship =$worksheet->getCellByColumnAndRow(18, $row)->getValue();
					$priority =$worksheet->getCellByColumnAndRow(18, $row)->getValue();
					$created_at = date('Y-m-d h:i:s a');
					if(!empty($key_area))
					{
					$data = array(

                        'sdo_id' => $this->input->post('sdo_id'),
                        'group_id' => $this->input->post('group_id'),
												'key_area'		=>	$key_area,
												'sg'			=>	$sg,
												'work_item'				=>	$work_item,
												'subject_title'		=>	$subject_title,
												'que_no'			=>	$que_no,
												'tsdsi_tec_both' => $tsdsi_tec_both,
												'tec_nwg_status' =>$tec_nwg_status,
												'tec_remarks_title_use_case_of_wg' => $tec_remarks_title_use_case_of_wg,
												'tsdsi_status'=>$tsdsi_status,
												'tsdsi_remarks_title_use_case_of_wg' =>$tsdsi_remarks_title_use_case_of_wg,
												'orgn' => $orgn,
												'name' => $name,
												'email' =>$name,
												'global_contribution' => $global_contribution,
												'status' =>$status,
												'timing' =>$timing,
												'approval_process' => $approval_process,
												'version' => $version,
												'liaison_relationship' => $liaison_relationship,
												'priority' => $priority,
												'created_at' =>$created_at



					);
				
				
					  $insert = $this->datatable_model->save_data($data);
					   if($insert ===true)
			 	    {
				    	$response = array('status' => 'success',
				     'message' => 'Page created successfully.');
				    }else
				    {
				    $response = array('status' => 'error',
				    'message' => 'Page  not created!');
				    }
				  }
	
				}
			}
			
			 
		}
			//$this->excel_import_model->insert($data);
			
}else{
	
$dataarray = array('show_at_nav' => $this->input->post('show_at_nav'),
'title' => $this->input->post('title'),
'parent_id' => $this->input->post('parent_id'),
'url' => $url,
'status' => 'Y',
'deleted' =>'Y',
'description' => $this->input->post('description'),
'status' => $this->input->post('status'),
'updated_at' => date('Y-m-d h:s:i a'));
	$update =  $this->page_model->update_data($dataarray,$page_id);
if($update ===true)
{
	$response = array('status' => 'success',
'message' => 'Page details  updated successfully'
);
}else
{
$response = array('status' => 'error',
'message' => 'Page not updated!');
}
}
echo json_encode($response);
}
public function delete_data()
{
	$page_id = $this->input->post('id');
	$delete = $this->datatable_model->delete_data($page_id);
if($delete)
{
	echo 'success';
}
}
}
?>