 <div class="page-heading">
            <h3>
                SDO  List
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
              Deleted SDO List
             </div>
              <div class="col-md-4">
                 
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
          
            
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="loadallData" class="row_position">
            <?php
            $i=1;
            foreach ($groups_list as $group_data)
            {?>
                <tr class="gradeX" id="<?=$group_data->category_id;?>">
                  <td><?=$i;?></td>  
                 
                  <td><?=$group_data->category_name;?></td>
                  
                <td><button  onclick="restoreSdo('<?=$group_data->category_id;?>');"  class="btn btn-xs btn-success" title="Restore"> Restore</button></td>
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


                          



    
