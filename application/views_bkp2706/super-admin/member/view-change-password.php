<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
             <?=$result->name;?>  <?=$result->surname;?>'s Details
            </h3>
            <hr>
                   </div>
                  
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
      
           
           <header class="panel-heading">
             
                <?=$result->name;?>  <?=$result->surname;?>'s Details
        
            <span class="mb-5 pull-right" style="margin-top: -2px;">
                <a onClick="window.history.back(-1);" class="btn btn-danger btn-sm" >
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
        <div class="panel-body">
           <div class="tab-content">
               <div class="tab-pane active " id="home">
                 <form method="post" class="cmxform form-horizontal adminex-form" enctype="multipart/form-data" id="form-password" name="form-password" novalidate> 
                     <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                             <input type="hidden" name="member_id" id="member_id" value="<?=$result->user_id;?>">
                   <div class="col-md-12">
                        <div class="form-group row">
                            <label for="cname" class="control-label col-lg-3">Password * </label>
                               <div class="col-lg-9">
                                 <input type="password" required class="form-control" name="password" id="password"  minlength="6" maxlength="16">
                                </div>
                       </div>
                        <div class="form-group row">
                            <label for="cname" class="control-label col-lg-3">Confirm Password * </label>
                               <div class="col-lg-9">
                                   <input type="password" class="form-control" name="confirm_password" id="confirm_password" required  minlength="6" equalto="#password" title="Password and Confirm Password not match." maxlength="16">
                                </div>
                       </div>
                       
                        <div class="form-group row mt-5">

                           <div class="pull-right">
                            <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i> Back</button>
                            <button class="btn btn-success btn-sm" onclick="change_password();" type="button">Save changes</button>
                       </div>
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

<script src="ajax/member.js"></script>
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


                          



    
