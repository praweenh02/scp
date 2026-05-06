 <div class="page-heading">
            <h3>
          Website Subscribers
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
              Website Subscribers List
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>Group Name</th>
            <th>Full Name</th>
            <th>Contact Details</th>
            <th>Action</th>
            
    
          
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($outreach_list as $group_data){

            
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                 <td><?=$group_data->shortform;?></td>  
                 <td><?=$group_data->first_name;?>
                 <?=$group_data->last_name;?></td>
                 <td>Email - <?=$group_data->user_email;?><br>
                     Phone NO. - <?=$group_data->phone_no;?><br>
                 
                 </td>
                  <td><button onclick="deleteData(<?=$group_data->emai_subscription_id;?>);"   class="btn btn-xs btn-danger" target="_blank"><i class='fa fa-trash-o'></i> Delete</button></td>
                  
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


                          



    
