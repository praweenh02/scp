<?php
class Auth_model extends CI_model
{
    
    public function login($email,$hashpassword)
    {
        
        $this->db->select("*");
        $this->db->where('username',$email);
        $this->db->where('password',$hashpassword);
        //$this->db->where('type',$type);
        $query = $this->db->get('super_admin');
        return $query->row();
    }
    
    public function isLoggedIn(){
            header("cache-Control: no-store, no-cache, must-revalidate");
            header("cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
            $is_logged_in = $this->session->userdata('superadmin_id');
            

            if(!isset($is_logged_in) || empty($is_logged_in))
            {
                redirect('admin/');
                exit;
            }
    }
    
    public function getProfile($company_id)
    {
        $query  = $this->db->select('*')->where('superadmin_id',$company_id)->where('status','Y')->from('super_admin')->get();
        return $query->row();
    }
    
    
}
?>