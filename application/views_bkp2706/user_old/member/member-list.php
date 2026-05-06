 <div class="page-heading">
            <h3>
           <?=$group_data->group_title;?>'s  Member List
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
            <?=$group_data->group_title;?>'s  Member List
            <span class="mb-5 pull-right" style="margin-top: -4px;">
                <a onClick="window.history.back(-1);" class="btn btn-danger btn-sm" >
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Contact No.</th>
            <th>SDO Name</th>
            <th>Group Name</th>
            <th>Super User Status</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($groups as $group_data)
            {?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                  <td><?=$group_data->name;?> <?=$group_data->surname;?></td>
                  <td><?=$group_data->email;?></td>  
                  <td><?=$group_data->contact_no;?></td> 
                   <td><?=$group_data->category_name;?></td>
                   <td><?=$group_data->group_title;?></td> 
                    <td><?php if($group_data->suerp_admin_status=='accepted'){

                    echo '<button class="btn-success btn-xs">Accepted</button>';
                    }else if($group_data->suerp_admin_status=='rejected'){
                     echo '<button class="btn-danger btn-xs">Rejected</button>';
                    }else{
                          echo '<button class="btn-info btn-xs">Pending</button>';

                    }  
                    ?></td>
                  <td><?php if($group_data->group_manager_recommend_status=='Y'){

                    echo '<button class="btn-success btn-xs">Recommend</button>';
                    }else if($group_data->group_manager_recommend_status=='N'){
                     echo '<button class="btn-danger btn-xs">Rejected</button>';
                    }else{
                          echo '<button class="btn-info btn-xs">Pending</button>';

                    }  
                    ?></td>
                    <td>
                    <a href="member/view_member_list/<?=$group_data->user_id;?>/" class="btn btn-xs btn-primary" title="View"><i class="fa 
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


                          



    
