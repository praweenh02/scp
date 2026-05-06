 <div class="page-heading">
            <h3>
            Group Manager List
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
           Group Manager List
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Contact No.</th>
            <th>Group</th>
            <th>Status</th>
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
                  <td><?=($group_data->status1=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?></td>
                   
                  <td><button  onclick="removeGroupManager('<?=$group_data->groupmanager_id;?>','<?=$group_data->group_id;?>');" class="btn btn-xs btn-danger" title="Remove group Manager<"> <i class="fa 
fa-trash-o"></i> Delete </button></td>
                  
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


                          



    
