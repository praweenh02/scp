<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
               <?=$group_details->group_title;?>
            </h3>
            <hr>
                   </div>
              
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
      
                         
                                   
                                 <header class="panel-heading">
            Make Group Mananger
            <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
                             
                             
           
        <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                      <form class="cmxform form-horizontal adminex-form" id="form-group-manager" name="form-group-manager" method="post" enctype="multiple/form-data">
                                            <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" name="group_id" id="group_id" value="<?=$this->uri->segment('4');?>">
                            
                                       

                                    

                                            <div class="col-md-12">
                                            
                                                <div class="form-group row">
                                                          <label for="cname" class="control-label col-lg-3">Select Group Manager * </label>
                                                          <div class="col-lg-9">
                                                            <select  name="group_manager[]" id="group_manager" class="form-control select2 box" multiple>
                                                               <?php foreach($user_list as $user_data):
                                                          
                                                                ?>
                                                                <option value="<?=$user_data->user_id;?>"> <?=$user_data->name;?> <?=$user_data->surname;?> - <?=$user_data->email;?></option>
                                                               <?php endforeach;?> 
                          
                                                              </select>
                                                            </div>
                                                        </div>
                                                
                                              
                                              

                                              <div class="form-group row">
                                                   <div class="pull-right">
                                                       <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i>  Back</button>
                                                       <button class="btn btn-success btn-sm" onclick="save_data();" type="button">Save changes</button>
                                                   </div>
                   
                                               </div>
                                               
                                           

                                            </div>
                                           

                     </form>      
               </div>
               <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
          
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact No.</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($groups_manager_list as $group_manager_data)
            {?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                 
                  <td><?=$group_manager_data->name;?> <?=$group_manager_data->surname;?></td>
                  <td><?=$group_manager_data->email;?></td>  
                  <td>
                      <?=$group_manager_data->contact_no;?>
                         
                    </td> 
                   <td><button onclick="deleteData('<?=$group_manager_data->groupmanager_id;?>','<?=$this->uri->segment('4');?>');"  class="btn btn-xs btn-danger" title="Delete"><i class="fa 
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
                  
            </div>    
        </div>
      
      </section>
        </div>
        </div>
      </div>
</form>      

      <div id="popupdiv"></div>
<script type="text/javascript" src="assets/js/ckeditor/ckeditor.js"></script>
<script src="ajax/group-manager.js"></script>
<script type="text/javascript">
    $('input[name="contact_no"]').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
</script>


                          



    
