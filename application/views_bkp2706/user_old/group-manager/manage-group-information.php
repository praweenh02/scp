 <div class="page-heading">
            <h3>
            <?=$group_data->group_title;?>
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
            Group Information List
                <a onclick="get_groupinformation_modal('0','<?=$group_data->group_id;?>');" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Add New
                </a>

           <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm pull-right">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>Title</th>
           
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
    
          
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($workitem_lits as $result2){

            	
              
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                  <td>
                    <?php
                    if($result2->url)
                    {?>
                         <a target="_blank" href="<?=base_url();?>uploads/information/<?=$result2->url;?>"><?=$result2->title;?></a>

                    <?php 
                    }elseif($result2->file) { ?>
                   <a target="_blank" href="<?=base_url();?>uploads/information/<?=$result2->file;?>"><?=$result2->title;?></a>

                   <?php }else {?>

                      <?=$result2->title;?>
                   <?php }

                    ?>
                    
                        
                    </td>
                 
                   <td><?=($result2->group_information_status=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?></td>

                  <td>
                    <button  onclick="get_groupinformation_modal('<?=$result2->group_infornation_id;?>','<?=$result2->group_id;?>');"   class="btn btn-xs btn-primary" title="Edit"><i class="fa 
fa-edit"></i> Edit</button> </td>  
                    <td><button onclick="deleteGroupInformation('<?=$result2->group_infornation_id;?>','<?=$result2->group_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
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


                          



    
