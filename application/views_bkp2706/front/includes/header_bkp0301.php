  <div class="top-header">
        <div class="container">
            <div class="row">
                <!--<div class="col-md-4 col-12 text-md-left text-center leftmy">
                    <ul class="top_nav1">
                        <li><i class="fa fa-calendar"></i> <span id="datedisplay"></span></li>
                        <li><i class="fa fa-clock-o"></i> <span id="clockDisplay"></span></li>
                      
                    </ul>
                </div>-->


                <div class="col-md-12 col-sm-12 col-lg-12 col-12 text-md-right text-center righthd hidden-sm">
                    <ul class="top_nav">
                          
                       
                        <li><a href="#skipmaincontent"><i class="fa fa-reply-all"></i> Skip To Main Content</a></li>
                        <!--<li><a href="#">Hindi</a></li>-->
                        
                        <li class="tbg"><a  id="increase" class="font-button minus"  >A-</a></li>
                        <li class="tbg"><a href="javascript:void(0);" id="btn-orig" class="font-button equal" >A </a></li>
                        <li class="tbg"><a href="javascript:void(0);" id="btn-increase" class="font-button plus">A+</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>


    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 ">
                    <img src="assets/front/images/gov_logo.svg" class="img-reponsive gov_logo" style="width:7.5%;">
                    <img src="assets/front/images/logo.png"  class="img-reponsive" style="width:80%; border-left: 2px;" />
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 ">
                        <a href="<?=base_url();?>">
                    <span style="padding:5px; margin-left:4%; float:right; font-size: 28px;
    line-height: 30px;
    color: #141c27;
    font-weight: bold; margin-top:7px; color:#177295">Standards Coordination Portal </span>
    </a>
                </div>
              
            </div>
        </div>
    </div>



    <div id="myheader" class="main_navigation">
        <div class="container">
            <div class="row">
                <div id='cssmenu'>
                    <ul>
                        <li><a href="<?=base_url();?>">Home</a></li>
                        <li><a href="<?=base_url();?>home/about/">About us </a></li>
                         
                      
                         <?php 
                         $query1 = $this->db->select('*')->where('category_status','Y')->order_by('category_id','DESC')->get('category');
                          foreach ($query1->result() as $result):
                             $category_id = $result->category_id;
                         ?>
                            <li><a href="#"><?=$result->category_name;?></a>
                               <ul>
                                <?php
                                $query2 = $this->db->select('*')->where('category_id',$category_id)->where('status','Y')->order_by('display_order','ASC')->limit('12')->get('groups');
                                  foreach($query2->result() as $result2):  
                                ?>
                                   <li><a href="home/groups/<?=$result2->category_id;?>?groupId=<?=base64_encode($result2->group_id);?>"><?=$result2->shortform;?></a></li>
                                <?php endforeach;?>
                                </ul>
                           </li>
                           
                    <?php endforeach;?>
                     <li><a href="<?=base_url();?>home/helpdesk/">Help </a></li>
                      <li class="right float-right active"><a class="active" href="home/signup/">Sign Up</a></li>
                          <li class="right float-right active"><a href="login" target="_blank"><i class="fa fa-sign-in"></i> Login</a></li>

                      



                    </ul>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .gov_logo {
          border-right: solid 2px rgb(0 0 0 / 0.10);
          padding-right: 4px;
          margin-right: 8px;
        }
    </style>
     <script type="text/javascript">
        $(function () {
            $(".font-button").bind("click", function () {
                var size = parseInt($('body').css("font-size"));
                if ($(this).hasClass("plus")) {
                    size = size + 3;
                }else if($(this).hasClass("equal")) {

                    size =12;
                 }else {
                    size = size - 3;
                    if (size <= 10) {
                        size = 10;
                    }
                }
                $('body').css("font-size", size);
            });
        });
    </script>