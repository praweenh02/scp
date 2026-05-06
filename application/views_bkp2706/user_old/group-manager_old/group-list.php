 <div class="page-heading">
            <h3>
            Our Group List
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
              Our Group List
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>SDO</th>
            <th>Group Title</th>
            <th>Group Name</th>
            <th>View</th>
            <th>Edit</th>
    
          
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($groups as $group_data){

            	$count = $this->db->select('*')->where('group_id',$group_data->group_id)->where('group_manager_recommend_status','N')->where('verified_email','Y')->get('users')->num_rows();
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
                 <td><?=$group_data->group_name;?></td>
                  <td><a  href="<?=base_url();?>home/groups/<?=$group_data->category_id;?>?groupId=<?=base64_encode($group_data->group_id);?>" class="btn btn-xs btn-primary" target="_blank"><i class='fa fa-share'></i> View</a></td>
                  <td>
                    <a href="groupmanager/groupedit/<?=$group_data->group_id;?>/" class="btn btn-xs btn-primary" title="Edit"><i class="fa 
fa-edit"></i> Edit</a> </td>  
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


                          



    
