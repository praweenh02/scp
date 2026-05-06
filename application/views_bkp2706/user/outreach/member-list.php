 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <div class="page-heading">
            <h3>
               Subscription List
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
                            Subscription List
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="employee_grid">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>Full Name</th>
            <th>Contact Details</th>
            <th>Organization/Designation </th>
           
            
    
          
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($member_list->result() as $group_data){
             if($group_data->user_type=='website_subscriber')
             {
            
            
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                 <td><?=$group_data->first_name;?> <?=$group_data->last_name;?> </td>  
                 <td><?=$group_data->phone_no;?><br> <?=$group_data->user_email;?></td>
                  <td><?=$group_data->organization;?>/<?=$group_data->designation;?></td>
                  
               </tr>
               <?php }else if($group_data->user_type=='group_member'){
                   $user_id = $group_data->user_id;
               $result = $this->db->select('*')->where('user_id',$user_id)->get('users')->row();
               ?>
                 <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                 <td><?=$result->name;?> <?=$result->surname;?> </td>  
                 <td><?=$result->contact_no;?><br> <?=$result->email;?></td>
                  <td><?=$result->organization;?>/<?=$result->designation;?></td>
                  
               </tr>
               
               <?php }?>

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

<script type="text/javascript" language="javascript" >
$( document ).ready(function() {
$('#employee_grid').DataTable({

		 "buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
        });
});
</script>





                          



    
