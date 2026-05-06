<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        $this->load->helper('url','form');
        $this->load->library('session');
        $this->load->model('Login_model','auth');
        $this->load->model('Home_model','Home_model');
        $this->load->model('Dashboard_model','dash_model');
         $this->load->model('Email_model','email_model');
        $this->auth->isLoggedIn();

    }


    public function index()
    {

        $data['page']   =   "user/emails/index";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['group_list'] = $resut = $this->email_model->getAllWorkingList();
     

        $this->load->view('user/template',$data);

    }
    public function submitemailSubscription()
    {
        //error_reporting(0);
        extract($_POST);
         $profile = $this->auth->getProfile($this->session->userdata('user_id'));
         $email_subscription = $this->input->post('email_subscription');
         if($email_subscription)
         {
              foreach($email_subscription as $updateid)
              {
                   //$sub_value = $_POST['sub_value_'.$updateid];
                    $sub_value = $this->input->post('sub_value_'.$updateid);
                   
                   
            
             
                  $dataarray = array('email_subscription'=>$sub_value);
                                   
                                   
                                    
                 $email_subscription = $this->email_model->UpdateEmail($dataarray, $updateid ,$this->session->userdata('user_id'));

              
              
             
                // code...
          
            
            if($email_subscription)
            {
                $response = array('status' => 'success',
                                //'message' =>'Email subscription successfully'
                                 'message'=> $updateid
                                );

            }else
            {
                $response = array('status' => 'error',
                                'message' =>'Email not subscribe.');
            }

              } 

         }else
         {
             $response = array('status' => 'error',
                                //'message' => $email_subscription
                                'message' =>'At least one Checkbox.'
                                );
         }

         echo json_encode($response);
    }
    
   
}