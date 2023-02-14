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
        <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/newtheme/img/favicon.png" />
        <script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
        <link href="<?php echo base_url('/assets/css/jquery-ui.css'); ?>" rel="stylesheet" /> 
        <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" /> 
        <link href="<?php echo base_url('/assets/css/bootstrap-select.min.css'); ?>" rel="stylesheet" /> 
        <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('/assets/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/redmond.datepick.css'); ?>">
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
            <div class="header">
                <div class="top-header">
                    <img class="img-responsive" src="<?php echo base_url('/assets/img/headerlogo.png'); ?>" />
                </div>
                <div class="sub-header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li><?php echo anchor('secretary', 'Dashboard'); ?></li>
                                    <li><?php echo anchor('secretary/reports', 'Reports'); ?></li>
                                    <li><?php echo anchor('secretary/view_reports', 'View Reports'); ?></li>
                                    <li><?php echo anchor('secretary/show_form', 'Add Report'); ?></li>
                                    <li><?php echo anchor('secretary/download_tracker', 'Tracker'); ?></li>
                                    <li><?php echo anchor('secretary/mdt_cases', 'MDT Cases'); ?></li>
                                </ul>
                                <ul class="nav navbar-nav pull-right">
                                    <?php if (isset($_SESSION['admin_id'])) { ?>
                                        <li><?php echo anchor('secretary/switchUserAccountToAdmin/' . $_SESSION['admin_id'], 'Logout to Admin'); ?></li>
                                    <?php } else { ?>
                                        <li><?php echo anchor('auth/logout', 'Logout'); ?></li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="content">