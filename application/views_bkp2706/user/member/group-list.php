 <div class="page-heading">
            <h3>
           New Member Request
            </h3>
            <hr>
                   </div>
                   <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
<div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
                New Member Request
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>SDO</th>
            <th>Group Title</th>
            <th>New User Rquest</th>
    
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($groups as $group_data){

            	$count = $this->db->select('*')->where('group_id',$group_data->group_id)->where('group_manager_recommend_status',NULL)->where('verified_email','Y')->get('users')->num_rows();
                if($count>0)
                 {
                 	$count;

                 }else
                 {
                 	$count =0;

                 }
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                  <td><?=$group_data->category_name;?></td>
                  <td><?=$group_data->group_title;?></td>  
                  <td><a href="member/group_users/<?=$group_data->group_id;?>/" class="btn btn-xs btn-danger">New Request(<?=$count;?>)</a></td> 
                  <td>
                    <a href="member/group_members/<?=$group_data->group_id;?>/" class="btn btn-xs btn-primary" title="Member List"><i class="fa 
fa-eye"></i> Member List</a> </td>  
               </tr>

            <?php $i++; }?>
      
       
       
         </tbody>
        </table>
        </div>
        </div>
      </section>
        </div>
        </div>
      </div>
      

      <div id="popupdiv"></div>

<script src="ajax/usermember.js"></script>


                          



    
