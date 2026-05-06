 <div class="page-heading">
            <h3>
            Member List
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
            Member List
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th class="numeric">Sr.No.</th>
            <th>Full Name</th>
            <th>Email</th>
            <th class="numeric">Contact No.</th>
            <th>Group</th>
            <th>User Type.</th>
            <th>Status</th>
            <th>Change Password</th>
            <th>View</th>
            
            
            
            <th>Delete</th>
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($groups as $group_data)
            {?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                  <td><?=$group_data->name;?> <?=$group_data->surname;?></td>
                  <td><?=$group_data->email;?></td>  
                  <td><?=$group_data->contact_no;?></td> 
                  <td><?=$group_data->shortform;?></td>
                  <td><?=str_replace('_',' ',ucfirst($group_data->user_type));?></td>
                  <td><?=($group_data->status1=='Y')?  '<span class="btn-success btn-xs">Active</span>': '<span class="btn-danger btn-xs">Inactive</span>' ?></td>
                
                  <td>
                    <a href="super-admin/member/view_change_password/<?=$group_data->user_id;?>/" class="btn btn-xs btn-info" title="View">Change Password</a></td>
                   <td>
                    <a href="super-admin/member/view_member_list/<?=$group_data->user_id;?>/" class="btn btn-xs btn-primary" title="View"><i class="fa 
fa-eye"></i> View</a></td>
<td>

 <button onclick="deleteMember('<?=$group_data->user_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i> Delete</button></td>  
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

<script src="ajax/member.js"></script>


                          



    
