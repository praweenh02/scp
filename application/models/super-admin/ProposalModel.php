<?php

class ProposalModel extends CI_model
{
	protected $table;
	protected $superadmin_id;
	public function __construct()
	{
		parent::__construct();
		$this->table = 'proposals';
		$this->superadmin_id = $this->session->userdata('superadmin_id');
	}
	public function save_proposal($data = array())
	{
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
	public function getProposalList()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('superadmin_id', $this->superadmin_id);
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->result();
	}
	public function getProposalById($proposal_id) {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $proposal_id);
		return $this->db->get()->row();
	}
	public function updateLetsComments($dataArray = [], $proposal_id = 0) {
		$this->db->where('id', $proposal_id);
		$updated = $this->db->update('proposals', $dataArray);

		return $updated;
	}
	public function getProposalCommnetList($proposal_id) {
		$this->db->select('*');
		$this->db->from('proposal_comments');
		$this->db->where('proposal_id', $proposal_id);
		$this->db->order_by('id', 'ASC');
		return $this->db->get()->result();
	}
}
