<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Uralensis</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
        <link href="<?php echo base_url('/assets/css/jquery-ui.css'); ?>" rel="stylesheet" /> 
        <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" /> 
        <link href="<?php echo base_url('/assets/css/bootstrap-select.min.css'); ?>" rel="stylesheet" /> 
        
        <link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/redmond.datepick.css'); ?>">
        <link href="<?php echo base_url('/assets/css/linearicons.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/scrollbar.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/jquery-te-1.4.0.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/font-awesome.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/themify-icons.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />
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
    <body>
        <div id="ajax_loading_effect">
            <div class="ajax_loader">
                <span><img src="<?php echo base_url('assets/img/gears.gif'); ?>"></span>
            </div>
        </div>
        <div class="wrapper">
            <header id="tg-header" class="tg-header">
                <div class="tg-rightarea">
                    <nav class="tg-nav">
                        <ul>
                            <li>
                                <?php $date_year = date('Y'); ?>
                                <a href="<?php echo base_url('index.php/institute/published_reports_new/' . $date_year . '/all'); ?>">
                                    <span class="tg-notificationtag">
                                    <?php
                                    if (function_exists('uralensis_get_doctor_publish_records_count')) {
                                        uralensis_get_doctor_publish_records_count('reported', '');
                                    } ?>
                                    </span>
                                    <i class="lnr lnr-layers"></i>Reported
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/doctor_record_list'); ?>">
                                    <span class="tg-notificationtag">
                                    <?php
                                    if (function_exists('uralensis_get_doctor_publish_records_count')) {
                                        uralensis_get_doctor_publish_records_count('unreported', '');
                                    } ?>
                                    </span>
                                    <i class="lnr lnr-layers"></i> Unreported</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/view_further_work?fw_page=requested'); ?>">
                                    <span class="tg-notificationtag">
                                    <?php
                                    if (function_exists('uralensis_get_doctor_further_work_data_count')) {
                                        echo uralensis_get_doctor_further_work_data_count();
                                    } ?>
                                    </span>
                                    <i class="lnr lnr-briefcase"></i>Further Work</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/pm'); ?>">
                                    <span class="tg-notificationtag">
                                    <?php 
                                    if (function_exists('uralensis_get_total_inbox_msg')) {
                                        echo count(uralensis_get_total_inbox_msg());
                                       // echo last_query();
                                    } ?>
                                    </span>
                                    <i class="lnr lnr-envelope"></i>Emails</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="tg-userdropdown">
                        <i class="fa fa-angle-down"></i>
                        <?php
                        if (function_exists('uralensis_get_user_detail')) {
                            uralensis_get_user_detail('true', 'true', 'top');
                        }
                        ?>

                        <ul class="tg-themedropdownmenu">
                            <li class="<?php
                                        if ($this->uri->segment(2) == "") {
                                            echo "active";
                                        }
                                        ?>">
                                        <?php echo anchor('doctor', 'Dashboard'); ?></li>
                            <li class="<?php
                                        if ($this->uri->segment(2) == "doctor_record_list") {
                                            echo "active";
                                        }
                                        ?>"><?php echo anchor('institute/doctor_record_list', 'New Reports'); ?>
                            </li>
                            <li class="tg-privatemessages tg-hasdropdown"> 
                                <?php $current_date_year = date('Y'); ?>
                                <a class="tg-btntoggle" href="javascript:;">
                                    <i class="lnr lnr-database"></i>
                                    <span>Published Reports</span>
                                </a>
                                <ul class="tg-emailmenu">
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/published_reports_new/' . $current_date_year . '/all'); ?>">
                                            <span>2019 Reports</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/published_reports_new/2018/all'); ?>">
                                            <span>2018 Reports</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/published_reports_new/2017/all'); ?>">
                                            <span>2017 Reports</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/published_reports_new/2016/all'); ?>">
                                            <span>2016 Reports</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/published_reports_new/2015/all'); ?>">
                                            <span>2015 Reports</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?php
                                        if ($this->uri->segment(2) == "case_review_list") {
                                            echo "active";
                                        }
                                        ?>"><?php echo anchor('doctor/case_review_list', 'Review Cases'); ?>
                            </li>
                            <li class="<?php
                                        if ($this->uri->segment(2) == "doctor_opinion_cases") {
                                            echo "active";
                                        }
                                        ?>">
                                    <?php echo anchor('doctor/doctor_opinion_cases', 'Opinion Cases'); ?>
                            </li>
                            <li class="<?php
                                        if ($this->uri->segment(2) == "teaching_cases") {
                                            echo "active";
                                        }
                                        ?>"><?php echo anchor('doctor/teaching_cases', 'Teaching Cases'); ?></li>
                            <li class="tg-privatemessages tg-hasdropdown">
                                <a href="<?php echo base_url('index.php/doctor/mdt_cases_new'); ?>">
                                    <i class="lnr lnr-database"></i>
                                    <span>MDT Reports</span>
                                </a>
                            </li>
                            <li class="<?php
                                        if ($this->uri->segment(2) == "authorization_queue") {
                                            echo "active";
                                        }
                                        ?>">
                                    <?php echo anchor('doctor/authorization_queue', 'Authorization Queue'); ?>
                            </li>
                            <li class="tg-privatemessages tg-hasdropdown">
                                <a class="tg-btntoggle" href="javascript:;">
                                    <i class="lnr lnr-database"></i>
                                    <span>Further Work</span>
                                </a>
                                <ul class="tg-emailmenu">
                                    <li><a href="<?php echo base_url('index.php/institute/view_further_work?fw_page=requested'); ?>"><span>Requested</span></a></li>
                                    <li><a href="<?php echo base_url('index.php/institute/view_further_work?fw_page=completed'); ?>"><span>Completed</span></a></li>
                                </ul>
                            </li>
                            <li class="<?php
                                        if ($this->uri->segment(2) == "record_tracking") {
                                            echo "active";
                                        }
                                        ?>">
                                    <?php echo anchor('doctor/record_tracking', 'Track'); ?>
                            </li>
                            <?php if (isset($_SESSION['admin_id'])) { ?>
                                <li><?php echo anchor('doctor/switchUserAccountToAdmin/' . $_SESSION['admin_id'], 'Logout to Admin'); ?></li>
                            <?php 
                        } else { ?>
                                <li><?php echo anchor('auth/logout', 'Logout'); ?></li>
                            <?php 
                        } ?>
                        </ul>
                    </div>
                </div>
            </header>
            <style scoped>
                .tg-header{
                    background: url(<?php echo base_url('assets/img/header-bg.jpg'); ?>) no-repeat;
                    background-size:cover;
                }
            </style>
            <div class="content">