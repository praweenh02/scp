<?php
class ProposalController extends CI_controller {

	public function __construct() {

		parent::__construct();
		$this->load->helper('url', 'form');
		$this->load->library('session', 'database');
		$this->load->model('super-admin/Auth_model', 'auth');
		$this->load->model('super-admin/Question_model', 'que_model');
		$this->load->model('Home_model', 'Home_model');
		$this->load->model('super-admin/ProposalModel', 'ProposalModel');
		$this->auth->isLoggedIn();
	}
	public function index() {
		$data['page'] =  "super-admin/propsal/index";
		$data['profile'] = $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['groups'] = $this->que_model->getAllQuestion();
		$this->load->view('super-admin/template', $data);
	}
	public function create() {
		$data['page'] =  "super-admin/propsal/create";
		$data['profile'] = $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['groups'] = $this->que_model->getAllQuestion();
		$this->load->view('super-admin/template', $data);
	}
	public function save_proposal() {
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'designation' => $this->input->post('designation'),
			'date' =>     date('Y-m-d'),
			'superadmin_id' => $this->superadmin_id,
			'status' => '1', // Default to active
			'created_at' => date('Y-m-d H:i:s'),
		);


		if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
			$upload_path = FCPATH . './uploads/proposals/';
			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0755, true);
			}

			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'pdf|docx';
			$config['max_size'] = 2048; // 2MB

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file')) {
				$file_data = $this->upload->data();
				$data['file'] = $file_data['file_name'];
			} else {
				echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
				return;
			}
		}

		if ($this->proposalModel->save_proposal()) {
			echo json_encode(['status' => 'success', 'message' => 'Proposal saved successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to save proposal.']);
		}
	}
}
