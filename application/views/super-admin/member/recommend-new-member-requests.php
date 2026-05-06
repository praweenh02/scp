 <div class="page-heading">
            <h3>
                New Recommend Member Request List
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
           New Recommend Member Request List
         
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
            <th>SDO Name</th>
            <th>Group Name</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($groups as $group_data)
            {?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                  <td><?=$group_data->name;?></td>
                  <td><?=$group_data->email;?></td>  
                  <td><?=$group_data->contact_no;?></td> 
                   <td><?=$group_data->category_name;?></td>
                   <td><?=$group_data->group_title;?></td> 
                  
                   <td>
                    <a href="super-admin/member/view_recommend_user_details/<?=$group_data->user_id;?>/" class="btn btn-xs btn-success" title="View"><i class="fa 
fa-eye"></i> View</a> <button onclick="deleteData('<?=$group_data->user_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
fa-trash-o"></i> Delete</button></td>  
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

<script src="ajax/coordinator.js"></script>


                          



    
