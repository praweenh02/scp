<?php
class Whatsnew_model extends  CI_model
{
	public function getAllWhatsnew()
	{
		$query = $this->db->select('*')->order_by('whatsnew_id','DESC')->get('whats_new');
		return $query->result();
	}

	public function getOneWhatsnew($whatsnew_id)
	{

		$query = $this->db->select('*')->where('whatsnew_id',$whatsnew_id)->get('whats_new');
		return $query->row();


	}
	public function update_data($dataarray,$whatsnew_id)
	{
		$update = $this->db->where('whatsnew_id',$whatsnew_id)->update('whats_new',$dataarray);
		return $update;

	}
	public function save_data($dataarray)
	{
		$insert = $this->db->insert('whats_new',$dataarray);
		return $insert;

	}
	public  function deleteData($whatsnew_id='')
	{
		$query = $this->db->where('whatsnew_id',$whatsnew_id)->delete('whats_new');
		return $query;
	}

}
?>