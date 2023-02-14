<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $user_id = $this->ion_auth->user()->row()->id; ?>
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/subassets/css/custom-styles.css">
<style type="text/css">
    .page-wrapper{
        padding-left: 15px;
        padding-right: 15px;
    }
    .card-body {
        min-height: 138px;
    }
    .card-table .card-body{
        min-height: auto;
    }
    a:focus, a:hover{outline: none; text-decoration: none}
    .cards_list li a{font-weight: 600;}
    .content{
        background: transparent;
    }
    .action-label .btn-sm {
        padding: 4px;
        border: 1px solid #ccc;
    }
    .table .dropdown-menu .dropdown-item {
        /*padding: 5px;*/
        /*display: block;*/
        /*color: #000;*/
        /*font-size: 14px;*/
    }
    div.dataTables_wrapper div.dataTables_filter label{color: #fff;}
    #request_form_table_filter input {
        position: relative;
        top: -50px;
        right: 70px;
        border-radius: 18px;
    }
    .card-table .card-body{
        padding: 5px;
    }
    #request_form_table_wrapper .row{
        margin-right: 0;
        margin-left: 0;
    }
    div.dataTables_wrapper div.dataTables_filter label{
        position: relative;
    }
    #request_form_table_filter label:after{
        position: absolute;
        content: "\f002";
        font-family: "fontawesome";
        position: absolute;
        top: -50px;
        right: 70px;
        background: #00c5fb;
        z-index: 99;
        color: #fff;
        line-height: 1;
        padding: 8px;
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .table .dropdown-menu a i{margin-right: 10px;}
    .table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th{font-weight: 600;}
    .page-header{margin-bottom: 0;padding-top:25px;}
    @media screen and (min-width: 1380px){
        .card-body 
        {
            padding-bottom: 0;
        }
    }
    .dash-widget-info h3{font-size: 20px;}
    .avatar > img {
        border-radius: 50%;
       display: block;
        overflow: hidden;
        width: 100%;
        height: 40px;
    }
    .dash_images{margin-top: -10px;}
    .not-found-qr , .focus-label{position: absolute;}
    .dash-widget-icon img{margin: 0 auto;}
    .select2-container--default .select2-selection--single{height: 40px;border-color: #dbdbdb;}
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 7px;
        right: 5px;
    }
    .user_groups_area .dash-widget-icon{
        display: block;
        max-width: 50px;
        width: 100%;
        height: 50px;
        margin: 0 auto 15px;
        text-align: center;
        float: unset;
        line-height: 1.5;
    }
    h4, .h4 {
        font-size: 18px;
    }
    .user_groups_area .dash-widget-info{text-align: center;}
    .user_groups_area .card-body{min-height: auto; padding: 20px 0;}
    .table-hover{
        cursor: pointer;
    }

    .dash_tabs .nav-tabs.nav-tabs-solid > li{width: auto}
    .dash_tabs .nav-tabs.nav.nav-tabs a.active{background-color: #00c5fb; border-radius: 0 !important;}
    .dash_tabs .nav-tabs.nav.nav-tabs a{background-color: transparent}
</style>


    <div class="page-header">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="page-title">
                    Welcome  <?php echo  $decryptedDetails->first_name . " " . $decryptedDetails->last_name ?></h3>
                </div>
                <div class="col-sm-4 text-right">
                <a style="margin-right: 10px;margin-left: 5px;" href="<?php echo  base_url()."laboratory/create_user/".$decryptedDetails->clinicInfo."/hsa"; ?>" class="btn add-btn"><i class="fa fa-plus"></i> User</a>
                    <a href="<?php echo base_url('laboratory/team_view'); ?>" class="btn btn-default bg-white"> View Users <span class="badge badge-info"><?php //echo (isset($Lab) ? $Lab : 0);?></span>

                    </a>
                </div>
                <div class="col-sm-4" style="display:none">
                    <div class="pull-right">
                        <a href="javascript:void(0);" id="doctor_advance_search"><i class="fa fa-cog fa-2x"></i></a>
                        <!-- <a id="doctor_advance_search" class="btn btn-info btn-lg newbtn" href="javascript:void(0);"> Advance Search</a> -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            
        </div>
        <div id="advance_search_table" style="display: none;">
            <?php
            $attributes = array('class' => '');
            echo form_open("Doctor/search_request", $attributes);
            ?>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="nhs_no" name="nhs_no">
                    <label class="focus-label">NHS No.</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="hostpital_number" name="hostpital_number">
                    <label class="focus-label">Hospital Number</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control datepicker floating" id="date_from_to" name="date_from_to">
                    <label class="focus-label">Dates from and to</label>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="patient_name" name="patient_name">
                    <label class="focus-label">Patient name</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="dob" name="dob">
                    <label class="focus-label">DOB</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="address" name="address">
                    <label class="focus-label">Address</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <select class="form-control floating">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    <label class="focus-label">Gender</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="patholigist" name="patholigist">
                    <label class="focus-label">Patholigist</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="clinician" name="clinician">
                    <label class="focus-label">clinician</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="SNOMED_CT" name="SNOMED_CT">
                    <label class="focus-label">SNOMED-CT</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="tags_flags_worklist" name="tags_flags_worklist">
                    <label class="focus-label">Tags/flags/worklist</label>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="Tissue_type" name="Tissue_type">
                    <label class="focus-label">Tissue Type</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="patholigist" name="patholigist">
                    <label class="focus-label">Patholigist</label>
                </div>
            </div>


            
            <div class="col-xs-12 col-sm-6 col-md-2">
                <button type="submit" class="btn btn-success btn-lg btn-block newbtn">Search</button>
            </div>
            <div>

            </div>
        </form>
    </div>
    <div class="clearfix"></div>


    <!-- <div class="row">
        <div class="col-md-12 mb-4">
            <h4 class="display-5">Linked Organization</h4>
        </div>
    </div> -->
    <!-- <div class="row user_groups_area">
            <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon">
                            <img src="<?php echo base_url();?>assets/icons/pathologist.svg" class="img-fluid"/>
                        </span>
                        <div class="dash-widget-info">
                            <h3><?php echo (isset($Doctors) ? $Doctors : 0);?></h3>
                            <span><a href="<?php echo base_url('doctor/view'); ?>">Pathologist</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/laboratory_icon.png" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($Lab) ? $Lab : 0);?></h3>
                        <span><a href="<?php echo base_url('laboratory/Labview'); ?>">Laboratory</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div> -->
    

<!-- <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-hospital-o"></i></span>
                <div class="dash-widget-info">
                    <h3><?php echo (isset($CService) ? $CService : 0);?></h3>
                    <span><a href="<?php echo base_url('auth/dashoardDetails?group_type=H'); ?>" >Cancer Service</a></span>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/cancer_service_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                    <h3>0</h3>
                        <span><a href="<?php echo base_url('auth/dashoardDetails?group_type=CS'); ?>">Network Service</a></span>
                </div>
            </div>
        </div>
    </div> -->
    
</div>


<div class="col-md-12">
    
    <div class="row">
        <div class="col-md-12 mb-4">
            <h4 class="display-5">Dashboard</h4>
        </div>
    </div>
    <div class="row dashboard_widgets">
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <a href="<?php echo base_url('tracking/laboratory_track'); ?>">
                        <span class="dash_images">
                            <img src="<?php echo base_url('assets/icons/track.svg'); ?>" style="width:60px;" class="img-fluid">
                        </span>
                        <div class="dash-widget-info">
                            <h3>Track</h3>
                        </div>
                    </a>
                    <div class="clearfix"></div>
                    <fieldset>
                        <!-- <div class="tg-inputicon tg-inputwithicon-dashboard">
                            <span class="lnr lnr-magnifier barcode_no_search_dashboard"></span>
                            <input type="search" name="searchspecimen" id="qr-code-input" class="form-control" placeholder="Track Number" />
                            <div class="not-found-qr"></div>
                            <label class="focus-label"></label>
                        </div> -->
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 hide">
            <div class="card dash-widget">
                <div class="card-body">
                    <a href="<?php //echo base_url('index.php/institute/further_display_work'); ?>">
                        <span class="dash_images">
                            <img src="<?php echo base_url('assets/icons/laboratory_icon.png') ; ?>" style="width:60px" class="img-fluid">
                        </span>
                        <div class="dash-widget-info">
                            <h3>Lab Requests</h3>
                        </div>
                    </a>
                    <ul class="tg-viewprint">
                        <li><span><?php //echo uralensis_get_further_work_data(); ?></span></li>
                        <li class="tg-viewtrack"><a target="_blank"
                            href="<?php //echo base_url('index.php/institute/further_display_work'); ?>"><i
                            class="fa fa-eye"></i></a></li>
                            <li class="tg-print"><a class="display_fw_print_opt" href="javascript:;" class=""><i
                                class="fa fa-print"></i></a></li>
                            </ul>
                            <div class="fw_print_option haslayout hidden-boxes">
                                <hr>
                                <p>
                                    <a href="<?php //echo base_url('index.php/institute/print_fw_records?fw_type=completed'); ?>">Complete</a>
                                    -- OR ----
                                    <a href="<?php //echo base_url('index.php/institute/print_fw_records?fw_type=requested'); ?>">Requested</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <a href="<?php echo base_url('AddCourier'); ?>">
                                <span class="dash_images">
                                    <img src="<?php echo base_url('assets/icons/Courier.png'); ?>" class="img-re sponsive">
                                </span>
                                <div class="dash-widget-info">
                                    <h3><i class="fa fa-plus"></i> Courier</h3>
                                    <!-- <span>Tasks</span> -->
                                </div>
                            </a>
                            <ul class="list-inline cards_list">
                                <li>
                                    <a class="" href="<?php echo base_url('addCourier')?>">
                                        <span>Courier Status</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="">
                                        <span>Previous Deliveries</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card dash-widget">
                        <div class="card-body xl-level">
                            <a href="<?php echo base_url('labEnquiries'); ?>">
                              <span class="dash_images">
                                 <img src="<?php echo base_url('assets/icons/Courier.png'); ?>" class="img-responsive">
                             </span>
                             <div class="dash-widget-info">
                                <h3>Lab Support</h3>
                                <!-- <span>Tasks</span> -->
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card dash-widget">
                    <div class="card-body">
                    <a href="<?php echo base_url('billing/bill_track'); ?>">
                        <span class="dash_images">
                            <img src="<?php echo base_url('assets/icons/Biling.png'); ?>" class="img-res ponsive">
                        </span>
                        <div class="dash-widget-info">
                            <h3>Invoices</h3>
                        </div>
                     
                        
                        <div class="progress mb-2" style="max-height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        </a>
                        <ul class="list-inline cards_list hide">
                            <li>
                                <a class="" target="_blank" href="<?php echo base_url('index.php/institute/generate_hospital_latest_invoice'); ?>">
                                    <span>Latest Invoice</span>
                                </a>
                            </li>
                            <li>
                                <a class="" target="_blank" href="<?php echo base_url('index.php/institute/accumulative_invoices_display'); ?>">
                                    <span>Accumulative</span>
                                </a>
                            </li>
                            <li>
                                <?php if ($isuserAdmin[0]->is_hospital_admin == 1) { ?>
                                    <a class="" target="_blank" href="<?php echo base_url('index.php/institute/getAllUsers'); ?>">
                                        <span>Users of this Hospitals</span>
                                    </a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <a href="javascript:void(0);">
                                <span class="dash_images">
                                    <img src="<?php echo base_url('assets/icons/clinic_checklist.svg' ); ?>" style="width:60px;" class="img-fluid">
                                </span>
                                <div class="dash-widget-info">
                                    <h3>Clinic Checklist</h3>
                                    <!-- <span>Projects</span> -->
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <a href="<?php echo base_url('institute/doctor_record_list/'); ?>">
                                <span class="dash_images">
                                    <img src="<?php echo base_url('assets/icons/records.svg'); ?>" style="width: 60px;" class="img-fluid">
                                </span>
                                <div class="dash-widget-info">
                                    <h3>Records</h3>
                                </div>
                            </a>
                            <ul class="list-inline cards_list">
                                <li>
                                    <a href="javascript:;" class="new_records" style="margin-right:10px;"><?php echo $new_reports?> <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="old_records"><?php echo $totalreports?> <i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card dash-widget">
                        <div class="card-body">                    
                            <span class="dash_images">
                                <img src="<?php echo base_url('assets/icons/cancer_target.svg');  ?>" style="width:60px;" class="img-fluid">
                            </span>
                            <div class="dash-widget-info">
                                <h3>Cancer Target</h3>
                            </div>                    
                        </div>
                    </div>
                </div> 
    </div>

    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                        <div class="col-md-6">
                            <h3 class="card-title mb-0">
                                <select name='pathologist' id='pathologist' >
                                    <option value=''>Pathologist</option>
                                    <?php foreach($pathologists as $pathologist):?>
                                        <option value='<?= $pathologist["id"]; ?>'><?= $pathologist['first_name'].' '.$pathologist['last_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <h3 class="card-title mb-0"><a href="javascript:get_weekly_request(-1)"><strong><</strong></a> <span id='weekly_static'>Weekly Static </span><a href="javascript:get_weekly_request(1)"><strong>></strong></a></h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <div class="card-body" style="max-height:330px; min-height: 200px; overflow-y:auto; padding: 0 10px;">
                    <div class="table-responsive">
                        <table class="table table-hover custom-table table-borderd" >
                            <thead>
                                <tr>
                                    <th>Pathologist</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Published</th>
                                    <th>Un-Published</th>
                                    <th>Viewed</th>
                                </tr>
                            </thead>                            
                            <tbody id='weekly_request'>                                
                                <tr><td colspan="5" class="text-center"><span class="fa fa-spin fa-circle-o-notch text-info"></span> Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">
                        Pathologist
                        <i class="fa fa-plus-circle pull-right" data-toggle="modal" data-target="#add_pathologist"
                        style="color:green; margin-left:10px"></i>
                    </h3>
                </div>
                <div class="card-body" style="max-height:330px;  min-height: 200px;overflow-y:hidden">
                        <div class="table-responsive">
                            <table class="table custom-table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>                                        
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                                  
                                    foreach($pathologists as $pathologist):?>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar"><img alt=""
                                                        src="<?php echo get_profile_picture($pathologist['profile_picture'], $pathologist['first_name'], $pathologist['last_name']); ?>"></a>
                                                        <a href="<?php echo base_url('/auth/edit_user/'.$pathologist['id'])?>"><?php echo $pathologist['first_name']." ".$pathologist['last_name']; ?></a>
                                                    </h2>
                                                </td>
                                                <td><?php echo $pathologist['email']; ?></td>
                                                <td>
                                                    <div class="dropdown action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-success"></i> Active
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                            class="fa fa-dot-circle-o text-success"></i> Active</a>
                                                            <a class="dropdown-item" href="#"><i
                                                                class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action pull-right">
                                                        <a class="dropdown-item" href="<?php echo base_url()."laboratory/edit_user/".$pathologist['id'] ?>"><i
                                                                    class="fa fa-pencil m-r-5"></i></a>
                                                            <!-- <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="<?php echo base_url()."laboratory/edit_user/".$pathologist['id'] ?>"><i
                                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                    <a class="dropdown-item hide" href="javascript:void(0)"><i
                                                                        class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                    </div>
                                                                </div> -->
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="javascript:;" class="d-block">View all</a>
                                    </div>
                                </div>

                            </div>


        
    </div>

    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill" style="height: 447px; overflow-y: auto; margin-bottom: 0;">
				<div class="card-body dash_tabs nopadding">
					<ul class="nav nav-tabs nav-tabs-solid ">
                        <li class="nav-item"><a class="nav-link active" href="#Sops" data-toggle="tab">SOP's</a></li>
                        <li class="nav-item"><a class="nav-link " href="#requestForm" data-toggle="tab">Request Form</a></li>
					</ul>
					<div class="tab-content" style="padding: 0px;">  
                        <div class="tab-pane active" id="Sops">
							<div class="card card-table flex-fill" style="height: 404px; overflow-y: auto; border: 0;margin-bottom: 0;">
								<div class="card-header">
									<h3 class="card-title mb-0">SOP's
										<i class="fa fa-cloud-upload pull-right" data-toggle="modal" data-target="#upload_sops" style="color:green; margin-left:10px"></i>
									</h3>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table custom-table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>File</th>
                                                    <th>Uploaded By</th>
                                                    <th>Uploaded On</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($upload_docs)) {
                                                    foreach ($upload_docs as $row) {
                                                        if($row->file_type == "SOP Form"){
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row->file_name; ?></td>
                                                                <td><?php echo $row->last_name." ".$row->first_name; ?></td>
                                                                <td><?php echo date('d/m/Y H:i:s', strtotime($row->uploaded_at)); ?></td>
                                                                <td class="text-right">
                                                                    <?php if($row->group_name == 'admin'){ ?>
                                                                        <div class="dropdown dropdown-action">
                                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                            <div class="dropdown-menu dropdown-menu-right" style="width: 100px;">
                                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="embed_document_track('<?= $row->id; ?>', '<?= base_url($row->file_path); ?>')"><i class="fa fa-eye m-r-5"></i> View </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <div class="dropdown dropdown-action">
                                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                            <div class="dropdown-menu dropdown-menu-right" style="width: 100px;">
                                                                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document('<?php echo base_url($row->file_path);?>')"><i class="fa fa-eye m-r-5"></i> View </a>
                                                                            <a class="dropdown-item" href="<?php echo base_url('Institute/download_forms/'.$row->file_name); ?>" ><i class="fa fa-cloud-download m-r-5"></i>Download</a>
                                                                            <a class="dropdown-item" href="<?php echo base_url('Institute/delete_upload_docs/'.$row->id); ?>" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                            </div>
                                                                        </div>
                                                                <?php } ?>    
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
								<div class="card-footer">
									<a href="javascript:;" class="d-block">View all</a>
								</div>
							</div>
						</div>

                        <div class="tab-pane " id="requestForm">
							<div class="card card-table flex-fill" style="height: 404px; overflow-y: hide; border: 0;margin-bottom: 0;">
								<div class="card-header">
									<h3 class="card-title mb-0">Request Form
										<i class="fa fa-cloud-upload pull-right" data-toggle="modal" data-target="#upload_request_forms" style="color:green; margin-left:10px"></i>
									</h3>
								</div>
								<div class="card-body" >
									<div class="table-responsive">
                                        <table class="table custom-table table-hover mb-0" id="">
                                            <thead>
                                                <tr>
                                                    <th>File</th>
                                                    <th>Uploaded By</th>
                                                    <th>Uploaded On</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($upload_docs)) {
                                                    foreach ($upload_docs as $row) {
                                                        if($row->file_type == "Request Form"){
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row->file_name; ?></td>
                                                                <td><?php echo $row->last_name." ".$row->first_name; ?></td>
                                                                <td><?php echo date('d/m/Y H:i:s', strtotime($row->uploaded_at)); ?></td>
                                                                <td class="text-right">
                                                                <?php if($row->group_name == 'admin'){ ?>
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right" style="width: 100px;">
                                                                            <a class="dropdown-item" href="javascript:void(0)" onclick="embed_document_track('<?= $row->id; ?>', '<?= base_url($row->file_path); ?>')"><i class="fa fa-eye m-r-5"></i> View </a>
                                                                        </div>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right" style="width: 100px;">
                                                                        <a class="dropdown-item" data-toggle="modal" data-target="#view_doc" onclick="embed_document('<?php echo base_url($row->file_path);?>')"><i class="fa fa-eye m-r-5"></i> View </a>
                                                                        <a class="dropdown-item" href="<?php echo base_url('Institute/download_forms/'.$row->file_name); ?>"><i class="fa fa-cloud-download m-r-5"></i> Download</a>
                                                                        <a class="dropdown-item" href="<?php echo base_url('Institute/delete_upload_docs/'.$row->id); ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                    <!--  <a href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document('<?php echo base_url($row->file_path);?>')"><i class="fa fa-eye"></i></a> -->
                                                                    <!-- <a href="<?php echo base_url('Institute/download_forms/'.$row->file_name); ?>" ><i class="fa fa-download"></i></a>
                                                                    <a href="<?php echo base_url('Institute/delete_upload_docs/'.$row->id); ?>" ><i class="fa fa-trash" style="color:red; margin-left:10px"></i></a> -->
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    } ?>
                                            </tbody>
                                        </table>
									</div>
								</div>
								<div class="card-footer">
									<a href="<?= base_url('documents'); ?>" class="d-block">View all</a>
								</div>
							</div>
						</div>
					</div>					
				</div>				
			</div>
        </div>  
        <div class="col-md-6 d-flex">
                                    <div class="card card-table flex-fill">
                                        <div class="card-header">
                                            <h3 class="card-title mb-0">Users</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped custom-table mb-0" style="white-space: nowrap;">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Login</th>
                                                            <th>IP</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($usersLogins as $uDetail){?>
                                                            <?php
                                                            $user_detail = base64_encode($uDetail->session_userid."___".$uDetail->client_ip);
                                                            ?>
                                                            <tr onClick="(function(){
                                                                window.location = '<?php echo base_url()."/institute/";?>getLoginDetail/<?php echo $user_detail;?>';
                                                                return false;
                                                                })();return false;">
                                                                <td>
                                                                    <h2 class="table-avatar text-left">
                                                                        <a href="#" class="avatar dashboard_admin">
                                                                            <img alt="" class="profile-pic"
                                                                            src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                                                            <a href="<?php echo base_url()."/institute/";?>getLoginDetail/<?php echo $user_detail;?>"><?php echo  $uDetail->first_name." ".$uDetail->last_name; ?> <span><?php echo  $this->ion_auth->get_users_groups($uDetail->session_userid )->row()->description; ?></span></a>                                    </h2>
                                                                        </td>
                                                                        <td><?php echo date("d-M-Y h:i A",$uDetail->login_time); ?></td>
                                                                        <td><?php echo $uDetail->client_ip; ?></td>
                                                                        <td>
                                                                            <?php
                                                                            $innerText=$innerClass="";
                                                                            if($uDetail->remember==0){
                                                                                $innerText = "New IP";
                                                                                $innerClass = "warning";
                                                                                $toolText = "A new sign on has been detected but not verified";
                                                                            }else if($uDetail->remember==1){
                                                                                $innerText = "Approved IP";
                                                                                $innerClass = "success";
                                                                                $toolText = "New sign on verified by user";
                                                                            } else {
                                                                                $innerText = "Reported IP";
                                                                                $innerClass = "danger";
                                                                                $toolText = "New sign no not recognised by user";
                                                                            }
                                                                            ?>
                                                                            <div class="dropdown action-label">
                                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="fa fa-dot-circle-o text-<?php echo $innerClass;?>"></i> <?php echo $innerText; ?>
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="<?php echo site_url('institute/allLoginUsers'); ?>">View all</a>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div>

                                </div> -->
        <div class="col-md-6 d-flex hide">
            <div class="card card-table flex-fill" style="height: 447px; overflow-y: auto;">
                <div class="card-body dash_tabs nopadding">
					<ul class="nav nav-tabs nav-tabs-solid ">
                        <li class="nav-item"><a class="nav-link active" href="#requestForm1" data-toggle="tab">Request From</a></li>
                        <li class="nav-item"><a class="nav-link " href="#requestTo" data-toggle="tab">Request To</a></li>
					</ul>
                    <div class="tab-content" style="padding: 0px;">
                        <div class="tab-pane active" id="requestForm1" style="height: 404px; overflow-y: hide; border: 0;margin-bottom: 0;">
                            <div class="card card-table flex-fill">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Request From
                                        <i class="fa fa-plus-circle pull-right" onclick="add_req_from_to_detail('Add Request From Detail','from')" data-toggle="modal" data-target="#add_request_from_to"
                                        style="color:green; margin-left:10px"></i>
                                    </h3>
                                </div>
                                <div class="card-body" style="min-height: 305px;">
                                        <div class="table-responsive">
                                            <table class="table custom-table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Identifier Name</th>
                                                        <th>Identifier Contact</th>
                                                        <th>Identifier Email</th>
                                                        <th>Identifier Logo</th>
                                                        <th>Identifier Address</th>
                                                        <th>Identifier Post Code</th>
                                                        <th>Identifier City</th>
                                                        <th>Identifier Country</th>
                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($request_from_to)) {
                                                        foreach ($request_from_to as $row) {
                                                            if($row->identifier_type == "from"){
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row->identifier_name; ?></td>
                                                                    <td><?php echo $row->identifier_contact; ?></td>
                                                                    <td><?php echo $row->identifier_email; ?></td>
                                                                    <td> <img src="<?php echo base_url($row->identifier_logo); ?>" width="50"></td>
                                                                    <td><?php echo $row->identifier_address; ?></td>
                                                                    <td><?php echo $row->identifier_post_code; ?></td>
                                                                    <td><?php echo $row->identifier_city; ?></td>
                                                                    <td><?php echo $row->country_name; ?></td>
                                                                    <td class="text-right" >
                                                                        <input type="hidden" id="<?php echo 'edit_ident_name' . $row->id; ?>" value="<?php echo $row->identifier_name; ?>">
                                                                        <input type="hidden" id="<?php echo 'edit_ident_contact' . $row->id; ?>" value="<?php echo $row->identifier_contact; ?>">
                                                                        <input type="hidden" id="<?php echo 'edit_ident_email' . $row->id; ?>" value="<?php echo $row->identifier_email; ?>">
                                                                        <input type="hidden" id="<?php echo 'edit_ident_logo' . $row->id; ?>" value="<?php echo $row->identifier_logo; ?>">
                                                                        <input type="hidden" id="<?php echo 'edit_ident_address' . $row->id; ?>" value="<?php echo $row->identifier_address; ?>">
                                                                        <input type="hidden" id="<?php echo 'edit_ident_type' . $row->id; ?>" value="<?php echo $row->identifier_type; ?>">
                                                                        <input type="hidden" id="<?php echo 'edit_ident_post_code' . $row->id; ?>" value="<?php echo $row->identifier_post_code; ?>">
                                                                        <input type="hidden" id="<?php echo 'edit_ident_city' . $row->id; ?>" value="<?php echo $row->identifier_city; ?>">
                                                                        <input type="hidden" id="<?php echo 'edit_ident_country' . $row->id; ?>" value="<?php echo $row->identifier_country; ?>">
                                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#edit_request_from_to" onclick="edit_req_from_to_detail(<?php echo $row->id; ?>);"><i class="fa fa-pencil" style="color:blue; margin-left:10px"></i></a>
                                                                        <a href="<?php echo base_url('institute/delete_request_from_to/').$row->id; ?>" onclick="confirmDelete()" ><i class="fa fa-trash" style="color:red; margin-left:10px"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                                <div class="card-footer">
                                    <a href="javascript:;" class="d-block">View all</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="requestTo" style="height: 404px; overflow-y: hide; border: 0;margin-bottom: 0;">
                            <div class="card card-table flex-fill">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Request To
                                        <i class="fa fa-plus-circle pull-right" onclick="add_req_from_to_detail('Add Request To Detail','to')" data-toggle="modal" data-target="#add_request_from_to"
                                        style="color:green; margin-left:10px"></i>
                                    </h3>
                                </div>
                                <div class="card-body" style="min-height: 305px;">
                                    <div class="table-responsive">
                                        <table class="table custom-table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Identifier Name</th>
                                                    <th>Identifier Contact</th>
                                                    <th>Identifier Email</th>
                                                    <th>Identifier Logo</th>
                                                    <th>Identifier Address</th>
                                                    <th>Identifier Post Code</th>
                                                    <th>Identifier City</th>
                                                    <th>Identifier Country</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($request_from_to)) {
                                                    foreach ($request_from_to as $row) {
                                                        if($row->identifier_type == "to"){
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row->identifier_name; ?></td>
                                                                <td><?php echo $row->identifier_contact; ?></td>
                                                                <td><?php echo $row->identifier_email; ?></td>
                                                                <td> <img src="<?php echo base_url($row->identifier_logo); ?>" width="50"></td>
                                                                <td><?php echo $row->identifier_address; ?></td>
                                                                <td><?php echo $row->identifier_post_code; ?></td>
                                                                <td><?php echo $row->identifier_city; ?></td>
                                                                <td><?php echo $row->country_name; ?></td>
                                                                <!--                                            <td>--><?php //echo date('d/m/Y H:i:s', strtotime($row->uploaded_at)); ?><!--</td>-->
                                                                <td class="text-right" >
                                                                    <input type="hidden" id="<?php echo 'edit_ident_name' . $row->id; ?>" value="<?php echo $row->identifier_name; ?>">
                                                                    <input type="hidden" id="<?php echo 'edit_ident_contact' . $row->id; ?>" value="<?php echo $row->identifier_contact; ?>">
                                                                    <input type="hidden" id="<?php echo 'edit_ident_email' . $row->id; ?>" value="<?php echo $row->identifier_email; ?>">
                                                                    <input type="hidden" id="<?php echo 'edit_ident_logo' . $row->id; ?>" value="<?php echo $row->identifier_logo; ?>">
                                                                    <input type="hidden" id="<?php echo 'edit_ident_address' . $row->id; ?>" value="<?php echo $row->identifier_address; ?>">
                                                                    <input type="hidden" id="<?php echo 'edit_ident_type' . $row->id; ?>" value="<?php echo $row->identifier_type; ?>">
                                                                    <input type="hidden" id="<?php echo 'edit_ident_post_code' . $row->id; ?>" value="<?php echo $row->identifier_post_code; ?>">
                                                                    <input type="hidden" id="<?php echo 'edit_ident_city' . $row->id; ?>" value="<?php echo $row->identifier_city; ?>">
                                                                    <input type="hidden" id="<?php echo 'edit_ident_country' . $row->id; ?>" value="<?php echo $row->identifier_country; ?>">
                                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#edit_request_from_to" onclick="edit_req_from_to_detail(<?php echo $row->id; ?>);"><i class="fa fa-pencil" style="color:blue; margin-left:10px"></i></a>
                                                                    <a href="<?php echo base_url('institute/delete_request_from_to/').$row->id; ?>" onclick="confirmDelete()" ><i class="fa fa-trash" style="color:red; margin-left:10px"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:;" class="d-block">View all</a>
                            </div>  
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="row hide">
                        <div class="col-md-3 d-flex">
                                  <div class="card flex-fill dash-statistics">
                                      <div class="card-body py-4">
                                                <h5 class="card-title">Governance</h5>
                                                <div class="stats-list form-group">
                                                    <div class="stats-info" style="border-color:#ddd;">
                                                        <p>Today Leave <strong>4 <small>/ 65</small></strong></p>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 31%"
                                                            aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="stats-info" style="border-color:#ddd;">
                                                        <p>Pending Invoice <strong>15 <small>/ 92</small></strong></p>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 31%"
                                                            aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="stats-info" style="border-color:#ddd;">
                                                        <p>Completed Projects <strong>85 <small>/ 112</small></strong></p>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="stats-info" style="border-color:#ddd;">
                                                        <p>Open Tickets <strong>190 <small>/ 212</small></strong></p>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 62%"
                                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="stats-info" style="border-color:#ddd;">
                                                        <p>Closed Tickets <strong>22 <small>/ 212</small></strong></p>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 22%"
                                                            aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <h4 class="card-title">Incident Forms</h4>
                                                <div class="statistics">
                                                    <div class="row">
                                                        <div class="col-md-6 col-6 text-center">
                                                            <div class="stats-box mb-4">
                                                                <p>Total Tasks</p>
                                                                <h3>385</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-6 text-center">
                                                            <div class="stats-box mb-4">
                                                                <p>Overdue Tasks</p>
                                                                <h3>19</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress mb-4 mt-4">
                                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 30%" aria-valuenow="30"
                                                    aria-valuemin="0" aria-valuemax="100">30%
                                                </div>
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 22%" aria-valuenow="18"
                                                aria-valuemin="0" aria-valuemax="100">22%
                                            </div>
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 24%" aria-valuenow="12"
                                            aria-valuemin="0" aria-valuemax="100">24%
                                        </div>
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 26%" aria-valuenow="14"
                                        aria-valuemin="0" aria-valuemax="100">21%
                                    </div>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="14"
                                    aria-valuemin="0" aria-valuemax="100">10%
                                </div>
                            </div>
                            <div class="task_status form-group">
                                <p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Completed Tasks <span class="pull-right">166</span>
                                </p>
                                <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Inprogress Tasks <span
                                    class="pull-right">115</span></p>
                                    <p><i class="fa fa-dot-circle-o text-success mr-2"></i>On Hold Tasks <span
                                        class="pull-right">31</span></p>
                                        <p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Pending Tasks <span
                                            class="pull-right">47</span></p>
                                            <p class="mb-0"><i class="fa fa-dot-circle-o text-info mr-2"></i>Review Tasks <span
                                                class="pull-right">5</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card card-table flex-fill">
                                        <div class="card-header">
                                            <h3 class="card-title mb-0">Users</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped custom-table mb-0" style="white-space: nowrap;">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Login</th>
                                                            <th>IP</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($usersLogins as $uDetail){?>
                                                            <?php
                                                            $user_detail = base64_encode($uDetail->session_userid."___".$uDetail->client_ip);
                                                            ?>
                                                            <tr onClick="(function(){
                                                                window.location = '<?php echo base_url()."/institute/";?>getLoginDetail/<?php echo $user_detail;?>';
                                                                return false;
                                                                })();return false;">
                                                                <td>
                                                                    <h2 class="table-avatar text-left">
                                                                        <a href="#" class="avatar dashboard_admin">
                                                                            <img alt="" class="profile-pic"
                                                                            src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                                                            <a href="<?php echo base_url()."/institute/";?>getLoginDetail/<?php echo $user_detail;?>"><?php echo  $uDetail->first_name." ".$uDetail->last_name; ?> <span><?php echo  $this->ion_auth->get_users_groups($uDetail->session_userid )->row()->description; ?></span></a>                                    </h2>
                                                                        </td>
                                                                        <td><?php echo date("d-M-Y h:i A",$uDetail->login_time); ?></td>
                                                                        <td><?php echo $uDetail->client_ip; ?></td>
                                                                        <td>
                                                                            <?php
                                                                            $innerText=$innerClass="";
                                                                            if($uDetail->remember==0){
                                                                                $innerText = "New IP";
                                                                                $innerClass = "warning";
                                                                                $toolText = "A new sign on has been detected but not verified";
                                                                            }else if($uDetail->remember==1){
                                                                                $innerText = "Approved IP";
                                                                                $innerClass = "success";
                                                                                $toolText = "New sign on verified by user";
                                                                            } else {
                                                                                $innerText = "Reported IP";
                                                                                $innerClass = "danger";
                                                                                $toolText = "New sign no not recognised by user";
                                                                            }
                                                                            ?>
                                                                            <div class="dropdown action-label">
                                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="fa fa-dot-circle-o text-<?php echo $innerClass;?>"></i> <?php echo $innerText; ?>
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="<?php echo site_url('institute/allLoginUsers'); ?>">View all</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div id="add_request_from_to" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="add_req_from_title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row ">
                                                    <div id="ad_success_alert"></div>
                                                    <div id="ad_error_alert"></div>
                                                </div>
                                                <form id="add_req_from_to" method="post">
                                                    <input type="hidden" id="add_ident_type" name="identifier_type" value="from">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Identifier Name</label>
                                                            <input class="form-control " id="ad_identifier_name" name="identifier_name" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Identifier Contact</label>
                                                            <input class="form-control" name="identifier_contact" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Identifier Email</label>
                                                            <input class="form-control" name="identifier_email" type="email">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Identifier Logo</label>
                                                            <input class="form-control" name="identifier_logo" type="file">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Identifier Address</label>
                                                            <input class="form-control" name="identifier_address" type="text">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>Identifier Post Code</label>
                                                            <input class="form-control" name="identifier_post_code" type="text">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>Identifier City</label>
                                                            <input class="form-control" name="identifier_city" type="text">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>Identifier Country</label>
                                                            <select class="form-control" name="identifier_country">
                                                                <option value="">Select Country</option>
                                                                <?php foreach($countries as $country){  ?>
                                                                    <option value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="submit-section">
                                                        <button class="btn btn-primary submit-btn">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="edit_request_from_to" class="modal  fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ed_req_title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row ">
                                                    <div id="ed_success_alert"></div>
                                                    <div id="ed_error_alert"></div>
                                                </div>
                                                <form id="edit_req_from_to" method="post">
                                                    <input type="hidden" id="ed_id" name="ed_id">
                                                    <input type="hidden" id="ed_ident_type" name="identifier_type">
                                                    <input type="hidden" id="ed_existing_logo" name="existing_identifier_logo">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Identifier Name</label>
                                                            <input class="form-control" id="ed_identifier_name" name="identifier_name" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Identifier Contact</label>
                                                            <input class="form-control" id="ed_identifier_contact" name="identifier_contact" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Identifier Email</label>
                                                            <input class="form-control" id="ed_identifier_email" name="identifier_email" type="email">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Identifier Logo</label>
                                                            <input class="form-control" id="ed_identifier_logo" name="identifier_logo" type="file">
                                                            <div id="logo_img_container">

                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Identifier Address</label>
                                                            <input class="form-control" id="ed_identifier_address" name="identifier_address" type="text">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>Identifier Post Code</label>
                                                            <input class="form-control" id="ed_identifier_post_code" name="identifier_post_code" type="text">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>Identifier City</label>
                                                            <input class="form-control" id="ed_identifier_city" name="identifier_city" type="text">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>Identifier Country</label>
                                                            <select class="form-control" id="ed_identifier_country" name="identifier_country">
                                                                <option value="">Select Country</option>
                                                                <?php foreach($countries as $country){  ?>
                                                                    <option value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="submit-section">
                                                        <button class="btn btn-primary submit-btn edit_req_from_to_btn">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="upload_sops" class="modal custom-modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Upload SOP's Document</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="max-height: 700px;">
                                                <?php echo form_open_multipart('Institute/upload_docs_form', array('id' => 'upload_sop_form', 'name' => 'upload_sop_form')); ?>
                                                <input type="hidden" name="file_type" value="SOP Form">
                                                <div class="form-group">
                                                    <label>Upload Files</label>
                                                    <input class="form-control" name="upload_doc" type="file">
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn">Submit</button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="upload_request_forms" class="modal custom-modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Upload Request Forms</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open_multipart('Institute/upload_docs_form', array('id' => 'upload_sop_form', 'name' => 'upload_sop_form')); ?>
                                                <input type="hidden" name="file_type" value="Request Form">
                                                <div class="form-group">
                                                    <label>Upload Files</label>
                                                    <input class="form-control" name="upload_doc" type="file">
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="add_pathologist" class="modal custom-modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Pathologist</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <?php echo form_open_multipart("institute/create_user", array('class' => ' create_user_form')); ?>
                                                 <fieldset>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group tg-inputwithicon">
                                                                <i class="lnr lnr-user"></i>
                                                                <?php //. (array_key_exists('first_name', $user_error) ? 'is-invalid' : '')
                                                                echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => $user_data['first_name'], 'class' => 'form-control ' , 'placeholder' => 'First Name')); ?>
                                                                <div class="invalid-feedback">
                                                                    Please provide a valid name
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group tg-inputwithicon">
                                                                <i class="lnr lnr-user"></i>
                                                                <?php echo form_input(array('type' => 'text', 'name' => 'last_name', 'id' => 'last_name', 'value' => $user_data['last_name'], 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group tg-inputwithicon">
                                                                <i class="lnr lnr-apartment"></i>
                                                                <?php echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => $user_data['company'], 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group tg-inputwithicon">
                                                                <i class="lnr lnr-phone-handset"></i>
                                                                <?php echo form_input(array('type' => 'text', 'name' => 'phone', 'id' => 'phone', 'value' => $user_data['phone'], 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group tg-inputwithicon">
                                                        <input type="hidden" value="D" name="user_role" />
                                                        <i class="lnr lnr-envelope"></i>
                                                        <?php //. (array_key_exists('email', $user_error) ? 'is-invalid' : '')
                                                        echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => $user_data['email'], 'class' => 'form-control check_email' , 'placeholder' => 'Email')); ?>
                                                        <span id="email_span" style="display: none;color: red"></span>
                                                        <div class="invalid-feedback">
                                                            <?php //echo array_key_exists('email', $user_error) ? $user_error['email'] : ''; ?>
                                                        </div>
                                                    </div>

                                                    <div class="row" id="password-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group tg-inputwithicon">
                                                                <i class="lnr lnr-lock"></i>
                                                                <?php echo form_input(array('type' => 'password', 'name' => 'password', 'id' => 'password', 'value' => '', 'class' => 'form-control show_pass pr-password check_password', 'placeholder' => 'Password')); ?>
                                                                <div class="view_password"><i class="fa fa-eye"></i></div>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6">
                                                            <div class="form-group tg-inputwithicon">
                                                                <i class="lnr lnr-lock"></i>
                                                                <?php echo form_input(array('type' => 'password', 'name' => 'password_confirm', 'id' => 'password_confirm', 'value' => '', 'class' => 'form-control show_pass check_password', 'placeholder' => 'Retype Password')); ?>
                                                                <span id="confirm_span" style="display: none;color: red">Password not matched</span>
                                                                <div class="view_password"><i class="fa fa-eye"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group tg-inputwithicon" id="memo-row">
                                                                <i class="lnr lnr-keyboard"></i>
                                                                <?php echo form_input(array('type' => 'text', 'name' => 'memorable', 'id' => 'memorable', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                                                            </div>
                                                        </div>
                                        
                                            </div>

                                            <div id="location_area">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group tg-inputwithicon">
                                                            <i class="lnr lnr-apartment"></i>
                                                            <?php echo form_input(array('type' => 'text', 'name' => 'address1', 'id' => 'address1', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Address 1')); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group tg-inputwithicon">
                                                            <i class="lnr lnr-apartment"></i>
                                                            <?php echo form_input(array('type' => 'text', 'name' => 'address2', 'id' => 'address2', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Address 2')); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="country" id="country">
                                                                <option value="" selected="">Select Country</option>
                                                                <?php foreach ($countries as $country) { ?>
                                                                    <option value="<?php echo $country['nicename']; ?>"><?php echo $country['nicename']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group tg-inputwithicon">
                                                            <i class="lnr lnr-envelope"></i>
                                                            <?php echo form_input(array('type' => 'text', 'name' => 'postcode', 'id' => 'postcode', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Post Code')); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group tg-inputwithicon">
                                                            <i class="lnr lnr-phone"></i>
                                                            <?php echo form_input(array('type' => 'text', 'name' => 'telephone', 'id' => 'telephone', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Telephone No.')); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="group_id" value="<?php echo $user_data['group_id'] ?>">
                                                <input type="hidden" name="active_directory_user"
                                                value="<?php echo $user_data['active_directory_user'] ?>">
                                                <div class="form-group">
                                                    <button class="btn btn-success" id="user-create-btn">Create</button>
                                                    <button class="btn btn-default" id="user-form-clear-btn" type="button">Clear
                                                    </button>
                                                </div>

                                            </div>


                                                     </fieldset>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="submit-section">
                                                <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                                            </div>
                                        </div>

                                                    <?php echo form_close(); ?>
                                            </div>


                                        </div>
                                    </div>
                                <!-- </div> -->
                            <!-- </div> -->
                            
                            
        <div class="col-md-12 mb-4">
            <h4 class="display-5">User Groups</h4>
        </div>
    <div class="user_groups_area">
        <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/hospital_accounts.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <!-- <h3><?php echo (isset($HAusers) ? $HAusers : 0);?></h3> -->
                        <span>
                        <div><a href="<?php echo base_url('husers/hosaccount'); ?>">Hospital Accounts</a> (<?php echo (isset($HAusers) ? $HAusers : 0);?>)</div>
                        
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/clinician.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <!-- <h3><?php echo (isset($CSusers) ? $CSusers : 0);?></h3> -->
                        <span><a href="<?php echo base_url('husers/clinician'); ?>">Clinician / Surgery</a> (<?php echo (isset($CSusers) ? $CSusers : 0);?>)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/requester.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <!-- <h3><?php echo (isset($Rusers) ? $Rusers : 0);?></h3> -->
                        <span><a href="<?php echo base_url('husers/requester'); ?>">Requestor</a> (<?php echo (isset($Rusers) ? $Rusers : 0);?>)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <!-- <h3><?php echo (isset($HSusers) ? $HSusers : 0);?></h3> -->
                        <span><a href="<?php echo base_url('husers/hospitalsec'); ?>">Hospital Secretary</a> (<?php echo (isset($HSusers) ? $HSusers : 0);?>)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/cancer_service_icon.png" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <!-- <h3><?php echo (isset($CANusers) ? $CANusers : 0);?></h3> -->
                        <span><a href="<?php echo base_url('husers/cancerservice'); ?>">Cancer Service</a> (<?php echo (isset($CANusers) ? $CANusers : 0);?>)</span>
                    </div>
                </div>
            </div>
 <div class="clearfix"></div>

        </div>
    <!-- </div>
    <div class="row"> -->
        
    
<!-- <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-hospital-o"></i></span>
                <div class="dash-widget-info">
                    <h3><?php echo (isset($CService) ? $CService : 0);?></h3>
                    <span><a href="<?php echo base_url('auth/dashoardDetails?group_type=H'); ?>" >Cancer Service</a></span>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/cancer_service_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                    <h3>0</h3>
                        <span><a href="<?php echo base_url('auth/dashoardDetails?group_type=CS'); ?>">Network Service</a></span>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/cancer_service_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                    <!-- <h3><?php echo (isset($Husers) ? $Husers : 0);?></h3> -->
                        <span><a href="<?php echo base_url('husers/huserlist'); ?>">All Users</a> (<?php echo (isset($Husers) ? $Husers : 0);?>)</span>
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="col-md-12 mb-4">
            <h4 class="display-5">Division Groups</h4>
        </div>
    <div class="user_groups_area">
        <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body" data-toggle="modal" style="cursor:pointer" data-target="#medicine_division_1">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <!-- <h3><?php echo (isset($medi_div) ? $medi_div : 0);?></h3> -->
                        <span><a href="javascript:;">Medicine Division</a> (<?php echo (isset($medi_div) ? $medi_div : 0);?>)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body" data-toggle="modal" style="cursor:pointer" data-target="#medicine_division_2">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <!-- <h3><?php echo (isset($surgen_div) ? $surgen_div : 0);?></h3> -->
                        <span><a href="javascript:;">Surgery Division</a> (<?php echo (isset($surgen_div) ? $surgen_div : 0);?>)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body" data-toggle="modal" style="cursor:pointer" data-target="#medicine_division_3">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <!-- <h3><?php echo (isset($fam_div) ? $fam_div : 0);?></h3> -->
                        <span><a href="javascript:;">Family Services Division</a> (<?php echo (isset($fam_div) ? $fam_div : 0);?>)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body" data-toggle="modal" style="cursor:pointer" data-target="#medicine_division_4">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <!-- <h3><?php echo (isset($cli_div) ? $cli_div : 0);?></h3> -->
                        <span><a href="javascript:;">Clinical and Scientific Division</a> (<?php echo (isset($cli_div) ? $cli_div : 0);?>)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <div class="clearfix"></div>

                            <div id="view_doc" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"></h4>
                                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                </div>
                                <?php echo form_open_multipart(uri_string(), array('id'=>'edit_cv_appraisal','name' => 'edit_cv_appraisal')); ?>
                                <input type="hidden" name="edit_cv_appraisal" value="1">
                                <div class="modal-body" id="doc_embed" style="min-height: 700px; ">
                                    <?php $file_path = $cv_appr_data['cv_doc_file_name']; ?>

                                </div>
                                <div class="modal-footer">
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
    <?php if(!empty($division)){
        foreach($division as $dev){

        ?>

<div class="modal" id="medicine_division_<?php echo $dev['id']?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $dev['title']?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php
            if(!empty($dev['department'])){
                $i=1;
                foreach($dev['department'] as $subdev){
                $is_show = ($i==1)? 'show':'show';
                $is_collapsed = ($i==1)? '':'';
            ?>
        <div class="row">
            <div id="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link btn-block <?php echo $is_collapsed;?>" style="text-align: left !important" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <strong> <?php echo $subdev['name'] ?></strong>
                      <i class="fa fa-chevron-down pull-right"></i>
                    </button>
                  </h5>
                </div>
                <?php if(!empty($subdev['specialties'])){
                    foreach($subdev['specialties'] as $sk=>$sv){
                        ?>
                        <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link btn-block <?php //echo $is_collapsed;?>" style="text-align: left !important" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <strong> <?php echo $sv['name'] ?></strong>
                      <i class="fa fa-chevron-down pull-right"></i>
                    </button>
                  </h5>
                </div>
                 <div id="collapseOne" class="collapse <?php echo $is_show;?>" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                    <ul class="list-unstyled">
                <?php if(!empty($sv['categories'])){
                    foreach($sv['categories'] as $ck=>$cv){
                        ?>

                        <li><label value=""><input type="checkbox"  value="" /> <?php echo $cv['name']; ?></label></li>
                <?php }}
                ?>
                </ul>
                  </div>
                </div>
                        <?php
                    }
                }?>

                <!-- <div id="collapseOne" class="collapse <?php echo $is_show;?>" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                    <ul class="list-unstyled">
                         <?php
                            if(!empty($subdev['specialties'])){
                                foreach($subdev['specialties'] as $list){
                            ?>
                        <li><label value=""><input type="checkbox" /> <?php echo $list['name']; ?></label></li>
                        <?php
                        }
                        }
                        ?>
                                              
                    </ul>
                  </div>
                </div> -->
              </div>
          </div>
        </div>
         <?php $i++;
            }
        }
        ?> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="submit_division();">Submit</button>
      </div>

    </div>
  </div>
</div>
<div class="clearfix"></div>

<?php
}
}
?>

<script type="text/javascript">
    function submit_division(){
        window.location.href='<?php echo base_url();?>'+'husers/divisionuser';
    }
    function embed_document(file_name){
        var embed_div = document.getElementById('doc_embed');
        embed_div.innerHTML="";
        embed_div.innerHTML = "<embed src='"+file_name+"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";
    }
    function embed_document_track(document_id, file_name){
        $(document).find('#view_doc').modal('hide');
        $.ajax({
            url: `${_base_url}institute/track_viewer`,
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { "document_id": document_id },
            success: function (response) {
                if (response.status === 'success') {
                    $(document).find('#view_doc').modal('show');
                    embed_document(file_name);
                } else {
                    $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                }
            }
        });
    }
    function get_weekly_request(week){
        var tr = '<tr><td colspan="5" class="text-center"> No Reuqest found.</td></tr>';
        var user_id = $('#pathologist').val();
        var fdate = localStorage.getItem('fdate')
        var tdate = localStorage.getItem('tdate')
        if(week == -1){
            var tdate = fdate;
            var fdate = new Date(fdate);
            fdate.setDate(fdate.getDate() - 7);
            var fdate = fdate.getFullYear() + "-" + (fdate.getMonth()+1) + "-" + fdate.getDate();
        }else if(week == 1){
            var fdate = tdate;
            var tdate = new Date(tdate);
            tdate.setDate(tdate.getDate() + 7);
            var tdate = tdate.getFullYear() + "-" + (tdate.getMonth()+1) + "-" + tdate.getDate();
        }
        localStorage.setItem('fdate', fdate);
        localStorage.setItem('tdate', tdate);
        $.ajax({
            url: `${_base_url}institute/get_weekly_request`,
            type: 'GET',            
            dataType: 'json',
            data: {'user_id': user_id, 'fdate' : fdate, 'tdate' : tdate},  
            success: function (response) {
                $('#weekly_static').attr('title', fdate+' To '+tdate)
                if(response.length > 0){
                    var tr_record =""
                    $.each(response, function(item, value){
                        tr_record += '<tr><td>'+value.first_name+' '+value.last_name+'</td>'+
                                    '<td>'+value.request_date+'</td>'+
                                    '<td class="text-center">'+value.request_count+'</td>'+
                                    '<td class="text-center">'+value.published+'</td>'+                                    
                                    '<td class="text-center">'+value.unpublished+'</td>'+
                                    '<td class="text-center">'+value.request_viewed+'</td></tr>';
                                    
                    })
                    $('#weekly_request').html(tr_record)    
                }
                else{
                    $('#weekly_request').html(tr)    
                }
            },
            error: function(){
                $('#weekly_request').html(tr)
            }
        });
    }    
    $(document).ready(function(){
        var d = new Date();
        var tdate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
        oneWeekAgo = d.setDate(d.getDate() - 7);
        myDate = new Date(oneWeekAgo);
        var fdate = myDate.getFullYear() + "-" + (myDate.getMonth()+1) + "-" + myDate.getDate();
        localStorage.setItem('fdate', fdate);
        localStorage.setItem('tdate', tdate);
        get_weekly_request(0);
        $('#pathologist').change(function(){
            if($(this).val() != ''){
                get_weekly_request(0);
            }
        });
    });
</script>

