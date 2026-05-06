<?php 
error_reporting(0);
?>
<!-- page heading start-->
        <div class="page-heading">
            <h3>
                <?=$group_data->group_title;?>
            </h3>
          <hr>
           
        </div>
        <!-- page heading end-->

     
   <!--body wrapper start-->
        <div class="wrapper">
              
          
            <div class="row">
                    <div class="col-md-12">
                    <div class="panel">
                        <header class="panel-heading">
                          Group Meetings
                            <span class="tools pull-right">
                             <button onClick="window.history.back(-1);"  class="btn btn-sm btn-danger">Back</button>
                             </span>
                        </header>
                        <div class="panel-body">
                        <div class="col-md-12">
                        	<div class="col-md-4">
                        		<h4>
                        		  <a href="group/documents/<?=$this->uri->segment('3');?>/"><i class="fa fa-laptop"></i> <span>Documents</span></a>
                        	   </h4>
                        	</div>
                        	<div class="col-md-4">
                                <?php
                                $current_date = date('Y-m-d');

                             
                                if($current_date >=  $document_expiry_date['start_date']  AND    $current_date <= $document_expiry_date['end_date'])
                                {?> <h4>
                                     <a href="group/upload_new_contributions/<?=$this->uri->segment('3');?>/"><i class="fa fa-file-o"></i> <span>Upload new  contributions</span></a>
                                   </h4> 
                                       <stron class="text text-black">For new Document upload date is <br> <?=date('d-m-Y', strtotime($document_expiry_date['start_date']));?> to <?=date('d-m-Y', strtotime($document_expiry_date['end_date']));?> </strong>
                                

                                <?php }else{ ?>
                                    
                                   
                                      <h4>
                                    <a ><i class="fa fa-file-o"></i> <span>Upload new  contributions</span></a>
                                        </h4>  
                                   <span style="color:red;">For new Document upload date is - <br> <?=date('d-m-Y', strtotime($document_expiry_date['start_date']));?> To  <?=date('d-m-Y', strtotime($document_expiry_date['end_date']));?>  </span>
                                  
                                <?php }
                                ?>

                                   
                        	</div>
                        	<div class="col-md-4">
                        		<h4>
                        		  <a href="group/revision_of_existing_contribution/<?=$this->uri->segment('3');?>/"><i class="fa fa-file-o"></i> <span>Upload revision of existing contribution</span></a>
                        		</h4>  
                        	</div>
                        	
                        </div>
                               
                                

                            </ul>
                          
                        </div>
                    </div>
               
          


           
      

             </div>   
           
                

            </div>
 
           </div>

        </div>
        <script type="text/javascript" src="ajax/dashboard.js"></script>