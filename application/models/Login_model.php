<?php
class Login_model extends CI_model
{
    
    public function login($email,$hashpassword)
    {
        
        $this->db->select("*");
        $this->db->where('email',$email);
        $this->db->where('password',$hashpassword);
        //$this->db->where('type',$type);
        $query = $this->db->get('users');
        return $query->row();
    }
    
    public function isLoggedIn(){
            //header("cache-Control: no-store, no-cache, must-revalidate");
            //header("cache-Control: post-check=0, pre-check=0", false);
           // header("Pragma: no-cache");
           // header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
            $is_logged_in = $this->session->userdata('user_id');
            

            if(!isset($is_logged_in) || empty($is_logged_in))
            {
                redirect('login/');
                exit;
            }
    }
    
    public function getProfile($coordinator_id)
    {
        $query  = $this->db->select('users.*, category.category_name, groups.group_title')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','left')->where('users.user_id',$coordinator_id)->where('users.status','Y')->from('users')->get();
        return $query->row();
    }
    public function change_user_type($user_id,$user_email,$user_type)
    {

       $update =  $this->db->where('user_id',$user_id)->where('email',$user_email)->set('user_type',$user_type)->update('users');
       if($update){
                 $query =   $this->db->select('*')->where('user_id',$user_id)->where('email',$user_email)->get('users')->row();
                 return  $query;

       }else
       {

        return FALSE;
       }
      
    }
    public function updateProfile($value,$user_id)
    {
        return $this->db->where('user_id',$user_id)->update('users',$value);
    }

    
    
}
?>