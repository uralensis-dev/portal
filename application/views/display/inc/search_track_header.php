<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
        <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/redmond.datepick.css'); ?>">
        <link href="<?php echo base_url('/assets/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/bootstrap-datetimepicker-standalone.css'); ?>" rel="stylesheet" />
        <script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
        <link href="<?php echo base_url('/assets/css/jquery-ui.css'); ?>" rel="stylesheet" /> 
        <link href="<?php echo base_url('/assets/css/owl.carousel.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/owl.theme.default.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/linearicons.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/scrollbar.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/font-awesome.min.css'); ?>" rel="stylesheet" />
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
    </head>
    <body class="uralensis tg-userlogin tg-dashboard">
        <div id="ajax_loading_effect">
            <div class="ajax_loader">
                <span><img src="<?php echo base_url('assets/img/gears.gif'); ?>"></span>
            </div>
        </div>
        <div id="tg-wrapper" class="tg-wrapper">
            <header id="tg-dashboardheader" class="tg-dashboardheader tg-haslayout">
                <a id="tg-btnmenutoggle" href="javascript:void(0);" class="tg-btnmenutoggle"><i class="lnr lnr-menu"></i></a>
                <div class="tg-rightarea">
                    <div class="tg-userlogedin">
                        <?php
                        //Get User Image
                        //Get Admin User Details
                        $user_description = $this->ion_auth->groups()->row()->description;
                        $user_image = $this->ion_auth->users()->row()->picture_name;
                        if (!empty($user_image)) {
                            ?>
                            <figure class="tg-userimg">
                                <img src="<?php echo base_url('uploads/' . $user_image); ?>" alt="<?php echo $user_description; ?>">
                            </figure>
                        <?php } ?>
                        <div class="tg-username">
                            <h3><?php echo $user_description; ?></h3>
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
                                <li class="menu-item-has-children page_item_has_children"> 
                                    <?php $current_date_year = date('Y'); ?>
                                    <a href="<?php echo base_url('index.php/admin/display_all/' . $current_date_year . '/recent'); ?>"><i class="ti-align-left"></i><span>View Records</span></a>
                                    <ul class="sub-menu children">
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/' . $current_date_year . '/all'); ?>">2018 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2017/all'); ?>">2017 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2016/all'); ?>">2016 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2015/all'); ?>">2015 Reports</a></li>
                                    </ul>
                                </li>
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
                                <li><a href="<?php echo base_url('index.php/auth/logout'); ?>"><i class="ti-shift-right"></i><span>Logout</span></a></li>
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
                                <li class="tg-packagesnoti menu-item-has-children page_item_has_children"> 
                                    <?php $current_date_year = date('Y'); ?>
                                    <a href="<?php echo base_url('index.php/admin/display_all/' . $current_date_year . '/recent'); ?>"><i class="ti-align-left"></i><span>View Records</span></a>
                                    <ul class="sub-menu children">
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/' . $current_date_year . '/all'); ?>">2018 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2017/all'); ?>">2017 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2016/all'); ?>">2016 Reports</a></li>
                                        <li><a href="<?php echo base_url('index.php/admin/display_all/2015/all'); ?>">2015 Reports</a></li>
                                    </ul>
                                </li>
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
                                <li><a href="<?php echo base_url('index.php/auth/logout'); ?>"><i class="ti-shift-right"></i><span>Logout</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
            <div id="tg-dashboardbanner" class="tg-dashboardbanner">
                <h1>Declined Requests</h1>
                <ol class="tg-breadcrumb">
                    <li><a href="dashboard.html">Dashboard</a></li>
                    <li><a href="javascript:void(0);">Declined Requests</a></li>
                </ol>
            </div>
            <main id="tg-main" class="tg-main tg-haslayout">
                <div class="content">
