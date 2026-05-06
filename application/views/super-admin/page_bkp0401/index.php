<?php echo "success" ;?> <div class="page-heading">
            <h3>
                Page Management
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
          Page  Management
            <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a  href="super-admin/page/create/0/" class="btn btn-primary btn-sm" >
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
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>View</th>
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
                 
                  <td><?=$page_v->title;?></td>
                  <td><?=word_limiter(strip_tags($page_v->description),10);?>...</td>  
                 
                  <td><?=($page_v->status=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?></td>
                    <td>
                      <a href="<?=base_url();?>home/page/<?=$page_v->url;?>/" target="_blank"  class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-eye"></i> View</a>
                   </td>
                  <td>
                      <a href="super-admin/page/create/<?=$page_v->page_id;?>/"  class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                   </td>
                   <td>
                      <button onclick="deleteData('<?=$page_v->page_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i> Delete</button>
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


                          



    
