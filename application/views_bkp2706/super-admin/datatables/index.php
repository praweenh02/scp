 <div class="page-heading">
            <h3>
                Datatables Management
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
            Datatables Management
            <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a  href="super-admin/datatables/create/0/" class="btn btn-primary btn-sm" >
                    <i class="fa fa-plus"></i> Add New
                </a>
             </span>
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>#</th>
            <th>key_area</th>
            <th>sg</th>
            <th>work_item</th>
            <th>subject_title</th>
             <th>que_no</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($page_list as $page_v)
            {?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                 
                  <td><?=$page_v->key_area;?></td>
                  <td><?=$page_v->sg;?></td>  
                   <td><?=$page_v->work_item;?></td>  
                    <td><?=$page_v->subject_title;?></td>  
                     <td><?=$page_v->que_no;?></td>  
                 
                  <td>
                      <a href="super-admin/page/create/<?=$page_v->datatable_id;?>/"  class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                   </td>
                   <td>
                      <button onclick="deleteData('<?=$page_v->datatable_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i> Delete</button>
                  </td>  
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

<script src="ajax/page.js"></script>


                          



    
