<?php
class ProposalController extends CI_controller
{
	// protected $auth;
	// protected $ProposalModel;
	// protected $que_model;

	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url', 'form');
		$this->load->library('session', 'database');
		$this->load->model('super-admin/Auth_model', 'auth');
		$this->load->model('super-admin/Question_model', 'que_model');
		$this->load->model('Home_model', 'Home_model');
		$this->load->model('super-admin/ProposalModel', 'ProposalModel');
		$this->auth->isLoggedIn();
	}
	public function index()
	{
		$data['page'] =  "super-admin/propsal/index";
		$data['profile'] = $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['proposalList'] = $this->ProposalModel->getProposalList();

		$this->load->view('super-admin/template', $data);
	}
	public function create()
	{
		$data['page'] =  "super-admin/propsal/create";
		$data['profile'] = $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$this->load->view('super-admin/template', $data);
	}
	public function save_proposal()
	{
		// =========================
		// 1. Prepare Proposal Data
		// =========================
		$data = array(
			'title'         => $this->input->post('title'),
			'description'   => $this->input->post('description'),
			'name'          => $this->input->post('name'),
			'email'         => $this->input->post('email'),
			'designation'   => $this->input->post('designation'),
			'organisation'  => $this->input->post('organisation'),
			'date'          => date('Y-m-d'),
			'superadmin_id' => $this->session->userdata('superadmin_id'), // Assuming it's created by a non-logged in user
			'status'        => 'Y', // Default to active
			'created_at'    => date('Y-m-d H:i:s'),
		);

		// =========================
		// 2. Insert Proposal First
		// =========================
		$this->db->insert('proposals', $data);
		$proposal_id = $this->db->insert_id();

		// =========================
		// 3. Upload Multiple Files
		// =========================
		if (!empty($_FILES['files']['name'][0])) {

			$upload_path = FCPATH . 'uploads/proposals/';

			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0755, true);
			}

			$files = $_FILES;
			$count = count($_FILES['files']['name']);

			for ($i = 0; $i < $count; $i++) {

				$_FILES['file']['name']     = $files['files']['name'][$i];
				$_FILES['file']['type']     = $files['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $files['files']['tmp_name'][$i];
				$_FILES['file']['error']    = $files['files']['error'][$i];
				$_FILES['file']['size']     = $files['files']['size'][$i];

				$config['upload_path']   = $upload_path;
				$config['allowed_types'] = 'pdf|doc|docx';
				$config['max_size']      = 5120; // 5MB
				$config['encrypt_name']  = TRUE;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('file')) {

					$file_data = $this->upload->data();

					// Save each file
					$this->db->insert('proposal_files', [
						'proposal_id' => $proposal_id,
						'file'        => $file_data['file_name']
					]);
				} else {
					// Debug if needed
					log_message('error', $this->upload->display_errors());
				}
			}
		}

		// =========================
		// 4. Response
		// =========================
		echo json_encode([
			'status'  => 'success',
			'message' => 'Proposal saved successfully.',
			'redirect' => base_url('super-admin/proposal'),
		]);
	}
}
