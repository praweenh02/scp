<?php
class Page extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session','database');
		$this->load->model('super-admin/Auth_model','auth');
		$this->load->model('super-admin/Dashboard_model','dash_model');
        $this->load->model('super-admin/Page_model','page_model');
		$this->auth->isLoggedIn();
	}
	public function index()
	{
		$data['page'] =  "super-admin/page/index";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['page_list'] = $this->page_model->getAllPagelist();
		$this->load->view('super-admin/template',$data);
		
		
	}
	public function create($page_id='')
	{
		$data['page'] =  "super-admin/page/create";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['menu_list'] = $this->page_model->getAllmenulist();
		$data['result'] = $this->page_model->pageDetails($page_id);
		$this->load->view('super-admin/template',$data);
		
		
	}
	public function view($page_slug)
	{
		$data['page'] =  "super-admin/page/view";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['menu_list'] = $this->page_model->getAllmenulist();
		$this->load->view('super-admin/template',$data);
		
		
	}
	public function save_data()
	{
    //error_reporting(0);
	$page_id = $this->input->post('page_id');
    // $num_padded = sprintf("%02d", $this->input->post('group_admin'));
    $url =url_title($this->input->post('title'), '-', true);
               if(empty($page_id))
                {
                    

                     $dataarray = array('show_at_nav' => $this->input->post('show_at_nav'),
                                          'title' => $this->input->post('title'),
                                          'parent_id' => $this->input->post('parent_id'),
                                          'url' => $url,
                                           'status' => 'Y',
                                           'deleted' =>'Y',
                                           'description' => $this->input->post('description'),
                                           'created_at' => date('Y-m-d h:s:i a'));
                	$insert =  $this->page_model->save_data($dataarray);
                   if($insert ===true)
                   {
          	            $response = array('status' => 'success',
                               'message' => 'Page created successfully.');

                        }else
                       {

                        $response = array('status' => 'error',
                               'message' => 'Page  not created!');
                    }
                	

                }else{
                	   

                                $dataarray = array('show_at_nav' => $this->input->post('show_at_nav'),
                                          'title' => $this->input->post('title'),
                                          'parent_id' => $this->input->post('parent_id'),
                                          'url' => $url,
                                           'status' => 'Y',
                                           'deleted' =>'Y',
                                           'description' => $this->input->post('description'),
                                             'status' => $this->input->post('status'),
                                              'updated_at' => date('Y-m-d h:s:i a'));
                	        $update =  $this->page_model->update_data($dataarray,$page_id);
                            

                           if($update ===true)
                           {
          	                   $response = array('status' => 'success',
                               'message' => 'Page details  updated successfully'
                                );

                            }else
                            {

                              $response = array('status' => 'error',
                               'message' => 'Page not updated!');
                            }

                }
                   
          echo json_encode($response);
    }
    public function delete_data()
    {
    	$page_id = $this->input->post('id');

	    $delete = $this->page_model->delete_data($page_id);
        if($delete)
        {
            
	     echo 'success';
        }
    }


}


?>