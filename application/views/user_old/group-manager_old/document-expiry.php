 <div class="page-heading">
            <h3>
                Upload document  Date Management
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
             Upload document  Date Management
               <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a  href="groupmanager/add_upload_documnt_expiry_date/0/" class="btn btn-primary btn-sm" >
                    <i class="fa fa-plus"></i> Add New
                </a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>Group Title</th>
             <th>Start Date</th>
            <th>Last Date</th>
            <th>Status</th>
             <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($document_list as $group_data)
            {?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                 
                 
                  <td><?=strip_tags($group_data->group_title);?></td>  
                  <td>
                  <?=date("d-m-Y", strtotime($group_data->start_date));?>
                         
                    </td> 
                  <td>
                  <?=date("d-m-Y", strtotime($group_data->end_date));?>
                         
                    </td> 
                     <td><?=($group_data->status=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?></td>
                   
                 
                  <td><a href="groupmanager/add_upload_documnt_expiry_date/<?=$group_data->documentexpirydate_id ;?>/"  class="btn btn-xs btn-primary" title="Edit"><i class="fa 
fa-edit"></i> Edit</a></td><td><button onclick="deleteData('<?=$group_data->documentexpirydate_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
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

<script src="ajax/user-group-manager.js"></script>


                          



    
