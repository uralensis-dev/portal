<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $user_id = $this->ion_auth->user()->row()->id; ?>
<style type="text/css">
    .card-body {
        min-height: 150px;
    }
    @media screen and (min-width: 1380px){
        .card-body 
        {
            padding-bottom: 0;
        }
    }
    .dash-widget-info h3{font-size: 16px;}
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
    .user_groups_area .card-body{min-height: 193px;}

</style>

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="page-title">
                    Welcome  <?php echo  $decryptedDetails->first_name . " " . $decryptedDetails->last_name ?></h3>
                </div>
                <div class="col-sm-4" style="display:none">
                    <div class="pull-right">
                        <a href="javascript:void(0);" id="doctor_advance_search"><i class="fa fa-cog fa-2x"></i></a>
                        <!-- <a id="doctor_advance_search" class="btn btn-info btn-lg newbtn" href="javascript:void(0);"> Advance Search</a> -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-breadcrumbarea tg-searchrecordhold">
                        <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                            <li><a href="javascript:;">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
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

    <div class="row">
        <div class="col-md-12 mb-4">
            <h4 class="display-5">User Groups</h4>
        </div>
    </div>
    <div class="row user_groups_area">
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/hospital_accounts.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($HAusers) ? $HAusers : 0);?></h3>
                        <span>
                        <div><a href="<?php echo base_url('husers/hosaccount'); ?>">Hospital Accounts</a></div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/clinician.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($CSusers) ? $CSusers : 0);?></h3>
                        <span><a href="<?php echo base_url('husers/clinician'); ?>">Clinician / Surgery</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/requester.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($Rusers) ? $Rusers : 0);?></h3>
                        <span><a href="<?php echo base_url('husers/requester'); ?>">Requestor</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($HSusers) ? $HSusers : 0);?></h3>
                        <span><a href="<?php echo base_url('husers/hospitalsec'); ?>">Hospital Secretary</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/cancer_service_icon.png" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($CANusers) ? $CANusers : 0);?></h3>
                        <span><a href="<?php echo base_url('husers/cancerservice'); ?>">Cancer Service</a></span>
                    </div>
                </div>
            </div>
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
    <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url();?>assets/icons/cancer_service_icon.png" class="img-fluid"/>
                </span>
                <div class="dash-widget-info">
                    <h3><?php echo (isset($Husers) ? $Husers : 0);?></h3>
                        <span><a href="<?php echo base_url('husers/huserlist'); ?>">All Users</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <h4 class="display-5">Division Groups</h4>
        </div>
    </div>
    <div class="row user_groups_area">
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body" data-toggle="modal" style="cursor:pointer" data-target="#medicine_division">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($medi_div) ? $medi_div : 0);?></h3>
                        <span><a href="javascript:;">Medicine Division</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body" data-toggle="modal" style="cursor:pointer" data-target="#surgery_division">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($surgen_div) ? $surgen_div : 0);?></h3>
                        <span><a href="javascript:;">Surgery Division</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body" data-toggle="modal" style="cursor:pointer" data-target="#family_services_division">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($fam_div) ? $fam_div : 0);?></h3>
                        <span><a href="javascript:;">Family Services Division</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
            <div class="card dash-widget">
                <div class="card-body" data-toggle="modal" style="cursor:pointer" data-target="#clinical_and_scientific_division">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/pathology_secretary.svg" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($cli_div) ? $cli_div : 0);?></h3>
                        <span><a href="javascript:;">Clinical and Scientific Division</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <h4 class="display-5">Linked Organization</h4>
        </div>
    </div>
    <div class="row user_groups_area">
            
            
            
            
            
        <!-- </div>
        <div class="row"> -->
            <div class="col-md-4 col-sm-6 col-lg-2 col-xl-2">
                <div class="card dash-widget">
                    <div class="card-body">
                        <!-- <span class="dash-widget-icon"></span> -->
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
    <div class="clearfix"></div>
    

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
                    <div class="tg-inputicon tg-inputwithicon-dashboard">
                        <span class="lnr lnr-magnifier barcode_no_search_dashboard"></span>
                        <input type="search" name="searchspecimen" id="qr-code-input" class="form-control"
                        placeholder="Track Number" />
                        <div class="not-found-qr"></div>
                        <label class="focus-label"></label>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3">
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
                                -- OR ---->
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
                            <h3>Lab Support Zone</h3>
                            <!-- <span>Tasks</span> -->
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card dash-widget">
                <div class="card-body">

                    <span class="dash_images">
                        <img src="<?php echo base_url('assets/icons/Biling.png'); ?>" class="img-res ponsive">
                    </span>
                    <div class="dash-widget-info">
                        <h3>Invoices</h3>
                    </div>
                    
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <ul class="list-inline cards_list">
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
                        <a href="<?php echo base_url('admin/display_all/'.date('Y')); ?>">
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
              <div class="col-md-6">
                <div class="card card-table flex-fill">
                    <div class="card-body" style="height:330px; overflow-y:auto;">

                        <div class="card-header">
                            <div class="col-md-6">
                                <h3 class="card-title mb-0">Activity</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <h3 class="card-title mb-0">Weekly Clinic</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderd">
                                <thead>
                                    <tr>
                                        <th>H</th>
                                        <th>Clinic</th>
                                        <th>Date</th>
                                        <th>Patients</th>
                                        <th>Specimens</th>
                                        <th>Collection<br>Status</th>
                                        <th>Reports</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>VN</td>
                                        <td>Dr. Black</td>
                                        <td>23/12/2021</td>
                                        <td>4</td>
                                        <td>12</td>
                                        <td>At Lab</td>
                                        <td>Tick</td>
                                    </tr>
                                    <tr>
                                        <td>VN</td>
                                        <td>Dr. Black</td>
                                        <td>23/12/2021</td>
                                        <td>4</td>
                                        <td>12</td>
                                        <td>At Lab</td>
                                        <td>Tick</td>
                                    </tr>
                                    <tr>
                                        <td>VN</td>
                                        <td>Dr. Black</td>
                                        <td>23/12/2021</td>
                                        <td>4</td>
                                        <td>12</td>
                                        <td>At Lab</td>
                                        <td>Tick</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">
                            Pathologist
                            <i class="fa fa-plus-circle pull-right" data-toggle="modal" data-target="#add_pathologist"
                            style="color:green; margin-left:10px"></i>
                        </h3>
                    </div>
                    <div class="card-body" style="height:330px;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($pathologists as $pathologist):?>
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
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                                            class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

    
</div>

<div class="row">

    <div class="col-md-6">
                                <div class="card card-table flex-fill">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">SOP's
                                            <i class="fa fa-upload pull-right" data-toggle="modal" data-target="#upload_sops"
                                            style="color:green; margin-left:10px"></i>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table custom-table mb-0">
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
                                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document('<?php echo base_url($row->file_path);?>')"><i class="fa fa-eye"></i></a>
                                                                            <a href="<?php echo base_url('Institute/download_forms/'.$row->file_name); ?>" ><i class="fa fa-download"></i></a>
                                                                            <a href="<?php echo base_url('Institute/delete_upload_docs/'.$row->id); ?>" ><i class="fa fa-trash" style="color:red; margin-left:10px"></i></a>
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-table flex-fill">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">Request Form
                                            <i class="fa fa-upload pull-right" data-toggle="modal" data-target="#upload_request_forms"
                                            style="color:green; margin-left:10px"></i>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table custom-table mb-0">
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
                                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document('<?php echo base_url($row->file_path);?>')"><i class="fa fa-eye"></i></a>
                                                                            <a href="<?php echo base_url('Institute/download_forms/'.$row->file_name); ?>" ><i class="fa fa-download"></i></a>
                                                                            <a href="<?php echo base_url('Institute/delete_upload_docs/'.$row->id); ?>" ><i class="fa fa-trash" style="color:red; margin-left:10px"></i></a>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

</div>
<div class="row">
<div class="col-md-6">
                                    <div class="card card-table flex-fill">
                                        <div class="card-header">
                                            <h3 class="card-title mb-0">Request From
                                                <i class="fa fa-plus-circle pull-right" onclick="add_req_from_to_detail('Add Request From Detail','from')" data-toggle="modal" data-target="#add_request_from_to"
                                                style="color:green; margin-left:10px"></i>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table custom-table mb-0">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-table flex-fill">
                                        <div class="card-header">
                                            <h3 class="card-title mb-0">Request To
                                                <i class="fa fa-plus-circle pull-right" onclick="add_req_from_to_detail('Add Request To Detail','to')" data-toggle="modal" data-target="#add_request_from_to"
                                                style="color:green; margin-left:10px"></i>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table custom-table mb-0">
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
                                        </div>
                                    </div>
                                </div>                            
                            
 </div>

  <div class="row">
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
                                            <table class="table custom-table mb-0">
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
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="#" class="avatar dashboard_admin">
                                                                        <img alt="" class="profile-pic"
                                                                        src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                                                        <a href="#client-profile"><?php echo  $uDetail->first_name ?> <span><?php echo  $this->ion_auth->get_users_groups($uDetail->session_userid )->row()->description; ?></span></a>                                    </h2>
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
                                                <a href="<?php echo site_url('institute/allLoginUsers'); ?>">View all Users</a>
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
                            </div>
                        <!-- </div> -->

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

<div class="modal" id="medicine_division">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Medicine Division</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4 form-group"><label for="">General Medicine</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Emergency Department</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Renal Services</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Cancer Services</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="surgery_division">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Surgery Division</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4 form-group"><label for="">Surgical Services</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Head & Neck</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Outpatients</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Operating Departments & Anesthetics</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Orthopaedic and Rheumatology </label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">ICU and HDU</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Sterlie Services</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="family_services_division">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Family Services Division</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4 form-group"><label for="">Maternity and SBCU</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Paediatrics</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">GUM</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Obstetrices and Gynaecology</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="clinical_and_scientific_division">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Clinical and Scientific Division</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4 form-group"><label for="">Therapy Services</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Pathology</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Pharmacy</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Radiology</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Medical Physics</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
            <div class="col-md-4 form-group"><label for="">Audiology</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                    <option value="">Select Option</option>
                </select>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>