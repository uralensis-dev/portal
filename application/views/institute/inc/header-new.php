<?php defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Pathhub | Digital Pathology LIMS Software</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/newtheme/img/favicon.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/dataTables.bootstrap4.min.css">

    <link href="<?php echo base_url() ?>assets/css/linearicons.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/scrollbar.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/jquery-te-1.4.0.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/themify-icons.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/slick-theme.css" />

   <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/newtheme/css/font-awesome.min.css">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/newtheme/css/line-awesome.min.css">

    <!-- Chart CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/plugins/morris/morris.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/style.css">


    <!-- Main Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/smart_wizard.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/select2.min.css">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/filepond.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/smart_wizard.min.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/doctor/css/custom-styles.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/components.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/style.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/custom-styles.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/institute/css/custom-styles.css">
    <script src="<?php echo base_url() ?>/assets/institute/js/jquery-3.2.1.min.js"></script>
    <!-- Main CSS -->
    <?php
    if (!empty($styles)) {
    foreach ($styles as $value) {
    ?>
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>assets/<?php echo $value; ?>" />
    <?php
    }
    }
    ?>

    <style type="text/css">
        .success {
            background: #468847;
            color: #ffffff;
        }

        .warning {
            background: #f89406;
            color: #ffffff;
        }

        .datepick-popup {
            z-index: 10000 !important;
        }

        .important {
            background: #b94a48;
            color: #ffffff;
        }

        .info {
            background: #3a87ad;
            color: #ffffff;
        }

        .hidden {
            display: none;
        }
    </style>

    <style>
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
    </style>

    <?php if($this->uri->segment('1')=='_dataset') { ?>
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            margin-left: 200px;
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
    </style>
    <style type="text/css">
        .radio-toolbar label {
            display: inline-block !important;
            line-height: 1 !important;
            background-color: #01b7f5 !important;
            color: white !important;
            padding: 50px 70px !important;
        }

        .title_dataset {
            padding: 0 !important;
            font-size: 20px !important;
            color: black !important;
            font-weight: bold !important;
            border: 0 !important;
        }

        label {
            font-weight: 600;
        }

        .tg-themeinputbtn li label {
            padding: 0;
            width: 28px;
            height: 28px;
            color: #263357;
            line-height: 26px;
            display: block;
            font-size: 12px;
            text-align: center;
            border-radius: 50px;
            border: 1px solid #ddd;
            text-transform: uppercase;
            font-weight: 700;
        }

        .tg-tinymceeditor {
            height: 160px !important
        }

        .btn.btn-rounded {
            border-radius: 50px;
        }

        .doctorCard .tg-themeinputbtn {
            width: 99.6%;
            position: absolute;
            bottom: 1px;
            left: 1px;
            padding-left: 22px;
            background: transparent !important;
        }

        .sec_title, .sec_title a {
            font-size: 18px;
            font-weight: 500;
            color: #000;
        }

        .delete_add_specimen {
            float: right;
            margin: 0 0 0 20px;
        }

            .delete_add_specimen a.tg-detailsicon {
                width: 32px;
                height: 32px;
                line-height: 32px;
                font-size: 17px;
                float: right;
                margin: 0 3px;
            }

                .delete_add_specimen a.tg-detailsicon + a.tg-detailsicon {
                    margin-left: 8px;
                }


        .slider {
            text-align: center;
            overflow: hidden;
        }

        .slides {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            /*
        scroll-snap-points-x: repeat(300px);
        scroll-snap-type: mandatory;
        */
        }

            .slides::-webkit-scrollbar {
            }

            .slides::-webkit-scrollbar-thumb {
                background: black;
                border-radius: 10px;
            }

            .slides::-webkit-scrollbar-track {
                background: transparent;
            }

            .slides > div {
                scroll-snap-align: start;
                flex-shrink: 0;
                border-radius: 10px;
                background: #eee;
                transform-origin: center center;
                transform: scale(1);
                transition: transform 0.5s;
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 100px;
                width: 100%;
            }

                .slides > div:target {
                    /*   transform: scale(0.8); */
                }

        .author-info {
            background: rgba(0, 0, 0, 0.75);
            color: white;
            padding: 0.75rem;
            text-align: center;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            margin: 0;
        }

            .author-info a {
                color: white;
            }

        .slider > a {
            display: inline-flex;
            width: 1.5rem;
            height: 1.5rem;
            background: white;
            text-decoration: none;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 0 0.5rem 0;
            position: relative;
        }

            .slider > a:active {
                top: 1px;
            }

            .slider > a:focus {
                background: #000;
            }

        .slides::-webkit-scrollbar {
            display: none; /* Safari and Chrome */
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #section-to-print, #section-to-print * {
                visibility: visible;
            }

            #section-to-print {
                position: absolute;
                left: 0;
                top: 0;
                width: 100% !important;
            }

            .print-btn {
                display: none;
            }
        }

        .sidebar_subtitle span {
            color: blue;
            font-weight: bold
        }
    </style>

    <style type="text/css">
        .breadcrumb li:first-child {
            padding-left: 0;
        }

            .breadcrumb li:first-child:before {
                display: none;
            }

        .success {
            background: #00c5fb;
            border-radius: 10px;
            margin-right: 5px;
            font-size: 12px;
            padding: 5px;
        }

        .radio-toolbar label {
            padding: 50px 15px !important;
            width: 100%;
        }

        i.fa.fa-angle-right,
        i.fa.fa-angle-left {
            font-size: 27px;
            margin: 0 10px;
            color: #ccc
        }

        .hidden {
            display: none;
        }

        .right_slide, .left_slide {
            position: absolute;
            right: 10px;
            top: 20px;
            z-index: 9999;
            font-size: 24px;
            background: #55ce63;
            color: #fff;
            padding: 5px;
            width: 40px;
            border-radius: 25px;
            text-align: center;
            height: 40px;
            line-height: 1.5;
        }

        .left_slide {
            right: auto;
            left: 10px;
        }

            .right_slide:hover, .left_slide:hover,
            .right_slide:focus, .left_slide:focus {
                color: #fff;
                background: #268031;
            }

        .radio-toolbar .new_label {
            padding: 10px 10px 0px;
            display: block;
            background: #01b7f5;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .slides > div {
            display: unset;
            padding: 20px 0;
            background: #f9f9f9;
        }

        #slide-7 .radio-toolbar label {
            min-height: 135px;
        }

        .sidebar_subtitle {
            margin-bottom: 6px;
        }

        .sidebar_subtitle {
            margin-left: 15px;
        }

            .sidebar_subtitle h3 {
                font-size: 20px;
            }

            .sidebar_subtitle span {
                color: #00c5fb;
            }

        .radio-toolbar h5, .radio-toolbar hr {
            margin-bottom: 20px;
        }

        i.fa.fa-pencil.icon_inside {
            position: absolute;
            right: 14px;
            padding: 10px;
            background: #01b7f5;
            color: #fff;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .radio_links {
            margin-top: 30px;
            width: 100%;
            text-align: center;
        }

            .radio_links .circle_carousel {
                border: 1px solid #ccc;
                width: 20px;
                height: 20px;
                border-radius: 10px;
                display: block;
            }

                .radio_links .circle_carousel:hover,
                .radio_links .circle_carousel:focus,
                .radio_links .circle_carousel.active {
                    background: #01b7f5;
                    border-color: #01b7f5;
                }

        @media print {
            #section-to-print {
                width: 100%;
            }

            .pts_bt {
                display: none
            }
        }
    </style>
    <style>

        .slides > div {
            display: flow-root !important;
        }
    </style>
    <?php } ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <div class="header">
            <!-- Logo -->
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
                <!-- /Flag -->
                
                <?php
               $group_row = $this->ion_auth->get_users_groups()->row();
               $group_type = $group_row->group_type;
                ?>
                
                <?php if(in_array($group_type,HOSPITAL_GROUP)) { ?>
                <!--
                 <li class="new-item">
                        <a href="<?php echo base_url('index.php/institute/bookingin'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/add_new.png" class="img-responsive" />
                        </a>
                    </li>-->
                
                <li class="new-item"><?php $date_year = date('Y'); ?>
                        <a href="<?php echo base_url('institute/reports/published'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/white/publish.png" class="img-responsive" />
                            <span class="badge badge-pill">
                                <?php uralensis_get_record_status_counter('reported'); ?>
                            </span>
                        </a>
                    </li>

                    <li class="new-item">
                        <a href="<?php echo base_url('institute/view_request_detailall'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/white/unpublish.png" class="img-responsive" />
                            <span class="badge badge-pill">
                                 <?php uralensis_get_record_status_counter('unreported'); ?>
                            </span>
                        </a>
                    </li>
                
                <li class="new-item">
                    <a href="<?php echo base_url('index.php/institute/further_display_work'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/white/Further-work.png" class="img-responsive further-work-img" />

                        <span class="badge badge-pill">
                            <?php echo uralensis_get_further_work_data(); ?>
                        </span>
                    </a>
                </li>

                
                
                <?php } if (in_array($group_type,LAB_GROUP)) { ?>
                
                    <li class="new-item">
                        <a href="<?php echo base_url('index.php/institute/bookingin'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/add_new.png" class="img-responsive" />
                        </a>
                    </li>
                    <li class="new-item"><?php $date_year = date('Y'); ?>
                        <a href="<?php echo base_url('lab/published_reports/' . $date_year . '/all'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/white/publish.png" class="img-responsive" />
                            <span class="badge badge-pill">
                                <?php uralensis_get_Labrecord_status_counter('reported'); ?>
                            </span>
                        </a>
                    </li>

                    <li class="new-item">
                        <a href="<?php echo base_url('lab/lab_record_list'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/white/unpublish.png" class="img-responsive" />
                            <span class="badge badge-pill">
                                 <?php uralensis_get_Labrecord_status_counter('unreported'); ?>
                            </span>
                        </a>
                    </li>

                    <li class="new-item">
                        <a href="<?php echo base_url('lab/view_further_work?fw_page=requested'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/white/Further-work.png" class="img-responsive further-work-img" />
                            <span class="badge badge-pill">
                                <?php echo uralensis_get_further_work_data(); ?>
                            </span>
                        </a>
                    </li>
                    
                    
                <?php }  if($group_type=="D") { ?>
                    <li class="new-item">
                        <a href="<?php echo base_url('index.php/institute/bookingin'); ?>" class="nav-link">
                            <img src="<?php echo base_url() ?>/assets/icons/add_new.png" class="img-responsive" />
                        </a>
                    </li>
                    <li class="new-item"><?php $date_year = date('Y'); ?>
                        <a href="<?php echo base_url('index.php/institute/published_reports_new/' . $date_year . '/all'); ?>" class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/white/publish.png" class="img-responsive"/>
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
                        <img src="<?php echo base_url() ?>/assets/icons/white/unpublish.png" class="img-responsive"/>
                        <span class="badge badge-pill">
                            <?php
                            if (function_exists('uralensis_get_doctor_publish_records_count')) {
                                uralensis_get_doctor_publish_records_count('unreported');
                            } ?>
                        </span>
                    </a>
                </li>

                <li class="new-item">
                    <a href="<?php echo base_url('index.php/institute/view_further_work?fw_page=requested'); ?>"
                       class="nav-link">
                        <img src="<?php echo base_url() ?>/assets/icons/white/Further-work.png"
                             class="img-responsive further-work-img"/>

                        <span class="badge badge-pill">
                            <?php
                            if (function_exists('uralensis_get_doctor_further_work_data_count')) {
                                echo uralensis_get_doctor_further_work_data_count();
                            } ?>
                        </span>
                    </a>
                </li>
                
                
                <?php } ?>
                
                <li class="new-item">
                    <a href="<?php echo base_url('index.php/pm'); ?>" class="nav-link">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge badge-pill">
                            <?php echo count(uralensis_get_total_inbox_msg()); ?>
                        </span>
                    </a>
                </li>
                
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
                                if (count(getNotificationCount($this->ion_auth->user()->row()->id)) > 0) {
                                foreach ($notification as $rec) {
                                ?>
                                <li class="notification-message">
                                    <a href="<?php echo ($rec->redirect_url != " " ? base_url($rec->redirect_url) : 'javascript:void(0)'); ?>">
                                        <div class="media">
                                            <!--                                                    <span class="avatar">-->
                                            <!--                                                        <img alt="" src="--><?php //echo base_url('/assets/newtheme/img/profiles/avatar-02.jpg');
                                            ?>
                                            <!--">-->
                                            <!--                                                    </span>-->
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
                        </div>
                    </div>
                </li>
                <!-- /Notifications -->
                <!-- Message Notifications -->
                <?php /*?><li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-comment-o"></i> <span class="badge badge-pill"><?php echo count(getUnreadMessagesCounter(intval($this->ion_auth->user()->row()->id))); ?></span>
                    </a>
                    <?php

                    $messagescount = getUnreadMessagesCounter(intval($this->ion_auth->user()->row()->id));
                    if (count($messagescount) > 0) { ?>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Messages</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <?php
                                $messages = getMessagesForDashbaord(intval($this->ion_auth->user()->row()->id));
                                foreach ($messages as $rec) {
                                ?>
                                <li class="notification-message">
                                    <a href="chat.html">
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
                </li><?php */?>
                <!-- /Message Notifications -->
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <?php $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id)); ?>
                        <span class="user-img">
                            <img src="<?php echo base_url($userinfo[0]->profile_picture_path); ?>" alt="">
                            <span class="status online"></span>
                        </span>
                        <span><?php echo $userinfo[0]->last_name . ' ' . $userinfo[0]->first_name; ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url() ?>auth/edit_user/<?php echo  $this->ion_auth->user()->row()->id ?>">My Profile</a>
                        <!-- <a class="dropdown-item" href="<?php //echo base_url();
                                                        ?>comms/chat">Chat</a> -->
                        
                      <?php if (in_array($group_type,HOSPITAL_GROUP)) : ?>
                      <a class="dropdown-item" href="<?php echo base_url('institute/settings'); ?>">Settings</a>
                      <?php endif; ?>
                      <?php if (in_array($group_type,LAB_GROUP)) : ?>
                      <a class="dropdown-item" href="<?php echo base_url('laboratory/labsetting'); ?>">Settings</a>
                      <?php endif; ?>
                        
                        
                        <?php if (isset($_SESSION['admin_id'])) { ?>
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
                    <a class="dropdown-item" href="<?php echo  base_url() ?>auth/edit_user/194">My Profile</a>
                    
                     <?php if (in_array($group_type,HOSPITAL_GROUP)) : ?>
                      <a class="dropdown-item" href="<?php echo base_url('institute/settings'); ?>">Settings</a>
                      <?php endif; ?>
                      <?php if (in_array($group_type,LAB_GROUP)) : ?>
                      <a class="dropdown-item" href="<?php echo base_url('laboratory/labsetting'); ?>">Settings</a>
                      <?php endif; ?>
                    <a class="dropdown-item" href="<?php echo base_url('index.php/auth/logout'); ?>">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
        </div>


        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <?php genMenu() ?>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->
        <div class="page-wrapper">
            <!-- Page Content -->
            <div class="container-fluid">
