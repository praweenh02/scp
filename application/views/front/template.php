<html>
<?php $this->load->view('front/includes/head');?>
<link rel="manifest" href="https://chatbots.retailaisoft.com/TEC/manifest.json" />
    <script defer="defer" src="https://chatbots.retailaisoft.com/TEC/static/js/main.25573f15.js"></script>
    <link href="https://chatbots.retailaisoft.com/TEC/static/css/main.840eeec7.css" rel="stylesheet">
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
 
    <!--<link rel="manifest" href="https://chatbots.retailaisoft.com/TEC/manifest.json" />-->
    <!--<script defer="defer" src="https://chatbots.retailaisoft.com/TEC/static/js/main.3a164996.js"></script>-->
    <!--<link href="https://chatbots.retailaisoft.com/TEC/static/css/main.94444820.css" rel="stylesheet">-->


    <script src="assets/front/js/main.js"></script>
    <script src="assets/front/js/font.js"></script>

    <script src="<?php echo base_url('ajax/remote.js'); ?>"></script>

       <script  src="assets/front/js/jquery.validate.js"></script>
         <script>
    (function (botId) {
      var s = document.createElement("script");
      s.async = true;
      s.type = 'text/javascript';
      s.src = "https://app.chat360.io/widget/chatbox/common_scripts/script.js";
      s.onload = function () {
        window.loadChat360Bot(botId);
      };
      s.onerror = function (err) {
        console.error(err);
      };
      document.body.appendChild(s);
    })("200c3fbe-dc0c-450e-bd51-6b52039bae19");
  </script>
<div id="root"></div>   
</body>

</html>