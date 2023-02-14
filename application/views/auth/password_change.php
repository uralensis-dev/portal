<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Uralensis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/bootstrap.min.css'); ?>">
    <link href="<?php echo base_url('/assets/css/bootstrap-select.min.css'); ?>" rel="stylesheet"/>
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
    <!-- Main Custom CSS -->

    <!-- Tagsinput CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('/assets/newtheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'); ?>">
    <!--Full Calendar CSS Files-->
    <link href='<?php echo base_url('/assets/newtheme/css/fullcalendar.min.css'); ?>' rel='stylesheet'/>
    <!--Full Calendar CSS Files-->
    <!-- Summernote CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('/assets/newtheme/plugins/summernote/dist/summernote-bs4.css'); ?>">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css"/>
    <link href="<?php echo base_url('/assets/css/themify-icons.css'); ?>" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/redmond.datepick.css'); ?>">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/new_jquery.datetimepicker.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/bootstrap-datetimepicker.min.css') ?>">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/dataset.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/newtheme/css/style.css'); ?>">
    <link type="text/css" rel="stylesheet"
          href="<?php echo base_url('/assets/password/css/jquery.passwordRequirements.css'); ?>"/>
</head>

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


<body>
<div id="ajax_loading_effect">
    <div class="ajax_loader">
        <span><img src="https://demo.uralensiswebapp.co.uk/assets/img/gears.gif"></span>
    </div>
</div>
<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
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
                </div>
            </li>
            <!-- /Search -->
            <!-- Flag -->
            <li class="nav-item dropdown has-arrow flag-nav">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                    <img src="https://demo.uralensiswebapp.co.uk/assets/newtheme/img/flags/us.png" alt="" height="20">
                    <span>English</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="https://demo.uralensiswebapp.co.uk/assets/newtheme/img/flags/us.png" alt=""
                             height="16"> English
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="https://demo.uralensiswebapp.co.uk/assets/newtheme/img/flags/fr.png" alt=""
                             height="16"> French
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="https://demo.uralensiswebapp.co.uk/assets/newtheme/img/flags/es.png" alt=""
                             height="16"> Spanish
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="https://demo.uralensiswebapp.co.uk/assets/newtheme/img/flags/de.png" alt=""
                             height="16"> German
                    </a>
                </div>
            </li>

            <!-- /Flag -->
            <li class="new-item"><a href="https://demo.uralensiswebapp.co.uk/admin/display_all/2021/all"
                                    class="nav-link">
                    <img src="https://demo.uralensiswebapp.co.uk//assets/icons/white/publish.png"
                         class="img-responsive"/>
                    <span class="badge badge-pill">
                                4980                            </span>
                </a>
            </li>

            <li class="new-item">
                <a href="https://demo.uralensiswebapp.co.uk/index.php/institute/doctor_record_list" class="nav-link">
                    <img src="https://demo.uralensiswebapp.co.uk//assets/icons/white/unpublish.png"
                         class="img-responsive"/>
                    <span class="badge badge-pill">
                                114                            </span>
                </a>
            </li>

            <li class="new-item">
                <a href="https://demo.uralensiswebapp.co.uk/admin/view_further_work?fw_page=requested" class="nav-link">
                    <img src="https://demo.uralensiswebapp.co.uk//assets/icons/white/Further-work.png"
                         class="img-responsive further-work-img"/>

                    <span class="badge badge-pill">
                                402                            </span>
                </a>
            </li>

            <!-- Notifications -->
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i> <span class="badge badge-pill">0</span>
                </a>
                <div class="dropdown-menu notifications notification">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                        </ul>
                    </div>

                </div>
            </li>
            <!-- /Notifications -->
            <!-- Message Notifications -->

            <li class="nav-item dropdown">

                <a href="https://demo.uralensiswebapp.co.uk/pm/index" class="dropdown-toggle nav-link hide_if_no_email"
                   data-toggle="dropdown">
                    <i class="fa fa-comment-o"></i> <span class="badge badge-pill">0</span>


                    <a href="https://demo.uralensiswebapp.co.uk/pm/index" class="nav-link show_if_no_email hidden">
                        <i class="fa fa-comment-o"></i> <span class="badge badge-pill">0</span>
                    </a>
            </li>
            <!-- /Message Notifications -->
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                                <span class="user-img">
                            <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=Shariq+Dev" alt="">
                            <span class="status online"></span></span>
                    <span>Shariq Dev</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="https://demo.uralensiswebapp.co.uk/auth/edit_user/251">My Profile</a>
                    <!-- <a class="dropdown-item" href="comms/chat">Chat</a> -->
                    <a class="dropdown-item" href="https://demo.uralensiswebapp.co.uk/Settings">Settings</a>
                    <a class="dropdown-item" href="https://demo.uralensiswebapp.co.uk/index.php/auth/logout">Logout</a>

                </div>
            </li>

        </ul>
        <!-- /Header Menu -->
        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="https://demo.uralensiswebapp.co.uk/auth/edit_user/194">My Profile</a>
                <a class="dropdown-item" href="https://demo.uralensiswebapp.co.uk/Settings">Settings</a>
                <a class="dropdown-item" href="https://demo.uralensiswebapp.co.uk/index.php/auth/logout">Logout</a>
            </div>
        </div>
        <!-- /Mobile Menu -->
    </div>
    <!-- /Header -->
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title"><span>Admin Hub</span>

                    <li class="submenu">
                        <a href="#"><i class='la la-dashboard'></i><span>Admin Dashboard<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/admin/home">
                                    <span>Admin Dashboard</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/"> <span>User Dashboard</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/menu/list"> <span>Menu Manager </span></a>
                            </li>
                        </ul>
                        <a href="#"><i class='la la-retweet'></i><span>Comms<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/chat"> <span>Chats</span></a></li>
                            <a href="#"><span>Calls<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="https://demo.uralensiswebapp.co.uk/comms/events"> <span>Calender</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/comms/contacts">
                                        <span>Contacts</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/pm/index"> <span>Email</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/comms/file_manager">
                                        <span>File Manager</span></a></li>
                            </ul>
                            <li><a href="https://demo.uralensiswebapp.co.uk/Admin/roles_permissions"> <span>Roles & Permissions</span></a>
                            </li>
                        </ul>
                        <a href="https://demo.uralensiswebapp.co.uk/department"><i class="las la-hospital"></i> <span>Departments</span></a>

                    </li>
                    <li class="menu-title"><span>Users</span>

                    <li class="submenu">
                        <a href="#"><i class='la la-users'></i><span>Users<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/"> <span>Staff</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/holidays">
                                    <span>Holidays</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/admin_leaves">
                                    <span>Leave (Admin)</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/employee_leaves"> <span>Leave (Users) </span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/leave_settings"> <span>Leave Settings</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/admin_attendance"> <span>Attendance (Admin)</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/employee_attendance"> <span>Attendance (Users)</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/departments">
                                    <span>Departments</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/designations">
                                    <span>Designation</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/timesheet"> <span>Timesheet</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/employee/overtime">
                                    <span>Overtime</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/leaveManagement/leaveSettings"> <span>Leave Settings</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/leaveManagement/leaveGroups"> <span>Leave Goups</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/leaveManagement/assignGroup"> <span>Assign Group</span></a>
                            </li>
                        </ul>
                        <a href="#"><i class='la la-id-card'></i><span>Account Holder<span
                                        class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/settings/account_holder"> <span>Account Holder</span></a>
                            </li>
                        </ul>
                        <a href="#"><i class='la la-network-wired'></i><span>Projects<span
                                        class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/project/dashboard">
                                    <span>Projects</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/project/tasks"> <span>Tasks</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/project/task_board"> <span>Task Board</span></a>
                            </li>
                        </ul>
                        <a href="https://demo.uralensiswebapp.co.uk/_team/team/dashboard/"><i
                                    class="la la-street-view"></i> <span>Team Leads</span></a>
                        <a href="https://demo.uralensiswebapp.co.uk/patient"><i class="la la-stethoscope"></i> <span>Patients</span></a>

                    </li>
                    <li class="menu-title"><span>Clinical</span>

                    <li class="submenu">
                        <a href="#"><i class='la la-file-alt'></i><span>Records<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/admin/display_all/2020">
                                    <span>All</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/institute/bookingin"> <span>New +</span></a>
                            </li>
                            <a href="#"><span>Allocator<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="#"> <span>Institute</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/allocator/allocator">
                                        <span>Allocate</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/allocator/allocated_requests"> <span>Allocated</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/allocator/work_load_activity"> <span>Work Load Activity</span></a>
                                </li>
                            </ul>
                            <li><a href="https://demo.uralensiswebapp.co.uk/admin/display_all/2020/all"> <span>In Progress</span></a>
                            </li>
                            <li><a href="#"> <span>Reported</span></a></li>
                            <li><a href="#"> <span>Error Log</span></a></li>
                            <a href="#"><span>Coding<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <a href="#"><span>Short Codes<span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="#"> <span>Macro</span></a></li>
                                    <li><a href="#"> <span>Micro</span></a></li>
                                </ul>
                                <li><a href="#"> <span>CD10</span></a></li>
                                <li><a href="#"> <span>CPT</span></a></li>
                                <li><a href="#"> <span>SNOMED</span></a></li>
                            </ul>
                        </ul>
                        <a href="#"><i class='las la-user-injured'></i><span>Tumour Board<span
                                        class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="#"> <span>New +</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/tumorBoard"> <span>Visual Board</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/_dataset/dataset/dashboard">
                                    <span>Datasets</span></a></li>
                            <a href="#"><span>Speciality Meetings<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="#"> <span>SOPs</span></a></li>
                            </ul>
                            <a href="#"><span>CIMS<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="https://demo.uralensiswebapp.co.uk/Cims/cims_dashboard">
                                        <span>Dashboard</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/Cims/cims_record_list"> <span>Record List</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/Cims/cims_record_menu"> <span>Record Menu</span></a>
                                </li>
                            </ul>
                        </ul>

                    </li>
                    <li class="menu-title"><span>Laboratory</span>

                    <li class="submenu">
                        <a href="#"><i class='la la-vial'></i><span>Laboratory<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/laboratory"> <span>Laboratory</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/laboratory/laboratory_add_test"> <span>Laboratory</span></a>
                            </li>
                        </ul>
                        <a href="#"><i class='la la-list-alt'></i><span>Rotas<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/_rota/rota/booking_in">
                                    <span>Booking in</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/_rota/rota/cut_up"> <span>Cut Up</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/_rota/rota/embedding">
                                    <span>Embedding</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/_rota/rota/sectioning">
                                    <span>Sectioning</span></a></li>
                            <a href="#"><span>QA<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="#"> <span>NEQAS</span></a></li>
                                <li><a href="#"> <span>QAG</span></a></li>
                            </ul>
                        </ul>
                        <a href="#"><i class='la la-edit'></i><span>Further Work<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/support/requestor_histology_nnuh"> <span>Specials</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/support/requestor_histology_nnuh"> <span>Immuno</span></a>
                            </li>
                            <li><a href="#"> <span>Molecular</span></a></li>
                        </ul>
                        <a href="#"><i class="la la-ticket"></i> <span>Assets</span></a>
                        <a href="#"><i class='la la-user-secret'></i><span>Track<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/Tracking/laboratory_track">
                                    <span>Track</span></a></li>
                            <li><a href="#"> <span>Courier API</span></a></li>
                            <li><a href="#"> <span>Change log (COC Report)</span></a></li>
                        </ul>

                    </li>
                    <li class="menu-title"><span>Billing</span>

                    <li class="submenu">
                        <a href="#"><i class='la la-money'></i><span>Billing<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <a href="#"><span>Groups<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/admin_invoices_display/"> <span>Hospital</span></a>
                                </li>
                                <li><a href="#"> <span>Laboratory</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/doctor_invoices_display/"> <span>Doctors</span></a>
                                </li>
                                <li><a href="#"> <span>Other</span></a></li>
                            </ul>
                            <a href="#"><span>Payroll<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="#"> <span>Employee Salary</span></a></li>
                                <li><a href="#"> <span>Payslip</span></a></li>
                                <li><a href="#"> <span>Payroll Items</span></a></li>
                            </ul>
                            <a href="#"><span>Reports<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="#"> <span>Expense Report</span></a></li>
                                <li><a href="#"> <span>Invoice Report</span></a></li>
                            </ul>
                        </ul>

                    </li>
                    <li class="menu-title"><span>Performance</span>

                    <li class="submenu">
                        <a href="#"><i class='la la-rocket'></i><span>Performance<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/performance/indicator">
                                    <span>Indicator</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/performance/review"> <span>Review</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/performance/appraisal">
                                    <span>Appraisal</span></a></li>
                        </ul>
                        <a href="#"><i class='la la-chalkboard-teacher'></i><span>Training<span
                                        class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="#"> <span>List</span></a></li>
                            <li><a href="#"> <span>Trainers</span></a></li>
                            <li><a href="#"> <span>Type</span></a></li>
                        </ul>

                    </li>
                    <li class="menu-title"><span>Education</span>

                    <li class="submenu">
                        <a href="#"><i class="la la-graduation-cap"></i> <span>Education</span></a>
                        <a href="#"><i class='la la-bullhorn'></i><span>Knowledge Base <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="#"> <span>Forum</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/admin/general_settings#add_teach_mdt_cats">
                                    <span>Teaching Categories</span></a></li>
                        </ul>

                    </li>
                    <li class="menu-title"><span>Administration</span>

                    <li class="submenu">
                        <a href="#"><i class='la la-chart-bar'></i><span>Reports<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/admin/tatscores_reports"> <span>Activity (TAT)</span></a>
                            </li>
                            <li><a href="#"> <span>Tracker</span></a></li>
                            <li><a href="#"> <span>Snomed CT</span></a></li>
                            <li><a href="#"> <span>Finance</span></a></li>
                            <li><a href="#"> <span>Error Log</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/cims/visual_tumor_board	"> <span>COSD Downloads</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/cims/tat_chart"> <span>TAT Chart</span></a>
                            </li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/cwt"> <span>TWW Report</span></a></li>
                        </ul>
                        <a href="#"><i class='la la-user-astronaut'></i><span>Support<span
                                        class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="https://demo.uralensiswebapp.co.uk/tickets"> <span>Tickets</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/support"> <span>PathHub</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/support/faq"> <span>FAQ's</span></a></li>
                        </ul>
                        <a href="#"><i class="la la-file-contract"></i> <span>Policies</span></a>

                    </li>
                    <li class="menu-title"><span>Settings</span>

                    <li class="submenu">
                        <a href="#"><i class='la la-cog'></i><span>Settings<span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <a href="#"><span>Admin Account<span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/mdtdata">
                                        <span>Add MDT Dates</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/specialties">
                                        <span>Specialties</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/add_hospital_clinician"> <span>Add Hospital Clinic</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/add_dermatological_surgeon">
                                        <span>Add Dermatological Surgeon</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/tat_settings"> <span>Add TAT Settings</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/publish_report_password"> <span>Published Password</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/add_teach_mdt_cats_main"> <span>Add Teach MDT CATS</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/add_sec_assign"> <span>Add Secretary</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/add_lab_names_main"> <span>Add Lab Names</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/add_microscopic_codes_main">
                                        <span>Add Microscopic Codes</span></a></li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/add_snomed_codes"> <span>Add Snomed Codes</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/_dataset/dataset/dashboard"> <span>Add Data Set</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/specimen_accepted_by"> <span>Specimen Accepted By</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/specimen_assisted_by"> <span>Specimen Assisted By</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/specimen_labeled_by"> <span>Specimen Labeled By</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/specimen_cutup_by"> <span>Specimen Cutup By</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/specimen_blockchecked_by"> <span>Specimen Block checked By</span></a>
                                </li>
                                <li><a href="https://demo.uralensiswebapp.co.uk/admin/specimen_qcd_by"> <span>Specimen QCD By</span></a>
                                </li>
                            </ul>
                            <li><a href="#"> <span>Localization</span></a></li>
                            <li><a href="#"> <span>Theme Settings</span></a></li>
                            <li><a href="https://demo.uralensiswebapp.co.uk/admin/grouplist"> <span>Roles and Permissions</span></a>
                            </li>
                            <li><a href="#"> <span>Email Settings</span></a></li>
                            <li><a href="#"> <span>Invoice Settings</span></a></li>
                            <li><a href="#"> <span>Notifications</span></a></li>
                            <li><a href="#"> <span>Change Password</span></a></li>
                            <li><a href="#"> <span>Company Settings</span></a></li>
                        </ul>

                    </li>
                    <li class="menu-title"><span>FRe</span>

                </ul>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->
    <!-- Page Wrapper -->

    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid"><!-- Page Content -->
            <style>
                input[type="checkbox"] {
                    width: 20px;
                    height: 20px;
                    float: left;
                    margin-right: 12px;
                }

                .checkbox label {
                    font-weight: 600;
                    font-size: 16px;
                    cursor: pointer;
                }

                @media screen and (max-width: 1380px) {
                    .form-focus .focus-label {
                        font-size: 14px;
                    }
                }


                .page-wrapper {
                    margin-left: 100px;
                    margin-right: 100px;
                }

                }
            </style>

            <style>
                input[type="checkbox"] {
                    width: 20px;
                    height: 20px;
                    float: left;
                    margin-right: 12px;
                }

                .checkbox label {
                    font-weight: 600;
                    font-size: 16px;
                    cursor: pointer;
                }

                @media screen and (max-width: 1380px) {
                    .form-focus .focus-label {
                        font-size: 14px;
                    }
                }

                .sidebar {
                    visibility: hidden;
                }

                .header {
                    visibility: hidden;
                }

                .page-wrapper {
                    margin-left: 100px;
                    margin-right: 100px;
                }

                }
            </style>

            <div class="page-header">
                <?php if ($password_change) { ?>
                    <div class="alert alert-danger" role="alert">
                        System Admin Alert: We have detected potential compromise to your account. We high recommend you
                        change your password.
                    </div>
                <?php } ?>
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Change Password</h3>
                    </div>
                </div>
            </div>
            <?php
            $attributes = array('id' => 'update_password_form');
            echo form_open('', $attributes);
            ?>
            <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
            <div class="card form-group">
                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>"
                       value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="card-body">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
                    <input type="hidden" name="pass_check" value="<?php echo(($password_change) ? 1 : 0); ?>"/>
                    <input type="hidden" name="is_change" value="<?php echo(($is_change) ? 1 : 0); ?>"/>
                    <input type="hidden" name="password_status" id="password_status" value="0"/>
                    <div class="form-group row tg-inputwithicon">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <input type="password" id="prepass" name="prepass" class="form-control show_pass"
                                       value="">
                                <span id="prepass_span" style="display: none;color: red"></span>
                                <div class="view_password"><i class="fa fa-eye"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row tg-inputwithicon">
                        <label for="staticEmail" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <input type="password" id="newpassword" name="password"
                                       class="pr-password form-control show_pass"
                                       value="">
                                <span id="pass_span" style="display: none;color: red"></span>
                                <div class="view_password"><i class="fa fa-eye"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row tg-inputwithicon">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <input type="password" id="confirmpassword" name="re_password"
                                       class="form-control show_pass"
                                       value="">
                                <span id="confirm_span" style="display: none;color: red">Password not matched</span>
                                <div class="view_password"><i class="fa fa-eye"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- Search Filter -->

            </div>


            <div class="form-group stext-center">
                <div class="col-md-12 text-center">
                    <button class="btn btn-primary password-submit-btn btn-rounded btn-lg " type="button">Submit
                    </button>
                    <a href="<?php echo base_url(); ?>" class="btn btn-primary btn-rounded btn-lg">Ignore</a>
                </div>
            </div>


            <?php echo form_close(); ?>

        </div>
        <!-- /Page Content --></div>
    <!-- /Page Content -->
</div>
<!-- /Page Wrapper -->
<!-- /Main Wrapper -->
</body>

<!--Full Calendar JS Files-->
<!-- Fancy box-->
<!-- new theme javascript jquery -->
<!-- jQuery -->

<script src="<?php echo base_url('/assets/newtheme/js/jquery-3.2.1.min.js'); ?>"></script>
<!-- Jquery UI -->
<!-- Bootstrap Core JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="<?php echo base_url('/assets/newtheme/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
<!-- Slimscroll JS -->
<script src="<?php echo base_url('/assets/newtheme/js/jquery.slimscroll.min.js'); ?>"></script>
<!-- Select2 JS -->
<script src="<?php echo base_url('/assets/newtheme/js/select2.min.js'); ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('/assets/newtheme/plugins/summernote/dist/summernote.js'); ?>"></script>
<!-- Datetimepicker JS -->
<script src="<?php echo base_url('/assets/newtheme/js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<!-- Datatable JS -->
<script src="<?php echo base_url('/assets/newtheme/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/dataTables.bootstrap4.min.js'); ?>"></script>
<!--<script src="--><?php //echo base_url('/assets/js/session.js');  ?><!--"></script>-->
<!-- Tagsinput JS -->
<script src="<?php echo base_url('/assets/newtheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'); ?>"></script>
<!-- Task JS -->
<script src="<?php echo base_url('/assets/newtheme/js/task.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/typeahead.jquery.js'); ?>"></script>

<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Chart JS -->
<script src="<?php echo base_url('/assets/subassets/plugins/morris/morris.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/subassets/plugins/raphael/raphael.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/chart.js') ?>"></script>

<script src="<?php echo base_url('/assets/js/bloodhound.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.bpopup.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/moment-with-locales.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.plugin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.datepick.js'); ?>"></script>
<script src="//cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.js"></script>
<script src="//cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="<?php echo base_url('/assets/js/underscore.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/sticky.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/plupload.full.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.inputmask.bundle.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/owl.carousel.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/scrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.idle.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.blockUI.js'); ?>"></script>
<!--Full Calendar JS Files-->
<script src="<?php echo base_url('/assets/newtheme/js/fullcalendar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.fullcalendar.js'); ?>"></script>

<!-- Canvas js -->
<script src="<?php echo base_url('assets/js/canvasjs.min.js'); ?>"></script>

<script>
    // Base url as javascript variable
    const _base_url = `<?php echo base_url() ?>`
    const default_profile_pic = `<?php echo base_url() . DEFAULT_PROFILE_PIC ?>`;
</script>
<script>
    // CSRF Token
    var csrf_cookie = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
    var csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrf_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
    // Type
    // success, info, important, warning
    function message(msg = "", type = "success", duration = 7000) {
        jQuery.sticky(msg, {classList: type, speed: 200, autoclose: duration});
    }
</script>
<!-- Custom JS -->
<script src="<?php echo base_url('/assets/newtheme/js/app.js'); ?>"></script>

<script src="<?php echo base_url('/assets/password/js/jquery.passwordRequirements.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/password/js/custom.js'); ?>"></script>

</html>

