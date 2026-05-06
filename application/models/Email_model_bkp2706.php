<?php
class Email_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'groups';
		$this->table1 = 'document_expiry_date';
		$this->user_id = $this->session->userdata('user_id');
		

   

	}

	public function getAllWorkingList()
	{
	    $user_id = $this->session->userdata('user_id');
	    $profile = $this->db->select('*')->where('user_id',$user_id)->get('users')->row();
		$query = $this->db->select('groups.shortform,groups.group_title,group_id,groups.category_id')->join('category','groups.category_id=category.category_id','left')->where('groups.status','Y')->get('groups');
	//	$result =  $query->result();
		$i=1;
		foreach($query->result() as $rows)
		{
		    $group_id = $rows->group_id;
		    $sdo_id = $rows->category_id;
		    $alreadytaken= $this->db->select('*')->where('user_id',$user_id)->where('group_id',$group_id)->where('sdo_id',$sdo_id)->get('email_subscription')->num_rows();
		   if($alreadytaken==0)
		   {
		       $dataarray = array('group_id' => $group_id,
		                            'sdo_id' => $sdo_id,
                                    'email_subscription'=> NULL,
                                    'user_id' => $this->session->userdata('user_id'),
                                    'user_email' => $profile->email,
                                    'user_type'=>'group_member',
                                    'email_subscription'=>'N',
                                    'create_at' => date('Y-m-d H:i:s'));
                                 
                                    
                                    $insert = $this->db->insert(' email_subscription',$dataarray);
                                        $i++;
                                       
                                  
		        
		   }
		   
		   
		    
		    
		}
	    $query = $this->db->select('*')->join('groups','email_subscription.group_id=groups.group_id','left')->where('user_id',$user_id)->get('email_subscription')->result();
	    return $query;


	}
	public function insertEmail($arraydata)
	{
		return $this->db->insert('email_subscription',$arraydata);
	}
	public function CheckgroupIdexit($emai_subscription_id,$user_id)
	{
		$query = $this->db->select('*')->where('emai_subscription_id',$emai_subscription_id)->where('user_id',$user_id)->get('email_subscription')->num_rows();
		return $query;

	}
	public function UpdateEmail($dataarray, $emai_subscription_id,$user_id)
	{
		$update = $this->db->where('emai_subscription_id',$emai_subscription_id)->where('user_id',$user_id)->update('email_subscription',$dataarray);
		return $update;

	}
}



?>