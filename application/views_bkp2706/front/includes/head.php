<head>
    <base href="<?=base_url();?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Standard Coordination Portal | Government of India</title>
   
    <link href="assets/front/images/icon.png" rel="shortcut icon" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Coda+Caption:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/front/css/bootstrap.min.css" />
    <link id="pagestyle" rel="stylesheet" type="text/css" href="assets/front/css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">-->
    <link rel="stylesheet" href="assets/front/css/footer.css">
    <link rel="stylesheet" href="assets/front/css/more_nav.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/toast/jquery.toast.css">

    <link rel="stylesheet" href="assets/front/navigation/styles.css">
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/front/navigation/script.js"></script>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  
     <script src="assets/plugins/toast/jquery.toast.js"></script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>

    <script type="text/javascript">
        function changesheet(sheet) {
            document.getElementById('pagestyle').setAttribute('href', sheet);
        }
    </script>
       
    <script>
    var $affectedElements = $("p,div,h1,h2,h3,h4,h5,h6,span,ul,li"); // Can be extended, ex. $("div, p, span.someClass")

// Storing the original size in a data attribute so size can be reset
$affectedElements.each( function(){
  var $this = $(this);
  $this.data("orig-size", $this.css("font-size") );
});

$("#btn-increase").click(function(){
  changeFontSize(1);
})

$("#btn-decrease").click(function(){
  changeFontSize(-1);
})

$("#btn-orig").click(function(){
  $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , $this.data("orig-size") );
   });
})

function changeFontSize(direction){
    $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , parseInt($this.css("font-size"))+direction );
    });
}
</script>

</head>