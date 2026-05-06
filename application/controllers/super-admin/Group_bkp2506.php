<?php
class Group extends CI_controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url','form');
	    $this->load->library('session','database');
		$this->load->model('super-admin/Auth_model','auth');
		$this->load->model('super-admin/Group_model','group_modal');
        $this->load->model('Home_model','Home_model');
		$this->auth->isLoggedIn();
	}
	public function index()
	{
		$data['page'] =  "super-admin/group/index";
		$data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['category_list'] = $this->group_modal->getActGroupCatgory();
		$data['groups'] = $this->group_modal->getAllGroup();

		$this->load->view('super-admin/template',$data);
		
		
	}
    public function sdo_filter($sdo_id)
    {
           
        $data['page'] =  "super-admin/group/sdo-filer-list";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['category_list'] = $this->group_modal->getActGroupCatgory();
        $data['groups'] = $this->group_modal->getAllSDOGroup($sdo_id);
        $data['sdo_data'] = $this->group_modal->getOneGroupCatgory($sdo_id);
        $this->load->view('super-admin/template',$data);



    }
    public function add($group_id)
    {
        $data['page'] =  "super-admin/group/create";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['result'] = $this->group_modal->getOneGroup($group_id);
        $data['category_list'] = $this->group_modal->getActGroupCatgory();
        $data['user_list'] = $this->group_modal->getAllUsers();
        $this->load->view('super-admin/template',$data);
        
        
    }

	public function create()
	{
		
		
		
		if (!empty($_POST) && $this->input->is_ajax_request())
        {
        	//$data['page'] =  "super-admin/group/create";
            $group_id = $this->input->post('group_id');
            $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
            $data['result'] = $this->group_modal->getOneGroup($group_id);
            $data['groupadmin_list'] = $this->group_modal->getAllGroupAdmin();
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
	$group_id = $this->input->post('group_id');
    $group_title = $this->input->post('group_title');
   // $name = "Jake Awesome Whiteman";
    $separate = explode(" ", $group_title);
    $last = array_pop($separate);
    $group_shortform = implode(' ', $separate)." ".$last[0].".";
   
               if(empty($group_id))
                {
                    

                     $data_array = array('category_id' => $this->input->post('category_id'),
                            'group_title' => $this->input->post('group_title'),
                            'group_name' =>  $this->input->post('group_name'),
                            'study_periord' => $this->input->post('study_periord'),
                             'shortform' =>  $this->input->post('group_short_name'),
                            'itu_website_study_group' => $this->input->post('itu_website_study_group'),
                            'group_description' => $this->input->post('group_desription'),
                            'created_at' => date('Y-m-d h:s:i a'));
                	$insert =  $this->group_modal->save_data($data_array);
                    
                    //$gadmins = array();

                    
                   if($insert ===true)
                   {
          	            $response = array('status' => 'success',
                               'message' => 'Group created successfully.');

                        }else
                       {

                        $response = array('status' => 'error',
                               'message' => 'Group not created!');
                    }
                	

                }else{
                	   

                          $data_array = array('category_id' => $this->input->post('category_id'),
                                      'group_title' => $this->input->post('group_title'),
                                      'group_name' =>  $this->input->post('group_name'),
                                      'study_periord' => $this->input->post('study_periord'),
                                      'itu_website_study_group' => $this->input->post('itu_website_study_group'),
                                      'group_description' => $this->input->post('group_desription'),
                                      'shortform' =>  $this->input->post('group_short_name'),
                                      'list_status' => $this->input->post('status'),
                                      'updated_at' => date('Y-m-d h:s:i a'));
                	        $update =  $this->group_modal->update_data($data_array,$group_id);
                           
                            
                           if($update ===true)
                           {
          	                   $response = array('status' => 'success',
                               'message' => 'Group updated successfully.'
                                );

                            }else
                            {

                              $response = array('status' => 'error',
                               'message' => 'Group not updated!');
                            }

                }
                   
          echo json_encode($response);
    }



   public function delete_data()
   {
	  $group_id = $this->input->post('id');

	    $delete = $this->group_modal->delete_data($group_id);
	     echo 'success';
    }
    // Group Category
    public function group_category()
    {
        $data['page'] =  "super-admin/group/group-category";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['groups'] = $this->group_modal->getAllCatgory();
        $this->load->view('super-admin/template',$data);

    }
    public function group_category_add($category_id)
    {
         $data['page'] =  "super-admin/group/create-category";
         $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
         $data['result'] = $this->group_modal->getOneGroupCatgory($category_id);

         $this->load->view('super-admin/template',$data);

    }
    public function save_category_data()
    {
            //error_reporting(0);
    $category_id = $this->input->post('category_id');
   
    
               if(empty($category_id))
                {
                   

                     $data_array = array(
                            'category_name' => $this->input->post('category_name'),
                            'category_description' => $this->input->post('category_description'),
                            'created_at' => date('Y-m-d h:s:i a'));
                    $insert =  $this->group_modal->save_category_data($data_array);
                   

                   if($insert ===true)
                   {
                        $response = array('status' => 'success',
                               'message' => 'SDO created successfully.');

                        }else
                       {

                        $response = array('status' => 'error',
                               'message' => 'SDO not created!');
                    }
                    

                }else{
                    

                          $data_array = array(
                                 'category_name' => $this->input->post('category_name'),
                                 'category_description' => $this->input->post('category_description'),
                                 'list_status' => $this->input->post('status'),
                                 'updated_at' => date('Y-m-d h:s:i a'));
                            $update =  $this->group_modal->update_catgory_data($data_array,$category_id);
                          
                           

                           if($update ===true)
                           {
                               $response = array('status' => 'success',
                               'message' => 'SDO updated successfully.'
                                );

                            }else
                            {

                              $response = array('status' => 'error',
                               'message' => 'SDO not updated!');
                            }

                }
                   
          echo json_encode($response);

    }
    public function delete_category()
    {
        $category_id = $this->input->post('id');

        $delete = $this->group_modal->delete_category($category_id);
        echo 'success';

        
        
        

    }
    //Working Party
     public function working_party($value='')
     {
        $data['page'] =  "super-admin/group/working-party-list";
        $data['profile']= $this->auth->getProfile($this->session->userdata('superadmin_id'));
        $data['groups'] = $this->group_modal->getAllWorkingParty();
        $this->load->view('super-admin/template',$data);
         
     }
     public  function add_working_party($workingparty_id)
     {
        $data['page'] =  "super-admin/group/create-working-party";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['result'] = $this->group_modal->getOneWorkingParty($workingparty_id);
        $data['sdo_list'] = $this->Home_model->getAllSDO(); 
        $this->load->view('super-admin/template',$data);
     }
    public function save_workingparty()
    {

        $workingparty_id = $this->input->post('workingparty_id');
               if(empty($workingparty_id))
                {
                   

                     $data_array = array(
                            'sdo_id' => $this->input->post('sdo_id'),
                            'group_id' => $this->input->post('group_id'),
                            'party_name' => $this->input->post('party_name'),
                            'created_at' => date('Y-m-d h:s:i a'));
                    $insert =  $this->group_modal->save_workingparty_data($data_array);
                   if($insert ===true)
                   {
                        $response = array('status' => 'success',
                               'message' => 'Woking Party created successfully.');

                        }else
                       {

                        $response = array('status' => 'error',
                               'message' => 'Working Party not created!');
                    }
                    

                }else{
                    

                          $data_array = array(
                                  'sdo_id' => $this->input->post('sdo_id'),
                                  'group_id' => $this->input->post('group_id'),
                                  'party_name' => $this->input->post('party_name'),
                                  'workingparty_status' => $this->input->post('status'),
                                 'updated_at' => date('Y-m-d h:s:i a'));
                            $update =  $this->group_modal->update_workingparty_data($data_array,$workingparty_id);
                          
                           

                           if($update ===true)
                           {
                               $response = array('status' => 'success',
                               'message' => 'Working Party updated successfully.'
                                );

                            }else
                            {

                              $response = array('status' => 'error',
                               'message' => 'Working Party not updated!');
                            }

                }
                   
          echo json_encode($response);


    }

    public function delete_workingparty($value='')
    {
          $workingparty_id = $this->input->post('id');

        $delete = $this->group_modal->delete_workingparty($workingparty_id);
         echo 'success';

    }
    public function make_group_manager($group_id='')
    {
          $data['page']    =  "super-admin/group/make-group-manager";
          $data['profile'] = $this->auth->getProfile($this->session->userdata('superadmin_id'));
          $data['user_list'] = $this->group_modal->getAllUsers();
          $data['groups_manager_list'] = $this->group_modal->groupWiseManager($group_id);
          $data['group_details'] = $this->group_modal->getOneGroup($group_id);
          $this->load->view('super-admin/template',$data);
        
    }
    public function save_groupmanager()
    {
        extract($_POST);
        $group_manager = $_POST['group_manager'];
        $grups_id = array('',$group_id);

                    foreach ($group_manager as $key => $field)
                    { 
                       
                        $quer1 = $this->group_modal->checkexitGroupManager($field,$group_id);
                        if($quer1)
                        {
                            $gadmins = array( 
                           'member_id' => $field,
                           'group_id' => $group_id,
                           'created_at' => date('Y-m-d h:s:i a'));
                           $insert1 =  $this->group_modal->updateGroupManagers($gadmins,$field,$group_id);

                           $dataarray = array('user_type'=>'group_manager',
                                               'assign_group_manager'=> 'Y',
                                               'updated_at' => date('Y-m-d h:s:i a'));

                           $update = $this->group_modal->updateGroupManagerDetails($dataarray,$field);


                        }else
                        {
                              $gadmins = array( 
                           'member_id' => $field,
                           'group_id' => $group_id,
                           'updated_at' => date('Y-m-d h:s:i a'));

                           $insert1 =  $this->group_modal->saveGroupManagers($gadmins);
                           $dataarray = array('user_type'=>'group_manager',
                                               'assign_group_manager'=> 'Y',
                                               'updated_at' => date('Y-m-d h:s:i a'));

                            $update = $this->group_modal->updateGroupManagerDetails($dataarray,$field);

                        }
                 
                    }
                    if($insert1 ===true)
                   {
                        $response = array('status' => 'success',
                               'message' => 'Group Manager added successfully.');

                        }else
                       {

                        $response = array('status' => 'error',
                               'message' => 'Group Manager  not added!');
                    }
                    echo json_encode($response);
                    
    }
    public function delete_group_manager()
    {
        $groupmanager_id = $this->input->post('id');

        $delete = $this->group_modal->deleteGroupManager($groupmanager_id);
		if($delete)
		{
			
         echo 'success';
		}
    }
    public function update_group_order()
    {

        $position = $this->input->post('position');
        //$position = $_POST['position'];  
           $goup_order=1;  
               foreach($position as $k=>$v)
               {  
               echo $sql = $this->db->query("Update groups SET display_order=".$goup_order." WHERE group_id=".$v." ");  
               $goup_order++;  
                }  
    }
    public function restore_groups()
    {
        $data['page'] =  "super-admin/group/restore-groups";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['groups_list'] = $this->group_modal->getdeletedGroups();
        $this->load->view('super-admin/template',$data);
        
    }
    public function restore_data()
    {
        $group_id = $this->input->post('id');
        $delete = $this->group_modal->restoreGroup($group_id);
         if($delete)
         {
             echo "true";
         }else
         {
             echo "flase";
         }
    }
    public function restore_sdo()
    {
         $data['page'] =  "super-admin/group/restore-sdo";
        $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
        $data['groups_list'] = $this->group_modal->getdeletedSDo();
        $this->load->view('super-admin/template',$data);
        
    }
    public function updaterestore_sdo()
    {
         $sdo_id = $this->input->post('id');
         $delete = $this->group_modal->restoreSdo($sdo_id);
         if($delete)
         {
             echo "true";
         }else
         {
             echo "flase";
         }
        
    }




}


?>