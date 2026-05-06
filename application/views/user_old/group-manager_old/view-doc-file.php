<?php //error_reporting(0)?>

 <div class="page-heading">
            <h3>
            View details
            </h3>
            <hr>
                   </div>
                  
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           
           <header class="panel-heading">
              <?=$result->title;?>'s Details
            
        
            <span class="mb-5 pull-right" style="margin-top: -4px;">
                <a onClick="window.history.back(-1);" class="btn btn-danger btn-sm" >
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
        <div class="panel-body">
           <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                <form method="post" class="cmxform form-horizontal adminex-form" enctype="multipart/form-data" id="form-doc" name="form-doc" novalidate> 
                     <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                             <input type="hidden" name="contribution_id" id="contribution_id" value="<?=$result->contribution_id;?>">
                             <input type="hidden" name="sdo_id" id="contribution_id" value="<?=$result->sdo_id;?>">
                             <input type="hidden" name="group_id" id="group_id" value="<?=$result->group_id;?>">
                   <div class="col-md-12">
                        <div class="form-group row">
                            <label for="cname" class="control-label col-lg-3">SDO Name -</label>
                               <div class="col-lg-9">
                                  <span><?=$result->category_name;?></span>
                                </div>
                       </div>
                        <div class="form-group row">
                            <label for="cname" class="control-label col-lg-3">Group  Title -</label>
                               <div class="col-lg-9">
                                  <span><?=$result->group_title;?></span>
                                </div>
                       </div>
                        <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Meeting Title -</label>
                            <div class="col-lg-9">
                              <span><?=$result->meeting_title;?></span>
                            </div>
                       </div> 
                        <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Question -</label>
                            <div class="col-lg-9">
                              <span><?=$result->question_no;?>/<?=$result->question_name;?></span>
                            </div>
                       </div>
                         <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Working Party -</label>
                            <div class="col-lg-9">
                              <span><?=$result->party_name;?></span>
                            </div>
                       </div>  
                          <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Working Item -</label>
                            <div class="col-lg-9">
                              <span><?=$result->work_item;?></span>
                            </div>
                       </div>  
                        <div class="form-group row">
                            <label for="cname" class="control-label col-lg-3">Title -</label>
                          <div class="col-lg-9">
                             <span> <?=$result->title;?></span>
                           
                       </div>
                   </div>
                       <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Unique No. -</label>
                            <div class="col-lg-9">
                            
                               <span><?=$result->unique_no;?></span>
                            </div>
                       </div>
                      <div class="form-group row">
                            <label for="cname" class="control-label col-lg-3">File -</label>
                           <div class="col-lg-9">
                              <a href="group/filedownload/<?=$result->sdo_id;?>/<?=$result->group_id;?>/<?=$result->contribution_id ;?>/" class="btn btn-xs btn-info" title="<?=$result->file;?>"><i class="fa fa-download"></i> Download </a> 
                            </div>
                       </div>
                       <div class="form-group row">
                             <label for="cname" class="control-label col-lg-3">File uploaded Date -</label>
                           <div class="col-lg-9">
                          <span><?=date('d-m-Y',strtotime($result->file_uploaded_date));?></span>
                            </div>
                        </div>
                         <div class="form-group row">
                             <label for="cname" class="control-label col-lg-3">Group Contributors -</label>
                           <div class="col-lg-9">
                             <table class="table table-bordered">
                                <thead>
                                    <th class="numeric">Sr.No.</th>
                                    <th class="">Contributor Name</th>
                                    <th class="">Organization</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    $contribution_id  = $result->contribution_id;
                                    $query  = $this->db->select('*')->where('contribution_id',$contribution_id)->where('group_id',$result->group_id)->get('group_contributors');
                                    foreach($query->result() as $result1):
                                    ?>
                                       <tr>
                                        <td><?=$i;?></td>
                                        <td><?=$result1->contributor_name;?></td>
                                        <td><?=$result1->organization;?></td>
                                       </tr>
                                    <?php $i++; endforeach;?>   
                                </tbody>
                             </table>
                                 
                             </table>
                            </div>
                        </div>
                      
                         <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Accecpt/Reject -</label>
                            <div class="col-lg-9">
                            <select class="form-control" required name="group_manager_status" id="group_manager_status" required>
                                <option value="0" selected disabled>---Select One---</option>
                                <option value="accept">Accept</option>
                                <option value="reject">Reject</option>
                                
                            </select>
                            </div>
                       </div> 
                    




                        <div class="form-group row mt-5">

                       <div class="pull-right">
                            <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i> Back</button>
                             <button class="btn btn-success btn-sm" onclick="update_status();" type="button">Save changes</button>
                            
                       </div>
                   </div>   
                    </div>
                </form>    
                </div>


               </div> 
            </div>     
    
       
      </section>
        </div>
        </div>
      </div>
  </section>

<div id="popupdiv"></div>

<script src="ajax/user-group-manager.js"></script>
<script type="text/javascript">
    $('input[name="contact_no"]').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
</script>


                          



    
