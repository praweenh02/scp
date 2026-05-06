<?php
class Faq extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session','database');
		$this->load->model('super-admin/Auth_model','auth');
		$this->load->model('super-admin/Faq_model','faq_model');
		$this->load->model('Home_model','Home_model');
		$this->auth->isLoggedIn();
	}
	public function index()
	{
		$data['page'] =  "super-admin/faq/index";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
		$data['groups'] = $this->faq_model->getAllQuestion();
		$this->load->view('super-admin/template',$data);
		
		
	}
    public function add($question_id='')
    {
        $data['page'] =  "super-admin/faq/create";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['sdo_list'] = $this->Home_model->getAllSDO(); 
        $data['result'] = $this->faq_model->getOneQuestion($question_id);
        $this->load->view('super-admin/template',$data);
        
        
    }

	public function create()
	{
		
		
		
		if (!empty($_POST) && $this->input->is_ajax_request())
        {
        	//$data['page'] =  "super-admin/group/create";
            $group_id = $this->input->post('group_id');
            $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
            $data['result'] = $this->faq_model->getOneGroup($group_id);
            $data['groupadmin_list'] = $this->faq_model->getAllGroupAdmin();
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
    //error_reporting(0);
	$faq_id = $this->input->post('faq_id');
    // $num_padded = sprintf("%02d", $this->input->post('group_admin'));
   
               if(empty($faq_id))
                {
                    

                     $data_array = array('faq_question' => $this->input->post('faq_question'),
                                          'faq_answer' => $this->input->post('faq_answer'),
                                          'faq_question_hindi' => $this->input->post('faq_question_hindi'),
                                           'faq_answer_hindi' => $this->input->post('faq_answer_hindi'),
                                              'created_at' => date('Y-m-d h:s:i a'));
                	$insert =  $this->faq_model->save_data($data_array);
                   if($insert ===true)
                   {
          	            $response = array('status' => 'success',
                               'message' => 'FAQ added successfully.');

                        }else
                       {

                        $response = array('status' => 'error',
                               'message' => 'FAQ  not added!');
                    }
                	

                }else{
                	   

                                  $data_array = array('faq_question' => $this->input->post('faq_question'),
                                                       'faq_answer' => $this->input->post('faq_answer'),
                                                        'faq_question_hindi' => $this->input->post('faq_question_hindi'),
                                                        'faq_answer_hindi' => $this->input->post('faq_answer_hindi'),
                                                'faq_status' => $this->input->post('status'),
                                                  'updated_at' => date('Y-m-d h:s:i a'));
                	        $update =  $this->faq_model->update_data($data_array,$faq_id);
                            

                           if($update ===true)
                           {
          	                   $response = array('status' => 'success',
                               'message' => 'FAQ  updated successfully'
                                );

                            }else
                            {

                              $response = array('status' => 'error',
                               'message' => 'FAQ not updated!');
                            }

                }
                   
          echo json_encode($response);
    }



   public function delete_data()
   {
	  $faq_id = $this->input->post('id');

	    $delete = $this->faq_model->delete_data($faq_id);
        if($delete)
        {
            
	     echo 'success';
        }
    }
    // Group Category
    public function group_category()
    {
        $data['page'] =  "super-admin/group/group-category";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['groups'] = $this->faq_model->getAllCatgory();
        $this->load->view('super-admin/template',$data);

    }
    public function group_category_add($category_id)
    {
         $data['page'] =  "super-admin/group/create-category";
         $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
         $data['result'] = $this->faq_model->getOneGroupCatgory($category_id);

         $this->load->view('super-admin/template',$data);

    }
   
    public function delete_category()
    {
        $category_id = $this->input->post('id');

        $delete = $this->faq_model->delete_category($category_id);
         echo 'success';

        
        
        

    }




}


?>