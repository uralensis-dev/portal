<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="">
  <meta name="author" content="">

  <title></title>
  <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
  <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />
  <link href="<?php echo base_url('/assets/css/jquery.steps.css'); ?>" rel="stylesheet" />
  <link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/line-awesome.min.css'); ?>">

  <!-- Main CSS -->
  <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/style.css'); ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/login.css">


  <script src="<?php echo base_url('/assets/newtheme/js/jquery-3.2.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
</head>

<script>
  // Set the date we're counting down to
  var countDownDate = new Date("Feb 29, 2020 04:00:00").getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    if (document.getElementById('demo') != null)
      document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
      minutes + "m " + seconds + "s ";

    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      if (document.getElementById('demo') != null)
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
  }, 1000);
</script>
<style>
  .alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    margin-left: 200px;
    display: none;
  }

  .alert.info {
    background-color: #2196F3;
  }

  .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }

  #demo {
    text-align: center;
    font-size: 22px;
    margin-top: 0px;
  }

  .closebtn:hover {
    color: black;
  }

  .account-box {
    margin-top: 69px;
  }

  .col {
    margin-left: 20px !important;
  }
</style>
<script type='text/javascript'>
    $(document).ready(function(){
      $("body").on('click', '.pwd_toggle', function () {
          $(this).toggleClass("fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
          $("#password").attr("type", type);
      });
    })
  </script>
<body>