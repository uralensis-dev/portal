<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Uralensis</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/redmond.datepick.css'); ?>">
        <link href="<?php echo base_url('/assets/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/bootstrap-datetimepicker-standalone.css'); ?>" rel="stylesheet" />
        
        
        <link href="<?php echo base_url('/assets/css/scrollbar.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/transitions.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/jquery-ui.css'); ?>" rel="stylesheet" /> 
        <link href="<?php echo base_url('/assets/css/font-awesome.min.css'); ?>" rel="stylesheet" /> 
        <link href="<?php echo base_url('/assets/css/owl.carousel.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/owl.theme.default.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/linearicons.css'); ?>" rel="stylesheet" />

        <!--Full Calendar CSS Files-->
        <link href='<?php echo base_url('/assets/fullcalendar/core/main.css'); ?>' rel='stylesheet' />
        <link href='<?php echo base_url('/assets/fullcalendar/daygrid/main.css'); ?>' rel='stylesheet' />
        <!--Full Calendar CSS Files-->

        <link href="<?php echo base_url('/assets/css/themify-icons.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/responsive.css'); ?>" rel="stylesheet" />
        <?php
        if (!empty($styles)) {
            foreach ($styles as $value) {
                ?>
                <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>assets/<?php echo $value; ?>"/>
                <?php
            }
        }
        ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


          
        <![endif]-->

        <script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
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
//   document.getElementById("demo").innerHTML = days + "d " + hours + "h "
//   + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    // document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
    <style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  margin-left:200px;
}
.alert.info {background-color: #2196F3;}
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
#demo{
    text-align: center;
  font-size: 22px;
  margin-top: 0px;
}

.closebtn:hover {
  color: black;
}
</style>
   

    <body class="uralensis tg-userlogin tg-dashboard">
        <div id="ajax_loading_effect">
            <div class="ajax_loader">
                <span><img src="<?php echo base_url('assets/img/gears.gif'); ?>"></span>
            </div>
        </div>
        <div id="tg-wrapper" class="tg-wrapper">
            <!--************************************
                                Header Start
                *************************************-->
            <header id="tg-dashboardheader" class="tg-dashboardheader tg-haslayout">
           
                <a id="tg-btnmenutoggle" href="javascript:void(0);" class="tg-btnmenutoggle"><i class="lnr lnr-menu"></i></a>
              
                <div class="tg-rightarea">
               
                    <div class="tg-userlogedin">
                  
                        <?php
                        //Get User Image
                        //Get Admin User Details
                        $logged_in_id = $this->ion_auth->user()->row()->id;
                        $user_description = $this->ion_auth->groups($logged_in_id)->row()->description;
                        $user_image = $this->ion_auth->users($logged_in_id)->row()->picture_name;
                        if (!empty($user_image)) {
                            ?>
                            <figure class="tg-userimg">
                                <img src="<?php echo base_url('uploads/' . html_purify($user_image)); ?>" alt="<?php echo html_purify($user_description); ?>">
                            </figure>
                        <?php } ?>
                        <div class="tg-username">
                            <h3><?php echo html_purify($user_description); ?></h3>
                        </div>
                        <nav class="tg-usernav">
                            <ul>
                                <li><a href="<?php echo site_url('admin/home'); ?>"><i class="ti-dashboard"></i><span>Dashboard</span></a></li>
                                <li class="menu-item-has-children page_item_has_children">
                                    <a href="<?php echo site_url('Auth/index'); ?>"><i class="ti-user"></i><span>Users Management</span></a>
                                    <ul class="sub-menu children">
                                        <li><a href="<?php echo site_url('admin/show_record_detail'); ?>">User Details</a></li>
                                    </ul>
                                </li>
                                <!--<li><a href="<?php //echo site_url('admin/show_form');          ?>">Add Records</a></li>-->
                                <li class="menu-item-has-children page_item_has_children"> 
                                    <?php $current_date_year = date('Y');
                                            debug($current_date_year);exit;
                                    
                                    ?>
                                    <a href="<?php echo base_url('index.php/admin/display_all/' . $current_date_year . '/recent'); ?>"><i class="ti-align-left"></i><span>View Records</span></a>
                                    <ul class="sub-menu children">
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/' . $current_date_year . '/all'); ?>">2019 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2018/all'); ?>">2018 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2017/all'); ?>">2017 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2016/all'); ?>">2016 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2015/all'); ?>">2015 Reports</a></li>
                                    </ul>
                                </li>
                                <!--<li><a href="<?php // echo site_url('admin/upload_center');         ?>">Upload Center</a></li>-->
                                <li><a href="<?php echo site_url('admin/general_settings'); ?>"><i class="ti-settings"></i><span>Settings</span></a></li>
                                <li><a href="<?php echo site_url('admin/record_tracking'); ?>"><i class="ti-arrow-top-right"></i><span>Track</span></a></li>
                                <li><a href="<?php echo site_url('admin_tracking/SearchTracking/track_session_records_status'); ?>"><i class="ti-filter"></i><span>Track Rec Status</span></a></li>
                                <li class="menu-item-has-children page_item_has_children">
                                    <a href="javascript:;"><i class="ti-file"></i><span>Invoices</span></a>
                                    <ul class="sub-menu children">
                                        <li><a href="<?php echo base_url('index.php/admin/doctor_invoices_display/'); ?>">Doctor Invoices</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/admin_invoices_display/'); ?>">Hospital Invoices</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo site_url('admin/reports_page'); ?>"><i class="ti-write"></i><span>Reports</span></a></li>
                                <!--<li class="bg-danger dropdown">
                                    <a href="<?php //echo site_url('admin/reports_page');                           ?>">Reports<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php //echo site_url('admin_tracking/tracking/tracking');                           ?>">Tracking</a></li>
                                        <li><a href="<?php //echo site_url('admin_tracking/tracking/display_tracking');                           ?>">Tracking List</a></li>
                                    </ul>
                                </li>-->
                                <li><a href="<?php echo base_url('index.php/auth/logout'); ?>"><i class="ti-shift-right"></i><span>Logout </span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div id="tg-sidebarwrapper" class="tg-sidebarwrapper">
                    <div class="tg-verticalscrollbar">
                        <div class="tg-logoarea">
                            <a class="tg-logoicon" href="<?php echo base_url('index.php/'); ?>">
                                <img src="<?php echo base_url('assets/img/logo-icon.png'); ?>" alt="Uralensis Dashboard">
                            </a>
                            <strong class="tg-logo"><a href="<?php echo base_url('index.php/'); ?>">
                                    <img src="<?php echo base_url('assets/img/admin_logo.png'); ?>" alt="Uralensis Dashboard"></a>
                            </strong>
                        </div>
                        <nav id="tg-dashboardnav" class="tg-dashboardnav">
                            <ul>
                                <li class="tg-activenav tg-insightesnoti tg-notificationicon current-menu-item">
                                    <a href="<?php echo site_url('admin/home'); ?>"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                                </li>
                                <li class="tg-packagesnoti menu-item-has-children page_item_has_children">
                                    <a href="<?php echo site_url('Auth/index'); ?>"><i class="ti-user"></i><span>Users Management</span></a>
                                    <ul class="sub-menu children">
                                        <li><a href="<?php echo site_url('admin/show_record_detail'); ?>">User Details</a></li>
                                    </ul>
                                </li>
                                <!--<li><a href="<?php //echo site_url('admin/show_form');          ?>">Add Records</a></li>-->
                                <li class="tg-packagesnoti menu-item-has-children page_item_has_children"> 
                                    <?php $current_date_year = date('Y'); ?>
                                    <a href="<?php echo base_url('index.php/admin/display_all/' . $current_date_year . '/recent'); ?>"><i class="ti-align-left"></i><span>View Records</span></a>
                                    <ul class="sub-menu children">
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/' . $current_date_year . '/all'); ?>">2019 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2018/all'); ?>">2018 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2017/all'); ?>">2017 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2016/all'); ?>">2016 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2015/all'); ?>">2015 Reports</a></li>
                                    </ul>
                                </li>
                                <!--<li><a href="<?php // echo site_url('admin/upload_center');         ?>">Upload Center</a></li>-->
                                <li><a href="<?php echo site_url('admin/general_settings'); ?>"><i class="ti-settings"></i><span>Settings</span></a></li>
                                <li><a href="<?php echo site_url('admin/record_tracking'); ?>"><i class="ti-arrow-top-right"></i><span>Track</span></a></li>
                                <li><a href="<?php echo site_url('admin_tracking/SearchTracking/track_session_records_status'); ?>"><i class="ti-filter"></i><span>Track Rec Status</span></a></li>
                                <li class="tg-packagesnoti menu-item-has-children page_item_has_children">
                                    <a href="javascript:;"><i class="ti-file"></i><span>Invoices</span></a>
                                    <ul class="sub-menu children">
                                        <li><a href="<?php echo base_url('index.php/admin/doctor_invoices_display/'); ?>">Doctor Invoices</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/admin_invoices_display/'); ?>">Hospital Invoices</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo site_url('admin/reports_page'); ?>"><i class="ti-write"></i><span>Reports</span></a></li>
                                <!--<li class="bg-danger dropdown">
                                    <a href="<?php //echo site_url('admin/reports_page');                           ?>">Reports<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php //echo site_url('admin_tracking/tracking/tracking');                           ?>">Tracking</a></li>
                                        <li><a href="<?php //echo site_url('admin_tracking/tracking/display_tracking');                           ?>">Tracking List</a></li>
                                    </ul>
                                </li>-->
                                <li><a href="<?php echo base_url('index.php/auth/logout'); ?>"><i class="ti-shift-right"></i><span>Logout</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
            <!--************************************
                            Header End
            *************************************-->
            <!--************************************
               Breadcrumbs Start 
            *************************************-->
            <div id="tg-dashboardbanner" class="tg-dashboardbanner">
                <?php
                if (!empty($breadcrumbs)) {
                    echo $breadcrumbs;
                }
                ?>
            </div>
            <!--************************************
                Breadcrumbs End
            *************************************-->
            <!--************************************
                                Main Start
                *************************************-->
            <main id="tg-main" class="tg-main tg-haslayout">
