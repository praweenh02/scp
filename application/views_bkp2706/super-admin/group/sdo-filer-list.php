 <div class="page-heading">
            <h3>
                 <?=$sdo_data->category_name;?>
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
            <div class="row">
              <div class="col-md-4">
             <?=$sdo_data->category_name;?> Working Group List
             </div>
              <div class="col-md-4">
                  <form>
                      <select class="form-control" onchange="getSdoId(this.value);"  id="category_id" name="category_id">
                         <option value="" selected disabled>---Select SDO---</option>
                                <?php 
                                 foreach($category_list as $cat_data)
                               {?>
                                  <option value="<?=$cat_data->category_id;?>"><?=$cat_data->category_name;?></option>
                               <?php }?>
                    
                      </select>
                 </form>
             </div>
              <div class="col-md-4">
                  <span class="mb-5 pull-right" >
                        <a  href="super-admin/group/add/0/" class="btn btn-primary btn-sm" >
                           <i class="fa fa-plus"></i> Add New
                       </a>
                   </span>
               </div>
            </div>   
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
            <th>Status</th>
            <th>Group Manager</th>
             <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody id="loadallData" class="row_position">
            <?php
            $i=1;
            foreach ($groups as $group_data)
            {?>
                <tr class="gradeX" id="<?=$group_data->group_id;?>">
                  <td><?=$i;?></td>  
                 
                  <td><?=$group_data->category_name;?></td>
                  <td><?=strip_tags($group_data->group_title);?></td>  
                  <td>
                  <?=$group_data->group_name;?>
                         
                    </td> 
                     <td><?=($group_data->status=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?></td>
                    <td>
                      <a href="super-admin/group/make_group_manager/<?=$group_data->group_id;?>/" class="btn btn-info btn-xs" title="Make group Manager" >Group Manager</button>
                                                           
                    </td>
                    <td><a  href="<?=base_url();?>home/groups/<?=$group_data->category_id;?>?groupId=<?=base64_encode($group_data->group_id);?>" class="btn btn-xs btn-primary" target="_blank"><i class='fa fa-share'></i> View</a></td>
                 
                  <td><a href="super-admin/group/add/<?=$group_data->group_id;?>/"  class="btn btn-xs btn-primary" title="Edit"><i class="fa 
fa-edit"></i> Edit</a></td><td><button onclick="deleteData('<?=$group_data->group_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="ajax/group.js"></script>


                          



    
