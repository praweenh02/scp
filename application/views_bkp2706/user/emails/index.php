 <div class="page-heading">
    <div class="row">
                    <div class="col-md-7">
                    <h3>
                      
                   Email Subscription
                       
                   </h3>
               </div>
              
        </div>    
        <hr>
</div>
<form id="email-subs" method="post" name="email-subs">
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
           Group List
               <span class="mb-5 pull-right" >
                        <button onclick="save_data();" type="button"  class="btn btn-success btn-sm btn-submit">
                            Submit
                        </button>
                   </span>
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>SDO Name</th>
            <th class="numeric">Working Group</th> 
            <th class="numeric">Action</th>
         </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            error_reporting(0);
            $i=1;
            $user_id = $this->session->userdata('user_id');
            
                

                foreach ($group_list as  $value) 
                {
                $result = $this->db->select('*')->where('category_id',$value->sdo_id)->get('category')->row();
                    ?>
                    
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$result->category_name;?></td>
                    <td><?=$value->shortform;?></td>
                    <td>
                        <input type="checkbox"  <?=($value->email_subscription=='Y') ? 'checked':'' ?>  class="form-control get_value"  id="email_subscription_<?=$value->emai_subscription_id;?>" name="email_subscription[]"  value="<?=$value->emai_subscription_id;?>" style="width: 150%;">
                        <!--<select  class="form-control" name="sub_value_<?=$value->emai_subscription_id;?>">
                            <option value="Y" <?=($value->email_subscription=='Y')? 'selected':'';?>>Yes</option>
                             <option value="N" <?=($value->email_subscription=='N')? 'selected':'';?>>No</option>
                            </select>-->
                            <input type="hidden" name="sub_value_<?=$value->emai_subscription_id;?>" id="inputs_<?=$value->emai_subscription_id;?>" value="<?=$value->email_subscription;?>">
                      
     
                    </td>
                </tr>
                <script>
                    $(document).ready(function(){ 
		$("#email_subscription_<?=$value->emai_subscription_id;?>").change(function(){ 
			if ($("#email_subscription_<?=$value->emai_subscription_id;?>").is(':checked')) { 
                $("#inputs_<?=$value->emai_subscription_id;?>").val("Y"); 
                 
            } 
            else
            {
                $("#inputs_<?=$value->emai_subscription_id;?>").val("N"); 
                
            }
		}); 
	}); 
                </script>
                 
           <?php  $i++;}
            ?>
          
          
      
       
       
         </tbody>
        </table>
        </div>
        </div>
      </section>
        </div>
        </div>
      </div>
      

      <div id="popupdiv"></div>
</form>
<script src="ajax/email-subscription.js"></script>


                          



    
