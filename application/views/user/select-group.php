<?=$this->session->userdata('group_id');?>
 <div class="page-heading">
            <h3>
          Allocated Groups 
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
           Groups List
           
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>SDO Name</th>
            <th>Group Name</th>
             <th>Action</th>
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($group_list as $group_data)
            {
                $catgory_id = $group_data->category_id;
            $sdo = $this->db->select('*')->where('category_id',$catgory_id)->get('category')->row();
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                  <td><?=$sdo->category_name;?></td>
                  <td><?=$group_data->shortform;?></td>  
                 
                  
                    <td>
                    <a href="dashboard/index/<?=$group_data->group_id;?>/" class="btn btn-xs btn-primary" title="View"><i class="fa 
fa-eye"></i> View</a><br> </td>  
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


                          



    
