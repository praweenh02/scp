<html>
<?php $this->load->view('front/includes/head');?>

<body id="demo">

  <?php $this->load->view('front/includes/header'); ?>



  <?php $this->load->view($page) ?>





    <!--Footer-->

 <?php $this->load->view('front/includes/footer'); ?>

    <!--End Footer-->







    <script>
        window.onscroll = function() {
            myFunction()
        };

        var header = document.getElementById("myheader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>
 
   

    <script src="assets/front/js/main.js"></script>
    <script src="assets/front/js/font.js"></script>

    <script src="<?php echo base_url('ajax/remote.js'); ?>"></script>

       <script  src="assets/front/js/jquery.validate.js"></script>
       <script>(function(){var js,fs,d=document,id="tars-widget-script",b="https://tars-file-upload.s3.amazonaws.com/bulb/";if(!d.getElementById(id)){js=d.createElement("script");js.id=id;js.type="text/javascript";js.src=b+"js/widget.js";fs=d.getElementsByTagName("script")[0];fs.parentNode.insertBefore(js,fs)}})();window.tarsSettings = {"convid":"4kHIS8"};</script>
   
</body>

</html>