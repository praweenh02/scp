<?php
class Footer extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session','database');
		$this->load->model('super-admin/Auth_model','auth');
		$this->load->model('super-admin/Footer_model','footer');
		$this->load->model('Home_model','Home_model');
		$this->auth->isLoggedIn();
	}
	public function index()
	{
		$data['page'] =  "super-admin/footer/index";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['footer'] = $this->footer->getFooter();
		$this->load->view('super-admin/template',$data);
		
		
	}
    public function add($question_id='')
    {
        $data['page'] =  "super-admin/question/create";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['sdo_list'] = $this->Home_model->getAllSDO(); 
        $data['result'] = $this->que_model->getOneQuestion($question_id);
        $this->load->view('super-admin/template',$data);
        
        
    }

	public function create()
	{
		
		
		
		if (!empty($_POST) && $this->input->is_ajax_request())
        {
        	//$data['page'] =  "super-admin/group/create";
            $group_id = $this->input->post('group_id');
            $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
            $data['result'] = $this->que_model->getOneGroup($group_id);
            $data['groupadmin_list'] = $this->que_model->getAllGroupAdmin();
            $this->load->view('super-admin/group/create',$data);

        }
		
		
	}

	public function profile()
	{
		$data['page'] =  "super-admin/profile";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$this->load->view('super-admin/template',$data);
		
		
	}
	
	//Change the Password
	public function save_data()
	{
       
        extract($_POST);
        if($footer_id)
        {
             $dataraya = array('section_1' => $section_1,
                           'section_2' => $section_2,
                             'section_3' => $section_3,
                            'section_4' => $section_4,
                             'created_at' => date('Y-m-d H:i:s'));

       $insert = $this->footer->updateFooter($dataraya,$footer_id);

        }else{
             $dataraya = array('section_1' => $section_1,
                           'section_2' => $section_2,
                             'section_3' => $section_3,
                            'section_4' => $section_4,
                             'created_at' => date('Y-m-d H:i:s'));

       $insert = $this->footer->insertFooter($dataraya);

        }
      
       if($insert)
       {

        $response = array('status' => 'success',
                           'message' => 'Footer update successfully.');
       }else
       {
        $response = array('status' => 'error',
                           'message' => 'Footer  not update.');

       }
       echo json_encode($response);
   
              
    }



   public function delete_data()
   {
	  $question_id = $this->input->post('id');

	    $delete = $this->que_model->delete_data($question_id);
	     echo 'success';
    }
    // Group Category
    public function group_category()
    {
        $data['page'] =  "super-admin/group/group-category";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['groups'] = $this->que_model->getAllCatgory();
        $this->load->view('super-admin/template',$data);

    }
    public function group_category_add($category_id)
    {
         $data['page'] =  "super-admin/group/create-category";
         $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
         $data['result'] = $this->que_model->getOneGroupCatgory($category_id);

         $this->load->view('super-admin/template',$data);

    }
   
    public function delete_category()
    {
        $category_id = $this->input->post('id');

        $delete = $this->que_model->delete_category($category_id);
         echo 'success';

        
        
        

    }




}


?>