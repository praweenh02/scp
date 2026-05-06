<?php 
class Api_model extends CI_model
{


   public function getLogin($mobile_no,$hashpassword)
    {
        
        $this->db->select("*");
        $this->db->where('contact_no',$mobile_no);
        $this->db->where('password', md5($hashpassword));
        //$this->db->where('type',$type);
        $query = $this->db->get('coordinator');
        return $query->row();
    }
      public function getAllgroup($groupadmin_id)
    {
        //$num_padded = sprintf("%02d", $groupadmin_id);
       
        $this->db->select('max(chatting.chatting_id) as maxchatting_id,groups.group_id,groups.group_title,groups.group_desription,groups.group_icon as group_icon ,groups.group_total_users, message_count.messagecount as messagecount,groups.created_at as created_at,chatting.message  as last_message, chatting.created_at as last_message_date, chatting.message_type as message_type, chatting.sender_id as sender_id, chatting.chatting_id as chatting_id');
        $this->db->join('message_count','groups.group_id= message_count.group_id','INNER');
          $this->db->join('chatting','groups.group_id=chatting.group_id','left',false);
        
          //$this->db->from('groups');
          $this->db->where('message_count.uniqu_id',$groupadmin_id);
          $this->db->like('groups.group_admin', $groupadmin_id);
          $this->db->group_by('chatting.group_id');
          if(last_message_date!==NULL)
          {
              $this->db->order_by('chatting.created_at','DESC');
          }else
          {
               $this->db->order_by('groups.created_at','DESC');
          }
          $query = $this->db->get('groups');
          return $query;
         
           

    }
    public function changePassword($groupadmin_id,$old_password,$new_password)
    {

       $result = $this->db->select('*')->where('password',md5($old_password))->where('coordinator_id',$groupadmin_id)->get('coordinator')->row();

       if($result)
       {
          $update = $this->db->set('password',md5($new_password))->where('coordinator_id',$groupadmin_id)->update('coordinator');

             return TRUE;
       }else
       {

             return FALSE;
       }

    }
       public function InsertMessage($dataarray)
    {
      $insert = $this->db->insert('chatting',$dataarray);
      return $insert;

    }
    public function getGroupuserlist($group_id)
    {

      $this->db->select('group_admin');
      $this->db->where('group_id',$group_id);
      $query = $this->db->get('groups');
     $rows =  $query->row();

     $uniqeId = explode(',', $rows->group_admin);

     $this->db->select('name,father_name,mother_name,uniquId,user_type,profile_image');
     $this->db->where_in('uniquId', $uniqeId);
     $query1 = $this->db->get('coordinator');
     return $query1->result();



    }
    public function getchattingHistory($group_id)
    {
        $this->db->select('coordinator.name as user_name,chatting.chatting_id,chatting.sender_id,chatting.group_id,chatting.message_type,chatting.message,chatting.image,chatting.created_at');
        $this->db->join('coordinator','chatting.sender_id=coordinator.coordinator_id','LEFT');
        $this->db->where('chatting.group_id',$group_id);
        $this->db->where('chatting.status','Y');
        //$this->db->order_by('chatting.chatting_id','DESC');
        $query = $this->db->get('chatting');
        return $query;
        
    }
    
    public function messagecount($user_id,$group_id,$unique_id,$message_count)
    {
       $count =  $this->db->select('*')->where('user_id',$user_id)->where('group_id',$group_id)->get('message_count')->num_rows();
       
       if($count==0)
       {
           $insert = $this->db->set('user_id',$user_id)->set('group_id',$group_id)->set('messagecount',$message_count)->set('uniqu_id',$unique_id)->set('created_at',date('Y-m-d h:s:i a'))->insert('message_count');
           
       }else{
            $insert = $this->db->where('user_id',$user_id)->where('group_id',$group_id)->set('messagecount',$message_count)->set('uniqu_id',$unique_id)->set('created_at',date('Y-m-d h:s:i a'))->update('message_count');
           
           
       }
       return $insert;
        
    }
    
    
    
}



?>