<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Datatables extends CI_controller
{
		public function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session');
		$this->load->model('Login_model','auth');
		$this->load->model('Home_model','Home_model');
		$this->load->model('Dashboard_model','dash_model');
        $this->load->model('Datatable_model', 'datatables');
		

	}
	public function index($sdo_id='', $group_id='')
	{
        $data['page'] = 'front/datatables';
        $data['success_type'] ="otp";
        $data['group_category'] = $this->Home_model->getAllCatgory();
        //$data['working_group'] = $this->Home_model->getAllWorkingGroup();
        $countries = $this->datatables->get_list_key_area();

		$opt = array('' => 'All Key Area');
		foreach ($countries as $country) {
			$opt[$country] = $country;
		}
        $data['form_country'] = form_dropdown('',$opt,'','id="key_area" style="width:100%"');
		$sgs = $this->datatables->get_list_sg();
        $opt1 = array('' => 'All SG');
		foreach ($sgs as $sg) {
			$opt1[$sg] = $sg;
		}
        $data['form_sg'] = form_dropdown('',$opt1,'','id="sg" style="width:100%"');
		$ques = $this->datatables->get_list_que();
        $opt2 = array('' => 'All Que. No.');
		foreach ($ques as $que) {
			$opt2[$que] = $que;
		}
        $data['form_que'] = form_dropdown('',$opt2,'','id="que_no" style="width:100%"');


        $this->load->view('front/template',$data);
	}
    public  function get_all_data()
    {
        $list = $this->datatables->get_datatables();
		$data = array();
		$no = 1;
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customers->key_area;
			$row[] = $customers->sg;
			$row[] = $customers->work_item;
			$row[] = $customers->subject_title;
			$row[] = $customers->que_no;
			$row[] = $customers->tsdsi_tec_both;
            $row[] = $customers->tec_nwg_status;
            $row[] = $customers->tec_remarks_title_use_case_of_wg;
            $row[] = $customers->tsdsi_status;
            $row[] = $customers->tsdsi_remarks_title_use_case_of_wg;
            $row[] = $customers->orgn;
            $row[] = $customers->name; 
            $row[] = $customers->email;
            $row[] = $customers->global_contribution;
            $row[] = $customers->status;
            $row[] = $customers->timing;
            $row[] = $customers->approval_process;
            $row[] = $customers->version;
            $row[] = $customers->liaison_relationship;
            $row[] = $customers->priority;

			$data[] = $row;
		}

		$output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables->count_all(),
            "recordsFiltered" => $this->datatables->count_filtered(),
            "data" => $data,
    );
//output to json 
		//output to json format
		echo json_encode($output);
    }

	


}


?>