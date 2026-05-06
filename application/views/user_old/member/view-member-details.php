<?php error_reporting(0)?>

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
              <?=$result->name;?>  <?=$result->surname;?>'s Details
            
        
            <span class="mb-5 pull-right" style="margin-top: -4px;">
                <a onClick="window.history.back(-1);" class="btn btn-danger btn-sm" >
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
        <div class="panel-body">
           <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                <form method="post" class="cmxform form-horizontal adminex-form" enctype="multipart/form-data" id="form-member1" name="form-member1" novalidate> 
                     <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                             <input type="hidden" name="member_id" id="member_id" value="<?=$result->user_id;?>">
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
                            <label for="cname" class="control-label col-lg-3">Full Name -</label>
                          <div class="col-lg-9">
                             <span><?=$result->name;?> <?=$result->surname;?></span>
                           
                       </div>
                   </div>
                       <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Contact No. -</label>
                            <div class="col-lg-9">
                            
                               <span>+91 <?=$result->contact_no;?></span>
                            </div>
                       </div>
                      <div class="form-group row">
                            <label for="cname" class="control-label col-lg-3">Email -</label>
                           <div class="col-lg-9">
                             <span><?=$result->email;?></span>
                            </div>
                       </div>
                       <div class="form-group row">
                             <label for="cname" class="control-label col-lg-3">Organization -</label>
                           <div class="col-lg-9">
                          <span><?=$result->organization;?></span>
                            </div>
                        </div>
                      
                        <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Designation -</label>
                            <div class="col-lg-9">
                              <span><?=$result->designation;?></span>
                            </div>
                       </div> 
                        <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Address -</label>
                            <div class="col-lg-9">
                              <span><?=$result->address;?></span>
                            </div>
                       </div> 
                        <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">City -</label>
                            <div class="col-lg-9">
                              <span><?=$result->city;?></span>
                            </div>
                       </div> 
                        <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">State -</label>
                            <div class="col-lg-9">
                              <span><?=$result->state;?></span>
                            </div>
                       </div> 
                        <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Pin Code -</label>
                            <div class="col-lg-9">
                              <span><?=$result->pincode;?></span>
                            </div>
                       </div>
                        
                         <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Recommend -</label>
                            <div class="col-lg-9">
                            <select class="form-control" name="group_manager_recommend_status" required>
                                <option value="0" selected disabled>---Select One---</option>
                                <option value="Y">Recommend</option>
                                <option value="N">Rejected</option>
                                
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

<script src="ajax/usermember.js"></script>
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


                          



    
