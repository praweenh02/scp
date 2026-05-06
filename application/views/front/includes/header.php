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
            <div class="col-md-6 col-lg-6 col-sm-12 "> <a href="https://www.india.gov.in/" target="_blank"><img src="assets/front/images/gov_logo.svg" class="img-reponsive gov_logo" style="width:7.5%;"></a> <a href="https://tec.gov.in" target="_blank" ><img src="assets/front/images/logo.png"  class="img-reponsive" style="width:80%; border-left: 2px;" /></a> </div>
            <div class="col-md-6 col-lg-6 col-sm-12 "> <a href="<?=base_url();?>"> <span style="padding:5px; margin-left:4%; float:left; font-size: 28px;line-height: 30px;color: #141c27;font-weight: bold; margin-top:7px; color:#177295"> Standards Coordination Portal </span></a>
            <?php 
            if(empty($this->uri->segment(1)))
            {?>
                 <div class="hidden-sm hidden-md"> <a href="https://www.g20.org/en/" target="_blank"> <img src="<?=base_url();?>/assets/images/g20-logo.png" style="width:18%; margin-top: -14px; px; float:right;" class="img-reponsive"> </a> </div>

            <?php }else {?>
            
            <div class="hidden-sm hidden-md"> <a href="https://www.g20.org/en/" target="_blank"> <img src="<?=base_url();?>/assets/images/g20-logo.png" style="width:18%; margin-top:5px; float:right;" class="img-reponsive"> </a> </div>
        <?php }?>
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
                 <?php
                $query11 = $this->db->select('*')->where('parent_id' ,'0')->where('status','Y')->where('deleted','Y')->order_by('title','ASC')->limit('5')->get('page');
                foreach ($query11->result() as $result11):
                $page_id = $result11->page_id;
                ?>
                <li><a href="home/page/<?=$result11->url;?>">
                    <?=$result11->title;?>
                </a>
                <ul>
                    <?php
                    $query22 = $this->db->select('*')->where('parent_id',$page_id)->where('status','Y')->where('deleted','Y')->order_by('title','ASC')->limit('6')->get('page');
                    foreach($query22->result() as $result22):
                    ?>
                    <li><a href="home/page/<?=$result22->url;?>">
                        <?=$result22->title;?>
                    </a></li>
                    <?php endforeach;?>
                </ul>
            </li>
            <?php endforeach;?>
                <!--<li><a href="<?=base_url();?>home/about/">About us </a></li>-->
                <?php
                $query1 = $this->db->select('*')->where('category_status','Y')->order_by('category_id','DESC')->get('category');
                foreach ($query1->result() as $result):
                $category_id = $result->category_id;
                ?>
                <li><a href="#">
                    <?=$result->category_name;?>
                </a>
                <ul>
                    <?php
                    $query2 = $this->db->select('*')->where('category_id',$category_id)->where('status','Y')->order_by('display_order','ASC')->limit('12')->get('groups');
                    foreach($query2->result() as $result2):
                    ?>
                    <li><a href="home/groups/<?=$result2->category_id;?>?groupId=<?=base64_encode($result2->group_id);?>">
                        <?=$result2->shortform;?>
                    </a></li>
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