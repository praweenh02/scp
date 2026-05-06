<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript" src="<?=base_url();?>assets/front/js/jquery.bootstrap.newsbox.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript" src="<?=base_url();?>assets/front/js/jquery.bootstrap.newsbox.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<div class="page-banner" style="background-image:url('assets/front/images/page-banner.png');">
	<div class="container">
		<div class="row">
			<div class="latest_videos">
				
				<h2><?=$result->title;?></h2>
				<!-- <p class="sub-heading"><?=$group_result->group_title;?></p> -->
			</div>
			
			
		</div>
		
	</div>
	
</div>
<div class="container mt-40" id="skipmaincontent">
	<div class="row">
		
		<div class="col-sm-12 col-lg-12 col-md-12">
			<div class="card">
				<div class="card-body">
					
						<h3 class="header-title-about card-title"><?=$result->title;?></h3>
				<hr class="pt-3 pb-3">
					
					
					
					<p><b><?=$result->description;?></b></p>
				</div>
			</div>
			
			
			
			
			
			
			
		</div>
		
	</div>
</div>
</div>
<br>
<script type="text/javascript" src="<?=base_url();?>ajax/signup.js"></script>
<style type="text/css">
.vertical-heading  {
background: linear-gradient( 90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100% );
color: #fff;
font-size: 19px;
padding: 10px 10px;
margin-bottom: 0px;
}
.vertical-menu {
width: 100%;
border-bottom: 2px solid #0000;
padding-bottom: 20px;
}
.vertical-menu a {
background-color: rgb(252, 252, 252);
padding: 5px 10px;
line-height: 16px;
display: block;
color: white;
border-top: 1px dotted rgb(222 226 230 / 80%);
color: #353535;
font-size: 16px;
text-decoration: none;
padding-top: 10px;
font-family: 'Fira Sans', sans-serif;
}
.vertical-menu a:hover {
background-color: #ccc;
}
.vertical-menu a.active {
background-color: #04668c;
color: white;
}
.card-header
{
background: linear-gradient( 90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100% );
color: white;
width: 100%;
}
.latest_gropus li
{
background-color: rgb(252, 252, 252);
padding: 7px 10px;
line-height: 16px;
display: block;
color: white;
border-top: 1px dotted rgb(222 226 230 / 80%);
color: #353535;
font-size: 13px;
text-decoration: none;
font-family: 'Fira Sans', sans-serif;
}
.card-footer
{
display: none !important;
}
.header-title-about {
color: #04668c;
font-size: 26.5px;
font-weight: 600;
position: relative;
display: inline-block;
margin-bottom: 22px;
font-family: 'Fira Sans', sans-serif;
}
.group_subheading{
padding-bottom: 10px;
font-weight: 500;
font-family: 'Fira Sans', sans-serif;
font-size:20px;
color: #343a40;
}
.header-title-inner-small
{
color: #04668c;
font-size: 18px;
font-weight: 500;
position: relative;
display: inline-block;
margin-bottom: 13px;
margin-top: 0px;
position: relative;
padding-top: 27px;
font-family: 'Fira Sans', sans-serif;
}
.bullet-list-stye li
{
list-style: none;
padding: 7px 0px;
line-height: 16px;
/*display: flex;*/
color: #353535;
font-size: 14px;
text-decoration: none;
display:flex;
font-family: 'Fira Sans', sans-serif;
}
}
.bullet-list-stye a {
color: red !important;
font-size: 15px;
}
.bullet-list-stye li::before {
content: "•"; /* Insert content that looks like bullets */
font-weight: 500;
font-size: 18px;
padding-right: 8px;
color:#0080c0; /* Or a color you prefer */
}
hr{
margin-bottom: 5px !important;
margin-top: 5px !important;;
}
.table-heading
{
background: linear-gradient( 90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100% );
color: #fff;
}
.vertical-menu ul li a:hover, .vertical-menu ul li a.active {
background: #3388ad;
color: #fff;
padding-left: 7px;
transition-property: padding-left;
transition-duration: .5s;
transition-timing-function: linear, ease-in;
text-decoration: none;
}
p {
color: #353535;
font-size: 16px;
font-family: 'Fira Sans', sans-serif;
}
</style>
<script type="text/javascript">
$(function () {
$(".latest_gropus").bootstrapNews({
newsPerPage: 6,
autoplay: true,
pauseOnHover:true,
direction: 'up',
newsTickerInterval: 3000,
onToDo: function () {
//console.log(this);
}
});
});
</script>
<link type="text/css" rel="stylesheet" href="assets/plugins/tricker/css/jquery.jConveyorTicker.min.css?v=1.1.0" />
<!-- Demo styles -->
<link type="text/css" rel="stylesheet" href="assets/plugins/tricker/demo-files/demo-styles.css?v=1.1.0" />
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<!--dynamic table initialization -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
$('#myTable').DataTable();
} );
</script>