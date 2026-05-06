<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
                Edit Coordinator
            </h3>
            <hr>
                   </div>
                  
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading  custom-tab">
           <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#home-2" data-toggle="tab">
                                       Edit 
                                    </a>
                                </li>
                                <li>
                                    <a href="#passwordchanges-2" data-toggle="tab">
                                        
                                        Change Password
                                    </a>
                                </li>
                                
                            </ul>
            <span class="mb-5 pull-right" style="margin-top: -30px;">
                <a onClick="window.history.back(-1);" class="btn btn-danger btn-sm" >
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
        <div class="panel-body">
           <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                <form method="post" class="cmxform form-horizontal adminex-form" enctype="multipart/form-data" id="form-coordinator" name="form-coordinator" novalidate> 
                     <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                             <input type="hidden" name="coordinator_id" id="coordinator_id" value="<?=$result->coordinator_id;?>">
                   <div class="col-md-12">
                        <div class="form-group row">
                            <label for="cname" class="control-label col-lg-3">Name * </label>
                          <div class="col-lg-9">
                              <input class="form-control" id="name" name="name"  type="text" value="<?=$result->name;?>"  required />
                            </div>
                       </div>
                       <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Contact No. * </label>
                            <div class="col-lg-9">
                               <input class="form-control" placeholder="Only number allowed." id="contact_no" name="contact_no"  type="tel" maxlength="10" min="10" value="<?=$result->contact_no;?>"  required />
                            </div>
                       </div>
                      <div class="form-group row">
                            <label for="cname" class="control-label col-lg-3">Email * </label>
                           <div class="col-lg-9">
                               <input class="form-control"  id="email" name="email"  type="email" value="<?=$result->email;?>"  required />
                            </div>
                       </div>
                       <div class="form-group row">
                             <label for="cname" class="control-label col-lg-3">Time Zone * </label>
                           <div class="col-lg-9">
                                 <input class="form-control"  id="time_zone" name="time_zone"  type="text" value="<?=$result->time_zone;?>"  required />
                            </div>
                        </div>
                        <?php
                        if($result->coordinator_id)
                       {
                        ?>
                            <div class="form-group row">
                                 <label for="cname" class="control-label col-lg-3">Status * </label>
                               <div class="col-lg-9">
                                    <select name="status" id="status" class="form-control">
                                  <option value="0">---Select one---</option>
                                  <option value="Y" <?=$result->status=='Y'? 'selected':'' ;?>>Active</option>
                                 <option value="N" <?=$result->status=='N'? 'selected':'' ;?>>Inactive</option>
                                    </select>
                               </div>
                            </div>
                        <?php }?>  

                        <div class="form-group row mt-5">

                       <div class="pull-right">
                            <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i> Back</button>
                            <button class="btn btn-success btn-sm" onclick="save_data();" type="button">Save changes</button>
                       </div>
                   </div>   
                    </div>
                </form>    
                </div>
                <div class="tab-pane" id="passwordchanges-2">
                    <form method="post" class="cmxform form-horizontal adminex-form" enctype="multipart/form-data" id="form-changepassword" name="form-changepassword" novalidate> 
                         <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                             <input type="hidden" name="coordinator_id" id="coordinator_id" value="<?=$result->coordinator_id;?>">
                    <div class="col-md-12">

                      
                       <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">New Password * </label>
                            <div class="col-lg-9">
                               <input class="form-control" id="new_password" name="new_password"  type="password"   required />
                            </div>
                       </div>
                        <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Confirm Password * </label>
                            <div class="col-lg-9">
                               <input class="form-control" id="confirm_password" name="confirm_password"  type="password"   required />
                            </div>
                       </div>

                   

                       <div class="form-group row mt-5">

                          <div class="pull-right">
                                <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i> Back</button>
                                <button class="btn btn-success btn-sm" onclick="password_change();" type="button">Password changes</button>
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
</div>

 

      <div id="popupdiv"></div>

<script src="ajax/coordinator.js"></script>
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


                          



    
