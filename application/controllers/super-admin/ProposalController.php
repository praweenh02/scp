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
		// 1. PREPARE PROPOSAL DATA
		// =========================
		$data = array(

			'title'         => $this->input->post('title'),

			'description'   => $this->input->post('description'),

			'name'          => $this->input->post('name'),

			'email'         => $this->input->post('email'),

			'designation'   => $this->input->post('designation'),

			'organisation'  => $this->input->post('organisation'),

			'date'          => date('Y-m-d'),

			'superadmin_id' => $this->session->userdata('superadmin_id'),

			'status'        => 'Y',

			'created_at'    => date('Y-m-d H:i:s'),
		);

		// =========================
		// 2. INSERT PROPOSAL
		// =========================
		$this->db->insert('proposals', $data);

		$proposal_id = $this->db->insert_id();

		// =========================
		// 3. FILE SOURCE
		// =========================
		$file_source = $this->input->post('file_source') ?: 'upload';

		// =====================================================
		// 4. SAVE MULTIPLE URLS
		// =====================================================
		if ($file_source === 'url') {

			$file_urls = $this->input->post('file_urls');

			if (!empty($file_urls) && is_array($file_urls)) {

				foreach ($file_urls as $url) {

					$url = trim($url);

					// Skip empty rows
					if (empty($url)) {
						continue;
					}

					// Add https if missing
					if (!preg_match('#^https?://#i', $url)) {

						$url = 'https://' . $url;
					}

					// Validate URL
					if (filter_var($url, FILTER_VALIDATE_URL)) {

						$this->db->insert('proposal_files', [

							'proposal_id' => $proposal_id,

							'file'        => $url,

							'type'        => 'url',
						]);
					} else {

						log_message(
							'error',
							'Invalid proposal URL: ' . $url
						);
					}
				}
			}
		}

		// =====================================================
		// 5. SAVE MULTIPLE FILES
		// =====================================================
		elseif (
			!empty($_FILES['files']['name'][0])
		) {

			$upload_path = FCPATH . 'uploads/proposals/';

			// Create folder if not exists
			if (!is_dir($upload_path)) {

				mkdir($upload_path, 0755, true);
			}

			$files = $_FILES;

			$count = count($_FILES['files']['name']);

			for ($i = 0; $i < $count; $i++) {

				// Skip empty rows
				if (empty($files['files']['name'][$i])) {
					continue;
				}

				$_FILES['file']['name']
					= $files['files']['name'][$i];

				$_FILES['file']['type']
					= $files['files']['type'][$i];

				$_FILES['file']['tmp_name']
					= $files['files']['tmp_name'][$i];

				$_FILES['file']['error']
					= $files['files']['error'][$i];

				$_FILES['file']['size']
					= $files['files']['size'][$i];

				// Upload config
				$config['upload_path']
					= $upload_path;

				$config['allowed_types']
					= 'pdf|doc|docx';

				$config['max_size']
					= 5120; // 5MB

				$config['encrypt_name']
					= TRUE;

				$this->load->library('upload');

				$this->upload->initialize($config);

				// Upload file
				if ($this->upload->do_upload('file')) {

					$file_data = $this->upload->data();

					// Save file record
					$this->db->insert('proposal_files', [

						'proposal_id' => $proposal_id,

						'file'        => $file_data['file_name'],

						'type'        => 'file',
					]);
				} else {

					log_message(
						'error',
						$this->upload->display_errors()
					);
				}
			}
		}

		// =========================
		// 6. RESPONSE
		// =========================
		echo json_encode([

			'status'   => 'success',

			'message'  => 'Proposal saved successfully.',

			'redirect' => base_url('super-admin/proposal'),
		]);
	}
	public function documentDetails($proposal_id)
	{
		$proposal = $this->ProposalModel->getProposalById($proposal_id);
		$proposalCommentList = $this->ProposalModel->getProposalCommnetList($proposal_id);

		if (!$proposal) {
			show_404(); // or redirect with error message
			return;
		}

		$data['proposal'] = $proposal;
		$data['proposalCommentList'] = $proposalCommentList;
		$data['page_title'] = $proposal->title . " - Details";
		$data['page'] = "super-admin/propsal/document_details";
		$data['profile'] = $this->auth->getProfile(
			$this->session->userdata('superadmin_id')
		);

		$this->load->view('super-admin/template', $data);
	}
	public function SaveProposalComment()
	{
		$proposal_id = $this->input->post('proposal_id');

		$comment = $this->input->post('comment');

		// =========================
		// VALIDATION
		// =========================
		if (empty($proposal_id) || empty($comment)) {

			echo json_encode([

				'status'  => false,

				'message' => 'Proposal ID and comment are required.'
			]);

			return;
		}

		// =========================
		// SINGLE COMMENT FILE
		// =========================
		$comment_file = NULL;

		if (!empty($_FILES['comment_file']['name'])) {

			$upload_path = FCPATH . 'uploads/proposal-comments/';

			// Create folder if not exists
			if (!is_dir($upload_path)) {

				mkdir($upload_path, 0755, true);
			}

			// Upload Config
			$config['upload_path']
				= $upload_path;

			$config['allowed_types']
				= 'pdf|doc|docx|jpg|jpeg|png';

			$config['max_size']
				= 5120; // 5MB

			$config['encrypt_name']
				= TRUE;

			$this->load->library('upload');

			$this->upload->initialize($config);

			// Upload File
			if ($this->upload->do_upload('comment_file')) {

				$file_data = $this->upload->data();

				$comment_file = $file_data['file_name'];
			} else {

				echo json_encode([

					'status'  => false,

					'message' => strip_tags(
						$this->upload->display_errors()
					)
				]);

				return;
			}
		}

		// =========================
		// INSERT COMMENT
		// =========================
		$data = [

			'proposal_id' => $proposal_id,

			'comment'     => $comment,

			'comment_file' => $comment_file,

			'created_at'  => date('Y-m-d H:i:s'),
		];

		$insert = $this->db->insert(
			'proposal_comments',
			$data
		);

		// =========================
		// UPDATE PROPOSAL STATUS
		// =========================
		if ($insert) {

			$dataArray = [

				'proposal_status'
				=> $comment,

				'proposal_status_updated_date'
				=> date('Y-m-d'),

				'updated_at'
				=> date('Y-m-d H:i:s')
			];

			$this->ProposalModel->updateLetsComments(
				$dataArray,
				$proposal_id
			);

			echo json_encode([

				'status'  => true,

				'message' => 'Comment added successfully.'
			]);
		} else {

			echo json_encode([

				'status'  => false,

				'message' => 'Failed to add comment.'
			]);
		}
	}
	public function deleteProposalComment($comment_id, $proposal_id)
	{
		if (empty($comment_id)) {
			$this->session->set_flashdata('error', 'Invalid comment ID');
			redirect('super-admin/proposal');
			return;
		}

		$this->db->where('id', $comment_id);
		$deleted = $this->db->delete('proposal_comments');

		if ($deleted) {
			$this->session->set_flashdata('success', 'Comment deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete comment');
		}

		// ✅ redirect to listing page
		redirect('super-admin/proposals/documentdetails/' . $proposal_id);
	}
}
