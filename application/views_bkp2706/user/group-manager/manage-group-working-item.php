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
             Work  Item List
                <a onclick="get_workingitem_modal('0','<?=$group_data->group_id;?>');" class="btn btn-primary btn-sm">
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
            <th>Q/no</th>
           
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
    
          
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($workitem_lits as $result2){

            	$row = $this->db->select('*')->where('question_id',$result2->question_id)->get('questions')->row();
              
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                <td><?=$result2->work_item;?></td>
                  <td><?=$row->question_no;?></td>
                  
                 
                   <td><?=($result2->work_item_status=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?></td>

                  <td>
                    <button  onclick="get_workingitem_modal('<?=$result2->workitem_id;?>','<?=$result2->group_id;?>');"   class="btn btn-xs btn-primary" title="Edit"><i class="fa 
fa-edit"></i> Edit</button> </td>  
                    <td><button onclick="deleteWorkItem('<?=$result2->workitem_id;?>','<?=$result2->group_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
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


                          



    
