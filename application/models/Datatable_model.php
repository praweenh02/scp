<?php
class Datatable_model extends CI_model
{



	var $table = 'datatable';
	var $column_order = array(null, 'key_area','sg','work_item','subject_title','que_no','tsdsi_tec_both','tec_nwg_status','tec_remarks_title_use_case_of_wg','tsdsi_status','tsdsi_remarks_title_use_case_of_wg','orgn','name','email','global_contribution','status','timing','approval_process','version','liaison_relationship','priority'); //set column field database for datatable orderable
	var $column_search = array('key_area','sg','work_item','subject_title','que_no','tsdsi_tec_both','tec_nwg_status','tec_remarks_title_use_case_of_wg','tsdsi_status','tsdsi_remarks_title_use_case_of_wg','orgn','name','email','global_contribution','status','timing','approval_process','version','liaison_relationship','priority'); //set column field database for datatable searchable 
	var $order = array('datatable_id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		//add custom filter here
		if($this->input->post('key_area'))
		{
			$this->db->where('key_area', $this->input->post('key_area'));
		}
		if($this->input->post('sg'))
		{
			$this->db->like('sg', $this->input->post('sg'));
		}
		if($this->input->post('work_item'))
		{
			$this->db->like('work_item', $this->input->post('work_item'));
		}
		if($this->input->post('subject_title'))
		{
			$this->db->like('subject_title', $this->input->post('subject_title'));
		}
		if($this->input->post('que_no'))
		{
			$this->db->like('que_no', $this->input->post('que_no'));

		}

		$this->db->from($this->table);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_list_key_area()
	{
		$this->db->select('key_area');
		$this->db->from($this->table);
		$this->db->order_by('key_area','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row) 
		{
			$countries[] = $row->key_area;
		}
		return $countries;
	}
	public function get_list_sg()
	{
		$this->db->select('sg');
		$this->db->from($this->table);
		$this->db->order_by('sg','asc');
		$query = $this->db->get();
		$result = $query->result();

		$sgs = array();
		foreach ($result as $row) 
		{
			$sgs[] = $row->sg;
		}
		return $sgs;
	}
	public function get_list_que()
	{
		$this->db->select('que_no');
		$this->db->from($this->table);
		$this->db->order_by('que_no','asc');
		$query = $this->db->get();
		$result = $query->result();

		$que_no = array();
		foreach ($result as $row) 
		{
			$que_no[] = $row->que_no;
		}
		return $que_no;

	}


	

}


?>