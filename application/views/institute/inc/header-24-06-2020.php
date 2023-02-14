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
        <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/linearicons.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/scrollbar.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/font-awesome.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/redmond.datepick.css'); ?>">
        <link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet" />
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
                                <a href="<?php echo base_url('index.php/institute/published_reports'); ?>">
                                    <span class="tg-notificationtag"><?php uralensis_get_record_status_counter('reported'); ?></span>
                                    <i class="lnr lnr-layers"></i>Reported
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/view_request_detailall'); ?>">
                                    <span class="tg-notificationtag"><?php uralensis_get_record_status_counter('unreported'); ?></span>
                                    <i class="lnr lnr-layers"></i> Unreported</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/further_display_work'); ?>">
                                    <span class="tg-notificationtag"><?php echo uralensis_get_further_work_data(); ?></span>
                                    <i class="lnr lnr-briefcase"></i>Further Work</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/pm'); ?>">
                                    <span class="tg-notificationtag"><?php echo count(uralensis_get_total_inbox_msg()); ?></span>
                                    <i class="lnr lnr-envelope"></i>Emails</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="tg-userdropdown">
                        <i class="fa fa-angle-down"></i>
                        <?php uralensis_get_user_detail('true', 'true', 'top'); ?>

                        <ul class="tg-themedropdownmenu">
                            <li>
                                <a href="<?php echo base_url('index.php/institute/'); ?>">
                                    <i class="lnr lnr-chart-bars"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/view_request_detailall'); ?>">
                                    <i class="lnr lnr-database"></i>
                                    <span>Submitted Records</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/published_reports'); ?>">
                                    <i class="lnr lnr-database"></i>
                                    <span>New Reports</span>
                                </a>
                            </li>
                            <li class="tg-privatemessages tg-hasdropdown"> 
                                <?php $current_date_year = date('Y'); ?>
                                <a id="tg-btntoggle" href="javascript:void();">
                                    <i class="lnr lnr-database"></i>
                                    <span>Viewed Reports</span>
                                </a>
                                <ul class="tg-emailmenu">
                                    <?php $current_year = date('Y'); ?>
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/viewed_reports/'.$current_year); ?>">
                                            <span>2019 Reports</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/viewed_reports/2018'); ?>">
                                            <span>2018 Reports</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/viewed_reports/2017'); ?>">
                                            <span>2017 Reports</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/viewed_reports/2016'); ?>">
                                            <span>2016 Reports</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="<?php echo base_url('index.php/institute/viewed_reports/2015'); ?>">
                                            <span>2015 Reports</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/further_display_work'); ?>">
                                    <i class="lnr lnr-database"></i>
                                    <span>Further Work</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/teaching_cases'); ?>">
                                    <i class="lnr lnr-database"></i>
                                    <span>Teaching Cases</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/mdt_cases_new'); ?>">
                                    <i class="lnr lnr-database"></i>
                                    <span>MDT Cases</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/record_tracking_new'); ?>">
                                    <i class="lnr lnr-map"></i>
                                    <span>Track</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/institute/show_reports'); ?>">
                                    <i class="lnr lnr-layers"></i>
                                    <span>Reports</span>
                                </a>
                            </li>
                            <?php if (isset($_SESSION['admin_id'])) { ?>
                                <li><?php echo anchor('institute/switchUserAccountToAdmin/' . $_SESSION['admin_id'], 'Logout to Admin'); ?></li>
                            <?php 
                        } else { ?>
                                <li>
                                    <a href="<?php echo base_url('index.php/auth/logout'); ?>">
                                        <i class="lnr lnr-exit"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
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
