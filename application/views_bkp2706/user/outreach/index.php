 <div class="page-heading">
            <h3>
            Outreach List
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
              Outreach List
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>Group Title</th>
            <th>Total Member</th>
            <th>Action</th>
            
    
          
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($outreach_list->result() as $group_data){
            
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                 <td><?=$group_data->group_title;?></td>  
                 <td><a href="outreach/memberlist/<?=$group_data->group_id;?>"><strong><?=$group_data->total_users;?></strong></a></td>
                  <td><a  href="<?=base_url();?>outreach/sendemail/<?=base64_encode($group_data->group_id);?>" class="btn btn-xs btn-primary" target="_blank"><i class='fa fa-envelope'></i> Send Email</a></td>
                  
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


                          



    
