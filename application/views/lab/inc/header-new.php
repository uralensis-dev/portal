<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pathhub | Digital Pathology LIMS Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/newtheme/img/favicon.png" />

    <link href="<?php echo base_url('/assets/css/jquery-ui.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/css/bootstrap-select.min.css'); ?>" rel="stylesheet" />

    <link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/redmond.datepick.css'); ?>">
    <link href="<?php echo base_url('/assets/css/linearicons.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/css/scrollbar.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/css/jquery-te-1.4.0.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/css/themify-icons.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo (base_url('/assets/css/slick.css')) ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/slick-theme.css') ?>" />
    <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />

   
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/font-awesome.min.css') ?>">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/line-awesome.min.css'); ?>">

    <!-- Chart CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/plugins/morris/morris.css') ?>">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/style.css') ?>">

    <!-- Main Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/custom-styles.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/components.css') ?>">


    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/smart_wizard.min.css') ?>">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/select2.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/new_jquery.datetimepicker.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/filepond.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/smart_wizard.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/custom-styles.css') ?>">
    <?php
    if (!empty($styles)) {
        foreach ($styles as $value) {
            ?>
            <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>/assets/<?php echo $value; ?>"/>
            <?php
        }
    }
    ?>

    <script src="<?php echo base_url('/assets/newtheme/js/jquery-3.2.1.min.js'); ?>"></script>   
</head>

<body>
    <div id="ajax_loading_effect">
        <div class="ajax_loader">
            <span><img src="<?php echo base_url('assets/img/gears.gif'); ?>"></span>
        </div>
    </div>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Header -->
        <div class="header">

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
            <form class="tg-formtheme tg-searchrecord">
                <fieldset>
                    <div class="form-group tg-inputicon">
                        <input type="text" class="form-control typeahead" placeholder="Search Record">
                        <i class="lnr lnr-magnifier"></i>
                    </div>
                </fieldset>
            </form>
            <!-- Header Menu -->
            <ul class="nav user-menu">
                <!-- Search -->
                <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        
                    </div>
                </li>
                <!-- /Search -->
                <!-- Flag -->
                <li class="nav-item dropdown has-arrow flag-nav">
                    
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
                 <?php
                $group_row = $this->ion_auth->get_users_groups()->row();
                $group_type = $group_row->group_type;
                ?>
                <?php if (in_array($group_type,LAB_GROUP)) : ?>
                    <li class="new-item">
                        <a href="<?php echo base_url('index.php/institute/bookingin'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/add_new.png" class="img-responsive" />
                        </a>
                    </li>
                   
                    <li class="new-item" title='Publish'><?php $date_year = date('Y'); ?>
                        <a href="<?php echo base_url('lab/published_reports/' . $date_year . '/all'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/white/publish.png" class="img-responsive" />
                            <span class="badge badge-pill"  id='reported_counter'>0</span>
                        </a>
                    </li>

                    <li class="new-item" title='Unpublish'>
                        <a href="<?php echo base_url('index.php/lab/lab_record_list'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/white/unpublish.png" class="img-responsive" />
                            <span class="badge badge-pill" id='unreported_counter'>0</span>
                        </a>
                    </li>

                    <li class="new-item" title='Furhter Work' >
                        <a href="<?php echo base_url('index.php/lab/view_further_work?fw_page=requested'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/white/Further-work.png" class="img-responsive further-work-img" />
                            <span class="badge badge-pill" id="further_work_counter">0</span>
                        </a>
                    </li>
                    
                <?php endif; ?>
                
                <?php if ($group_type=="D") : ?>
                
                <li class="new-item">
                    <a href="<?php echo base_url('index.php/institute/bookingin'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/add_new.png" class="img-responsive" />
                    </a>
                </li>
                <li class="new-item"><?php $date_year = date('Y'); ?>
                    <a href="<?php echo base_url('index.php/lab/published_reports/' . $date_year . '/all'); ?>" class="nav-link">
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
                    <a href="<?php echo base_url('lab/lab_record_list'); ?>" class="nav-link">
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
                    <a href="<?php echo base_url('index.php/lab/view_further_work?fw_page=requested'); ?>" class="nav-link">
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
                <li class="new-item" title='Enquiry'>
                    <a href="<?php echo base_url('labEnquiries'); ?>" class="nav-link">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge badge-pill" id="enquiry_count">0</span>
                    </a>
                </li>
                <!-- Notifications -->
                <li class="nav-item dropdown" title='Notification'>
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i> <span class="badge badge-pill" id="notification_counter">0</span>
                    </a>
                    <div class="dropdown-menu notifications notification">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">

                                <?php $notification = getNotificationCount($this->ion_auth->user()->row()->id);
                                if (count(getNotificationCount($this->ion_auth->user()->row()->id)) > 0) {

                                    foreach ($notification as $rec) {

                                ?>
                                        <li class="notification-message">
                                            <a href="<?php echo ($rec->redirect_url!=""?base_url($rec->redirect_url):'javascript:void(0)'); ?>">
                                                <div class="media">

                                                    <div class="media-body">
                                                        <p class="noti-details"><?php echo  $rec->notification ?></p>
                                                        <p class="noti-time"><span class="notification-time"><?php echo  date("d,M,Y h:m", strtotime($rec->startdate)) ?></span></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                <?php

                                    }
                                }
                                ?>

                            </ul>
                            <div class="view_more_btn"><a href="javascript:;"> View More </a></div>
                        </div>
                    </div>
                </li>
               
                <li class="nav-item dropdown hidden">

                    <a href="<?php echo site_url('pm/index'); ?>" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="<?php echo base_url()?>assets/img/comment-bubble-white.png" alt="" class="img-responsive" /> <span class="badge badge-pill"><?php echo count(getUnreadMessagesCounter(intval($this->ion_auth->user()->row()->id)));
                    ?></span>
                    </a>
                    <?php

                    $messagescount = getUnreadMessagesCounter(intval($this->ion_auth->user()->row()->id));
                    if (count($messagescount) > 0) { ?>
                        <div class="dropdown-menu notifications comments">
                            <div class="topnav-dropdown-header">
                                <span class="notification-title"><a href="<?php echo site_url('pm/index'); ?>">Messages</a></span>
                                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                            </div>
                            <div class="noti-content">
                                <ul class="notification-list">

                                    <?php
                                    $messages = getMessagesForDashbaord(intval($this->ion_auth->user()->row()->id));
                                    foreach ($messages as $rec) {
                                    ?>
                                        <li class="notification-message">
                                            <a href="<?php echo (base_url() . '/pm/message/' . $rec->privmsg_id); ?>">
                                                <div class="list-item">
                                                    <div class="list-left">
                                                        <span class="avatar">
                                                            <?php if ($rec->profile_picture_path != "") { ?>
                                                                <img alt="" src="<?php echo base_url($rec->profile_picture_path); ?>" />
                                                            <?php } else { ?>

                                                                <img alt="" src="<?php echo base_url('/assets/img/dummy-doctors.jpg'); ?>" />
                                                            <?php  } ?>
                                                        </span>
                                                    </div>
                                                    <div class="list-body">
                                                        <span class="message-author"><?php echo  $rec->enc_first_name . " " . $rec->enc_last_name ?> </span>
                                                        <span class="message-time"><?php echo  date("d,M,Y h:m", strtotime($rec->privmsg_date)) ?></span>
                                                        <div class="clearfix"></div>
                                                        <span class="message-content"><?php echo  $rec->privmsg_body ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>

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
                        <span class="user-img"><img src="<?php echo base_url($userinfo[0]->profile_picture_path); ?>" alt="">
                            <span class="status online"></span></span>
                        <span><?php echo $userinfo[0]->first_name. ' '.$userinfo[0]->last_name; ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url() ?>auth/edit_user/<?php echo  $this->ion_auth->user()->row()->id ?>">My Profile</a>
                       
                        <?php if (in_array($group_type,HOSPITAL_GROUP)) : ?>
                       <a class="dropdown-item" href="<?php echo base_url('institute/settings'); ?>">Settings</a>
                      <?php endif; ?>
                      <?php if (in_array($group_type,LAB_GROUP)) : ?>
                       <a class="dropdown-item" href="<?php echo base_url('laboratory/labsetting'); ?>">Settings</a>
                      <?php endif; ?>
                       
                       
                       
                       
                       
                        <?php if ($_SESSION['admin_id']) { ?>
                            <a class="dropdown-item" href="<?php echo base_url('index.php/institute/switchUserAccountToAdmin/' . $_SESSION['admin_id']); ?>">Logout to Admin</a>

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
                
                    <a class="dropdown-item" href="<?php echo site_url('admin/general_settings'); ?>">Settings</a>
                
                    <?php if ($_SESSION['admin_id']) { ?>
                        <a class="dropdown-item" href="<?php echo base_url('index.php/institute/switchUserAccountToAdmin/' . $_SESSION['admin_id']); ?>">Logout to Admin</a>

                        <?php
                    } else { ?>
                        <a class="dropdown-item" href="<?php echo base_url('index.php/auth/logout'); ?>">Logout</a>
                        <?php
                    } ?>
                </div>
            </div>
            <!-- /Mobile Menu -->
        </div>

        <!-- / Header -->
        <!-- Sidebar -->

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <?php genMenu() ?>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->


        <!-- Page Wrapper -->
        <div class="page-wrapper sidebar-patient">