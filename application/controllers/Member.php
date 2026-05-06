<?php
class Member extends CI_controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('url','form');
      $this->load->library('session','database');
      $this->load->model('Login_model','auth');
      $this->load->model('Member_model','member_modal');
      $this->auth->isLoggedIn();
      


  }
  public function index()
  {
    $data['page'] =  "user/member/group-list";
    $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
    //$data['my_groups'] $ = $this->member_modal->getAllMyGroups($this->session->userdata('user_id'));
    $data['groups'] = $this->member_modal->getAllMyGroups($this->session->userdata('user_id'),$this->session->userdata('group_id'));
    $this->load->view('user/template',$data);


}

public function group_users($group_id)
{
    $data['page'] =  "user/member/member-list";
    $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
    $data['group_data']  = $this->member_modal->getActGroup($group_id);
    $data['groups'] = $this->member_modal->getAllMember($group_id);
    $this->load->view('user/template',$data);


}
public  function group_members($group_id)
{
    $data['page'] =  "user/member/group-member-list";
    $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
    $data['group_data']  = $this->member_modal->getActGroup($group_id);
    $data['member_list'] = $this->member_modal->getAllGroupMember($group_id);
    $this->load->view('user/template',$data);
     // code...
}
public function view_member_list($user_id='')
{
    $data['page'] =  "user/member/view-member-details";
    $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
    $data['result'] = $this->member_modal->getrecommeduserDetails($user_id);
    $this->load->view('user/template',$data);
}



public function make_group_manager($user_id='')
{
    $data['page'] =  "super-admin/member/make-group-manager";
    $data['profile']= $this->auth->getProfile($this->session->userdata('user_id'));
    $data['result'] = $this->member_modal->getrecommeduserDetails($user_id);
    $data['group_category'] = $this->member_modal->getAllSDO();
    $this->load->view('super-admin/template',$data);
}
public  function getAllGroups()
{
    $category_id = $this->input->post('category_id');
    $working_group = $this->member_modal->getAllWorkingGroup($category_id);
    $output ='';
    $output .='<option value="">----Select Working Group----</option>';

    foreach($working_group as $wrd_grup):

     $output .='<option value='.$wrd_grup->group_id.'>'.$wrd_grup->group_title.'</option>';


 endforeach;
 echo $output;
}
public function recommend_superAdmin()
{
    
   extract($_POST);
   $member_id = $this->input->post('member_id');
   $email = $this->input->post('email');
   $rows = $this->db->select('*')->where('email',$email)->where('user_id',$member_id)->get('users')->row();
   $gm_rows = $this->db->select('*')->where('group_id',$rows->group_id)->get('groups')->row();
   if($group_manager_recommend_status=='N')
    {

                       //$delete = $this->db->where('user_id',$member_id)->where('email',$email)->delete('users');
         //$this->load->library('phpmailer_lib');
          
        // PHPMailer object
        // $mail = $this->phpmailer_lib->load();
          require_once(APPPATH.'third_party/email/class.phpmailer.php');
            $mail = new PHPMailer();
         
        // SMTP configuration
         $mail->isSMTP();
          $current_url = $_SERVER['SERVER_NAME'];
         if($current_url=='tec1.dssolution.in')
         {
          $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@dssolution.in';
        $mail->Password = 'AdminNew@#$1234';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        $mail->setFrom('info@dssolution.in', 'Standards Coordination Portal');
        $mail->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
         }else
         {
                // SMTP configuration For Tec.gov
                 $mail->isSMTP();
        $mail->Host     = 'relay.nic.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'adic1.tec@gov.in';
        $mail->Password = 'Stec#2020';
        $mail->SMTPSecure = 'tls';
        $mail->CharSet = 'UTF-8';
        $mail->Port     = 25;
        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
        //$mail->isHTML(true);
             
         } 
         $mail->isHTML(true);
        // Add a recipient
         $mail->addAddress($email);

         $mail->Subject = '['.$gm_rows->shortform.'] signup '.$rows->name.' '.$rows->surname.' - Standards Coordination Portal';

        // Email body content
         //$mailContent = "<h3>Dear ".$rows->name."&nbsp;".$rows->surname." </h3>
         $mailContent ="<h3>Dear Sir/Madam,</h3><br>
<p>Your new account request has been rejected by your Group Admin. 
If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback<p>
         <p>With best regards,<br>
         <strong>TEC Standards Coordination Portal  Management Service.</strong></p>";
         $mail->Body = $mailContent;
         $mail->send();
         $data_array = array('group_manager_recommend_status'=>$group_manager_recommend_status,
             'updated_at' => date('Y-m-d h:s:i a'));
         $update1 =  $this->member_modal->update_data($data_array,$member_id);
         if($update1===true)
         {
            $response = array('status' => 'success',
               'message' => 'New account request has been rejected!');

        }else
        {
            $response = array('status' => 'error',
               'message' => 'Data not updated.');

        }

    }else
    {
       //email
     // $this->load->library('phpmailer_lib');

        // PHPMailer object
      //$mail = $this->phpmailer_lib->load();
        require_once(APPPATH.'third_party/email/class.phpmailer.php');
            $mail = new PHPMailer();

        // SMTP configuration
      $mail->isSMTP();
       $current_url = $_SERVER['SERVER_NAME'];
      if($current_url=='tec1.dssolution.in')
      {
            $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@dssolution.in';
        $mail->Password = 'AdminNew@#$1234';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        $mail->setFrom('info@dssolution.in', 'Standards Coordination Portal');
        $mail->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
      }else
      {
             // SMTP configuration For Tec.gov
                  // $mail->isSMTP();
        $mail->Host     = 'relay.nic.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'adic1.tec@gov.in';
        $mail->Password = 'Stec#2020';
        $mail->SMTPSecure = 'tls';
        $mail->CharSet = 'UTF-8';
        $mail->Port     = 25;
        $mail->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
          
      } 

      $mail->isHTML(true);

       // Add a recipient
      $mail->addAddress($email);

      $mail->Subject = '['.$gm_rows->shortform.'] signup '.$rows->name.' '.$rows->surname.' - Standards Coordination Portal';

        // Email body content
      $mailContent = "<h3>Dear Sir/Madam,<h3><br>
<p>Your new account request has been recommended by your Group Admin to the Portal Admin.
If you require any further assistance, please contact your focal point at adgcb.tec-dot@gov.in or  visit www.tec.gov.in/scp/feedback
</p><p>
      With best regards,<br>
      <strong>TEC Standards Coordination Portal  Management Service.</strong></p>";
      $mail->Body = $mailContent;
      $mail->send();
      //Group Admin
      $group_admin = $this->db->select('group_managers.*,users.*')->join('users','group_managers.member_id=users.user_id','left')->where('group_managers.group_id',$rows->group_id)->get('group_managers');
      
        foreach($group_admin->result() as $gm_result)
        {
        // SMTP configuration
        //$mail1 = $this->phpmailer_lib->load();
        require_once(APPPATH.'third_party/email/class.phpmailer.php');
            $mail1 = new PHPMailer();
        $mail1->isSMTP();
         $current_url = $_SERVER['SERVER_NAME'];
    if($current_url=='tec1.dssolution.in')
         {
            $mail1->Host = 'smtp.hostinger.com';
        $mail1->SMTPAuth = true;
        $mail1->Username = 'info@dssolution.in';
        $mail1->Password = 'AdminNew@#$1234';
        $mail1->SMTPSecure = 'ssl';
        $mail1->Port     = 465;
        $mail1->setFrom('info@dssolution.in', 'Standards Coordination Portal');
        $mail1->addReplyTo('info@dssolution.in', 'Standards Coordination Portal');
         }else
         {
                // SMTP configuration For Tec.gov
                       //$mail->isSMTP();
        $mail1->Host     = 'relay.nic.in';
        $mail1->SMTPAuth = true;
        $mail1->Username = 'adic1.tec@gov.in';
        $mail1->Password = 'Stec#2020';
        $mail1->SMTPSecure = 'tls';
        $mail1->CharSet = 'UTF-8';
        $mail1->Port     = 25;
        $mail1->setFrom('noreply.tec-dot@gov.in', 'Standards Coordination Portal');
        $mail1->addReplyTo('admin.tec@gov.in', 'Standards Coordination Portal');
             
         } 
        $mail1->isHTML(true);
        
       // Add a recipient
        $mail1->addAddress($gm_result->email);
        
        $mail1->Subject = '['.$gm_rows->shortform.'] signup '.$rows->name.' '.$rows->surname.' - Standards Coordination Portal';
        
        // Email body content
        //$mailContent = "<h3>Dear ".$rows->name."&nbsp;".$rows->surname."</h3>
            $mailContent1="<h3>Dear Sir/Madam,</h3><br>
            <p>A new member request has been received. It is requested to take necessary action please.</p>
 <p>With best regards,<br><strong>TEC Standards Coordination Portal  Management Service.</strong></p>";
        $mail1->Body = $mailContent1;
        $mail1->send();
        }
        

      $data_array = array('group_manager_recommend_status'=>$group_manager_recommend_status,
         'updated_at' => date('Y-m-d h:s:i a'));
      $update1 =  $this->member_modal->update_data($data_array,$member_id);
       if($update1===true)
        {
          $response = array('status' => 'success',
           'message' => 'Recommend successfully.');

       }else
       {
        $response = array('status' => 'error',
           'message' => 'Data not updated.');

        }
    }
    echo json_encode($response);
}


}


?>