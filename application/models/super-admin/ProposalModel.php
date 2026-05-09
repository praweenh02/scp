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
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get()->result();
	}
}
