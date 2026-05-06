<div class="page-heading">
    <div class="row">
          <div class="col-md-8">
                <h3>
                   SDO  - <span><?=$group_data->category_name;?></span>
                &nbsp;&nbsp;
                   Working Group - <span><?=$group_data->group_title;?></span>
                 </h3>
         </div>
  </div>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">         



          <section class="panel">
            <header class="panel-heading">
                 SDO  Bulletin 
                        <!--<span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>-->
            </header>
            <div class="panel-body">
                <section id="unseen">
              
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th class="numeric">Sr.No</th>
                            <th>Bulletin Title</th>
                            <th>upload Date</th>
                            <th>Doc file</th>
                         
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="numeric">AAC</td>
                            <td>AUSTRALIAN AGRICULTURAL COMPANY LIMITED.</td>
                            <td>01-08-2022</td>
                            <td><a href="#"><i class="fa fa-pdf"></i> File</a></td>
                        
                        </tr>
                       
                        </tbody>
                    </table>
                </section>
                <hr>
                  
            </div>
           </section>
                 <section class="panel">
                          <header class="panel-heading">
                           Member Upoloaded Contribution
                     
                   </header>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th class="numeric">Sr.No</th>
                            <th class="numeric">Unique No.</th>
                            <th class="numeric">Meeting Name</th>
                            <th>Title</th>
                            <th>Source</th>
                            <th>AI/Question</th>
                            <th>Date</th>
                           
                         
                        </tr>
                        </thead>
                        <tbody>
                       
            <?php
            $i=1;
            foreach ($doc_reg_list as $docreg_data){

             
               
            ?>
                <tr>

                  <td><?=$i;?></td>  
                  
                  <td>
                     <?php
                     if($docreg_data->file)
                     {?>
                         <a target="_blank" href="<?=base_url();?>uploads/files/<?=$docreg_data->file;?>" ><?=$docreg_data->unique_no;?> </a> 

                     <?php }
                     ?>
                     
                      
                  </td>
                  <td><?=$docreg_data->meeting_title;?></td>
                   <td><?=$docreg_data->title;?>
                   <br>
                   	 <?php
                      if($docreg_data->group_manager_status=='accept')
                      {?>
                        <span style="font-size:10px; color: red;">To be verified by GM  </span>

                      <?php }else if($docreg_data->group_manager_status=='reject'){ ?>
                         <span style="font-size:10px; color: red;">To be rejected by GM  </span>
                       <?php }?>
                   </td> 
                   <td><?=$docreg_data->name;?> <?=$docreg_data->surname;?></td>  
                   <td>
                   	<?=$docreg_data->question_no;?>/<?=$docreg_data->question_name;?>
                  </td>  
                  <td>
                  	<?php
                  	  echo date('d-m-Y', strtotime($docreg_data->file_uploaded_date));
                  	?>
                  </td>
               </tr>

            <?php $i++; }?>
      
       
                       
                        </tbody>
                    </table>
                </section>
       </div>
    </div>  
</div>      