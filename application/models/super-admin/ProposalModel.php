<?php

class ProposalModel extends CI_model {
	public function __construct() {
		parent::__construct();
		$this->table = 'proposals';
		$this->superadmin_id = $this->session->userdata('superadmin_id');
	}
	public function save_proposal($data) {
		$data['superadmin_id'] = $this->superadmin_id;
		if (isset($data['id']) && !empty($data['id'])) {
			// Update existing proposal
			$this->db->where('id', $data['id']);
			return $this->db->update($this->table, $data);
		} else {
			// Insert new proposal
			return $this->db->insert($this->table, $data);
		}
	}
}
