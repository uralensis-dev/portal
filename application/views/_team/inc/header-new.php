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
<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/newtheme/img/favicon.png" />
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/bootstrap.min.css'); ?>">

    <!-- Fontawesome CSS -->

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/font-awesome.min.css'); ?>">

    <!-- Lineawesome CSS -->

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/line-awesome.min.css'); ?>">

    <!-- Datatable CSS -->

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/dataTables.bootstrap4.min.css'); ?>">

    <!-- Select2 CSS -->

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/select2.min.css'); ?>">

    <!-- Stickey CSS -->

     <link rel="stylesheet" href="<?php echo base_url('/assets/css/sticky.css'); ?>">

    <!-- Datetimepicker CSS -->

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/bootstrap-datetimepicker.min.css'); ?>">

    <!-- Datetimepicker CSS -->

    <!-- Tagsinput CSS -->

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'); ?>">

    <!--Full Calendar CSS Files-->

    <link href='<?php echo base_url('/assets/fullcalendar/core/main.css'); ?>' rel='stylesheet'/>

    <link href='<?php echo base_url('/assets/fullcalendar/daygrid/main.css'); ?>' rel='stylesheet'/>

    <!--Full Calendar CSS Files-->

    <!-- Summernote CSS -->

    <!-- <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/plugins/summernote/dist/summernote-bs4.css'); ?>"> -->

    <!-- Main CSS -->

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/style.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/project_employee.css'); ?>">

    <?php
    if (!empty($styles)) {
        foreach ($styles as $value) {
            ?>
            <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>assets/<?php echo $value; ?>"/>
            <?php
        }
    }
    ?>

    <script>

        var BASE_URL  = "<?php echo site_url();?>";

    </script>
<style>

</style>
</head>



<body>

<!-- Main Wrapper -->

<div class="main-wrapper">

    <!-- Header -->

    <div class="header">

        <!-- Logo -->

        <!-- <div class="header-left">

            <a href="index.html" class="logo">

                <img src="assets/img/logo.png" width="40" height="40" alt="">

            </a>

        </div> -->

        <!-- /Logo -->

        <a id="toggle_btn" href="javascript:void(0);">

                <span class="bar-icon">

                    <span></span>

                    <span></span>

                    <span></span>

                </span>

        </a>

        <!-- Header Title -->

        <div class="page-title-box">

            <h3>PathHub</h3>

        </div>

        <!-- /Header Title -->

        <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

        <!-- Header Menu -->
        <form class="tg-formtheme tg-searchrecord">
            <fieldset>
                <div class="form-group tg-inputicon">
                    <input type="text" class="form-control typeahead" placeholder="Search Record">
                    <i class="lnr lnr-magnifier"></i>
                </div>
            </fieldset>
        </form>

        <ul class="nav user-menu">

            <!-- Search -->

            <li class="nav-item">

                <div class="top-nav-search">

                    <a href="javascript:void(0);" class="responsive-search">

                        <i class="fa fa-search"></i>

                    </a>

                   <!-- <form action="search.html">

                        <input class="form-control" type="text" placeholder="Search here">

                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>

                    </form>-->

                </div>

            </li>

            <!-- /Search -->

            <!-- Flag -->

            <li class="nav-item dropdown has-arrow flag-nav">

                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">

                    <img src="<?php echo base_url('/assets/newtheme/img/flags/us.png'); ?>" alt="" height="20"> <span>English</span>

                </a>

                <div class="dropdown-menu dropdown-menu-right">

                    <a href="javascript:void(0);" class="dropdown-item">

                        <img src="<?php echo base_url('/assets/newtheme/img/flags/us.png'); ?>" alt="" height="16"> English

                    </a>

                    <a href="javascript:void(0);" class="dropdown-item">

                        <img src="<?php echo base_url('/assets/newtheme/img/flags/fr.png'); ?>" alt="" height="16"> French

                    </a>

                    <a href="javascript:void(0);" class="dropdown-item">

                        <img src="<?php echo base_url('/assets/newtheme/img/flags/es.png'); ?>" alt="" height="16"> Spanish

                    </a>

                    <a href="javascript:void(0);" class="dropdown-item">

                        <img src="<?php echo base_url('/assets/newtheme/img/flags/de.png'); ?>" alt="" height="16"> German

                    </a>

                </div>

            </li>

            <!-- /Flag -->

            <?php if ($this->ion_auth->in_group('admin')): ?>
                <!-- /Flag -->
                <li class="new-item">
                    <a href="<?php echo base_url('index.php/institute/bookingin'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/add_new.png" class="img-responsive" />
                    </a>
                </li>
                <li class="new-item"><?php $current_date_year = date('Y'); ?>
                    <a href="<?php echo base_url('index.php/admin/display_all/' . $current_date_year . '/all'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/white/publish.png" class="img-responsive" />
                        <span class="badge badge-pill">
                            <?php
                            if (function_exists('getTotalNumberOfRecords')) {
                                echo getTotalNumberOfRecords();
                            }
                            ?>
                        </span>
                    </a>
                </li>

                <li class="new-item">
                    <a href="<?php echo base_url('index.php/institute/doctor_record_list'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/white/unpublish.png" class="img-responsive" />
                        <span class="badge badge-pill">
                            <?php
                            if (function_exists('requestedPagesFutherWork')) {
                                echo requestedPagesFutherWork();
                            } ?>
                        </span>
                    </a>
                </li>

                <li class="new-item" >
                    <a href="<?php echo base_url('index.php/admin/view_further_work?fw_page=requested'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/white/Further-work.png" class="img-responsive further-work-img" />

                        <span class="badge badge-pill">
                            <?php
                            if (function_exists('completedPagesFutherWork')) {
                                echo completedPagesFutherWork();
                            } ?>
                        </span>
                    </a>
                </li>
                
                <?php endif; ?>
                <?php if ($this->ion_auth->in_group('Pathologist')): ?>
                <li class="new-item">
                    <a href="<?php echo base_url('index.php/institute/bookingin'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/add_new.png" class="img-responsive" />
                    </a>
                </li>
                <li class="new-item"><?php $date_year = date('Y'); ?>
                    <a href="<?php echo base_url('index.php/institute/published_reports_new/' . $date_year . '/all'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/white/publish.png" class="img-responsive" />
                        <span class="badge badge-pill">
                            <?php
                            if (function_exists('uralensis_get_doctor_publish_records_count')) {
                                uralensis_get_doctor_publish_records_count('reported');
                            }
                            ?>
                        </span>
                    </a>
                </li>
                
                <li class="new-item">
                    <a href="<?php echo base_url('index.php/institute/doctor_record_list'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/white/unpublish.png" class="img-responsive" />
                        <span class="badge badge-pill">
                            <?php
                            if (function_exists('uralensis_get_doctor_publish_records_count')) {
                                uralensis_get_doctor_publish_records_count('unreported');
                            } ?>
                        </span>
                    </a>
                </li>

                <li class="new-item">
                    <a href="<?php echo base_url('index.php/institute/view_further_work?fw_page=requested'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/white/Further-work.png" class="img-responsive further-work-img" />

                        <span class="badge badge-pill">
                            <?php
                            if (function_exists('uralensis_get_doctor_further_work_data_count')) {
                                echo uralensis_get_doctor_further_work_data_count();
                            } ?>
                        </span>
                    </a>
                </li>
                
                    <?php endif; ?>


            <!-- Notifications -->

            <li class="nav-item dropdown">

                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                    <i class="fa fa-bell-o"></i> <span class="badge badge-pill"><?php echo count(getNotificationCount($this->ion_auth->user()->row()->id)); ?></span>

                </a>

                <div class="dropdown-menu notifications notification">

                    <div class="topnav-dropdown-header">

                        <span class="notification-title">Notifications</span>

                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>

                    </div>

                    <div class="noti-content">

                        <ul class="notification-list">



                        <?php $notification = getNotificationCount($this->ion_auth->user()->row()->id);

                        if(count(getNotificationCount($this->ion_auth->user()->row()->id)) > 0){



                            foreach($notification as $rec){



                                ?>

                                 <li class="notification-message">

                                <a href="javascript:">

                                    <div class="media">

<!--                                            <span class="avatar">-->
<!--                                                <img alt="" src="--><?php //echo base_url('/assets/newtheme/img/profiles/avatar-02.jpg'); ?><!--">-->
<!--                                            </span>-->

                                        <div class="media-body">

                                            <p class="noti-details"><?php echo $rec->notification?>></p>

                                            <p class="noti-time"><span class="notification-time"><?php echo date("d,M,Y h:m",strtotime($rec->startdate))?></span></p>

                                        </div>

                                    </div>

                                </a>

                            </li>

                                <?php 



                            }

                        }

                         ?>





                           

                            

                        </ul>

                    </div>

                   <!-- <div class="topnav-dropdown-footer">

                        <a href="javascript:">View all Notifications</a>

                    </div>-->

                </div>

            </li>

            <!-- /Notifications -->

            <!-- Message Notifications -->

            <li class="nav-item dropdown">

                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                    <i class="fa fa-comment-o"></i> <span class="badge badge-pill"><?php echo count(getUnreadMessagesCounter(intval($this->ion_auth->user()->row()->id))); ?></span>

                </a>

                 <?php 

                

                            

                          

                 

                 $messagescount = getUnreadMessagesCounter(intval($this->ion_auth->user()->row()->id));

                       if(count($messagescount) > 0 ){ ?>

                <div class="dropdown-menu notifications comments">

                    <div class="topnav-dropdown-header">

                        <span class="notification-title">Messages</span>

                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>

                    </div>

                    <div class="noti-content">

                        <ul class="notification-list">



                      <?php 

                          $messages = getMessagesForDashbaord(intval($this->ion_auth->user()->row()->id));

                          //debug($messages);exit;

                           foreach($messages as $rec){

                             



                       

                        ?> 

                            <li class="notification-message">

                                <a href="javascript:">

                                    <div class="list-item">

                                        <div class="list-left">

                                                <span class="avatar">

                                                <?php if($rec->profile_picture_path!=""){ ?>

                                                    <img alt="" src="<?php echo base_url($rec->profile_picture_path); ?>" />

                                                    <?php }else{?>

                                                   

                                                         <img alt="" src="<?php echo base_url('/assets/img/dummy-doctors.jpg'); ?>" />

                                                   <?php  }?>

                                                </span>

                                        </div>

                                        <div class="list-body">

                                            <span class="message-author"><?php echo $rec->enc_first_name." ".$rec->enc_last_name?> </span>

                                            <span class="message-time"><?php echo date("d,M,Y h:m",strtotime($rec->privmsg_date))?></span>

                                            <div class="clearfix"></div>

                                            <span class="message-content"><?php echo $rec->privmsg_body?></span>

                                        </div>

                                    </div>

                                </a>

                            </li>

                            <?php }?>

                           

                        </ul>

                    </div>

                   

                    <div class="topnav-dropdown-footer">

                        <a href="<?php echo site_url('pm/index'); ?>">View all Messages</a>

                    </div>

                   

                </div>

                 <?php } ?>

            </li>

            <!-- /Message Notifications -->

            <li class="nav-item dropdown has-arrow main-drop">

                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                <?php $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id)); ?>

                        <span class="user-img">

                            <!-- <img src="<?php //echo $userinfo[0]->profile_picture_path; ?>" alt=""> -->

                            <img src="<?php echo  base_url() ?>assets/img/dummy-doctors.jpg"/>

                        <span class="status online"></span></span>

                    <span>I am Online</span>

                </a>

                <div class="dropdown-menu">

                    <a class="dropdown-item" href="<?php echo base_url() ?>auth/edit_user/<?php echo $this->ion_auth->user()->row()->id?>">My Profile</a>

                    <!-- <a class="dropdown-item" href="<?php echo base_url();?>comms/chat">Chat</a> -->

                    <a class="dropdown-item" href="<?php echo base_url('Settings'); ?>">Settings</a>

                    <?php if ($_SESSION['admin_id']) { ?>

                    <a class="dropdown-item" href="<?php echo base_url('index.php/institute/switchUserAccountToAdmin/'.$_SESSION['admin_id']); ?>">Logout to Admin</a>

                   

                    <?php 

                    } else { ?>

                    <a class="dropdown-item" href="<?php echo base_url('index.php/auth/logout'); ?>">Logout</a>

                                <?php 

                    } ?>

                </div>

            </li>

        </ul>

        <!-- /Header Menu -->

        <!-- Mobile Menu -->

        <div class="dropdown mobile-user-menu">

            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

            <div class="dropdown-menu dropdown-menu-right">

                <a class="dropdown-item" href="<?php echo  base_url() ?>auth/edit_user/194">My Profile</a>

                <a class="dropdown-item" href="<?php echo site_url('Settings'); ?>">Settings</a>

                <a class="dropdown-item" href="<?php echo base_url('index.php/auth/logout'); ?>">Logout</a>

            </div>

        </div>

        <!-- /Mobile Menu -->

    </div>

    <!-- /Header -->

    <!-- Sidebar -->

    <div class="sidebar" id="sidebar">

        <div class="sidebar-inner slimscroll">

            <div id="sidebar-menu" class="sidebar-menu">

                <?php genMenu()?>

            </div>

        </div>

    </div>

    <!-- /Sidebar -->

    <!-- Page Wrapper -->

    <div class="page-wrapper">

        <!-- Page Content -->

        <div class="content container-fluid">

        

        

   