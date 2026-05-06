<?php
class Datatables_model extends CI_model
{


	public function __construct()
	{
		parent::__construct();
		$this->grpup = 'groups';
		$this->user = 'users';
		$this->question = 'questions';
		$this->superadmin_id = $this->session->userdata('superadmin_id');

   

	}

	public function getAllmenulist()
	{

		return  $this->db->select('*')->where('status','Y')->where('deleted','Y')->order_by('title','ASC')->get('page')->result();
	}
	public function save_data($dataarray)
	{

		return $this->db->insert('datatable',$dataarray);
	}
	public function getAllPagelist()
	{

			return  $this->db->select('*')->order_by('datatable_id','DESC')->get('datatable')->result();
	}
    public function pageDetails($page_id)
    {
       return  $this->db->select('*')->where('deleted','Y')->where('page_id',$page_id)->order_by('page_id','DESC')->get('page')->row();
    }
    public function update_data($dataarray, $page_id)
    {
    	return $this->db->where('page_id',$page_id)->update('page',$dataarray);

    }
    public function delete_data($page_id)
    {
    	return $this->db->where('page_id',$page_id)->set('deleted','N')->update('page');

    }
    public function getPageDetails($page_slug)
    {
    	$query = $this->db->select('*')->where('url',$page_slug)->where('status','Y')->where('deleted','Y')->get('page')->row();
    	return $query;
    }

}


?>