        <link rel="stylesheet" href="<?php echo base_url('/assets/subassets/css/bootstrap.min.css')?>">
        <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />


<style type="text/css">
    .noafter:after{
        display: none;
    }
    button.btn.btn-light {
        font-size: 16px;
    }
    .page-buttons .btn .badge{top:-7px;}
    .block-tab li a{font-size: 18px !important}
    label {
        font-size: 16px;
        font-weight: 300;
    }
	
	.tg-tabfieldsettwo .form-group {
    margin: 0;
    padding: 5px;
    width: 25%;
    float: left;
}
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
//debug($specimen_query);exit;

    $record_id = $this->uri->segment(3);
    $user_id = $this->ion_auth->user()->row()->id;
   
    
//    if (!empty($record_edit_status)) {
//        $user_id = $record_edit_status[0]->user_id_for_edit;
//        $edit_timestamp = $record_edit_status[0]->user_record_edit_timestamp;
//        /* Get First & Last Name */
//        $first_name = '';
//        $last_name = '';
//        $getdatils = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$doc_id));
//        //echo last_query();exit;
//      /*  if (!empty($this->ion_auth->user($user_id)->row()->first_name)) {
//            $first_name = $this->ion_auth->user($user_id)->row()->first_name;
//        }
//
//        if (!empty($this->ion_auth->user($user_id)->row()->last_name)) {
//            $last_name = $this->ion_auth->user($user_id)->row()->last_name;
//        }*/
//
//        $edit_full_name = $getdatils[0]->first_name . '&nbsp;' . $getdatils[0]->last_name;
//
//    }
   // debug($request_query);exit;

//    if (!empty($request_query)) {
//        $userid = $request_query[0]->request_add_user;
//        $record_add_timestamp = $request_query[0]->request_add_user_timestamp;
//        $first_name = '';
//        $last_name = '';
//        $getuserdetails = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$userid));
//
//       /* if (!empty($this->ion_auth->user($userid)->row()->first_name)) {
//            $first_name = $this->ion_auth->user($userid)->row()->first_name;
//        }
//        if (!empty($this->ion_auth->user($userid)->row()->last_name)) {
//            $last_name = $this->ion_auth->user($userid)->row()->last_name;
//        }*/
//        $add_full_name = $getuserdetails[0]->first_name . '&nbsp;' . $getuserdetails[0]->last_name;
//    }

    $micro_codes_data = array();
    if (!empty($micro_codes)) {
        foreach ($micro_codes as $mi_codes) {
            $micro_codes_data[] = $mi_codes;
        }
    }

    // if (!empty($user_id) && $edit_timestamp) {
    // } 
    if (!empty($user_id) && isset($edit_timestamp) && $edit_timestamp) {
            ?>
            <div class="user_edit_status">Record Last Edited By : <?php echo $edit_full_name; ?>, At : <?php echo date('d-m-Y h:i:s A', $edit_timestamp); ?>
                <span><a href="javascript:;" data-toggle="modal" data-target="#edit_record_history">View History</a></span>
            </div>
        <?php } ?>
        <?php
        if (!empty($userid) && $record_add_timestamp) {
            ?>
            <div class="user_add_report_status">Record Added By : <?php echo $add_full_name; ?>, At : <?php echo date('d-m-Y h:i:s A', $record_add_timestamp); ?></div>
        <?php } ?>  

<!-- Page Content -->
<style type="text/css">
.sidebar-patient .content{
    background: #f5f5f5 !important;
}
.topUp{top: 62px !important}
.modal-footer{display: block;}
.modal-footer .btn{font-size: 14px !important}
/*.page-wrapper.sidebar-patient{padding-top: 144px !important}*/
.page-header .breadcrumb{padding: 10px 0 30px !important}
.breadcrumb li:first-child:before{
    display: none;
}
.block-tab .pull-right .btn {
    width: 42px !important;
    height: 42px !important;
    float: right;
    font-size: 16px;
    line-height: 2.5;
}
.block-tab .btn .badge {
    color: #fff;
    font-weight: 700;
    position: absolute;
    margin-left: 0;
    margin-top: -10px;
    background: #1b75cd;
    border: solid 2px #ffffff;
    width: 30px;
    height: 30px;
    line-height: 1.5;
    font-size: 13px;
}
</style>
<div class="content container-fluid d-flex new_setting">
            <div class="col-md-12">
            	<div class="row">
            <div class="col-xl-3 col-xxl-2">
            
            </div>
            <div class="col-xl-12 col-xxl-12">
            <div class="dashboard-wrapper patient-group">
            <!-- Page Header -->
            <div class="record_publish_listing">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Records</h3>
                                <div class="clearfix"></div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Record Listing</li>
                                    <li class="breadcrumb-item active">Record Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="page-header">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-left page-title">

                           <span>Lab No: <?php echo $request_query[0]->lab_number?></span>

                        </div>
                       
                        <div class="pull-right">
                        	<a class="badge badge-lg badge-pill badge-danger" href="#">
                                60
                            </a>
                            
                            <a class="badge badge-lg badge-pill badge-success select-flag" data-toggle="collapse" data-target="#flags-select">
                                <i class="fa fa-flag" style="color:#fff"></i>
                            </a>
                            <ul class="list-inline flags-select collapse" id="flags-select">
                                <li>
                                    <a class="badge badge-lg badge-pill badge-success">
                                        <i class="fa fa-flag"></i>
                                    </a>
                                    <a class="badge badge-lg badge-pill badge-info">
                                        <i class="fa fa-flag"></i>
                                    </a>
                                    <a class="badge badge-lg badge-pill badge-danger">
                                        <i class="fa fa-flag"></i>
                                    </a>
                                    <a class="badge badge-lg badge-pill badge-warning">
                                        <i class="fa fa-flag"></i>
                                    </a>
                                    <a class="badge badge-lg badge-pill badge-dark">
                                        <i class="fa fa-flag"></i>
                                    </a>
                                </li>
                            </ul>
                            
                            <a class="badge badge-lg badge-pill badge-primary" href="#">
                                <i class="fa fa-unlock"></i>
                            </a>
                        </div>

                         <div class="pull-right">
                            <div class="tg-searchrecordslide">

                            <form class="tg-formtheme tg-searchrecord" style="margin:12px;">
                                <fieldset>
                                    <div class="form-group tg-inputicon">
                                        <input type="text" class="form-control typeahead" placeholder="Search Record">
                                        <i class="lnr lnr-magnifier"></i>
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                        </div>
                        
                    </div>
			    </div>
			    <div class="clearfix"></div>
			    <ul class="breadcrumb" style="padding:0 !important">
					<li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home" style="font-size:18px;"></i></a></li>
					<li class="breadcrumb-item active"><?php echo $request_query[0]->lab_name?></li>
				</ul>
			    
			    <div class="row">
			    	<div class="col-md-12 nopadding">

                        <div class="col-lg-3 form-group nopadding">
                           
                            <div class="form-focus">
                                <input type="text" class="form-control floating" value="<?php echo $request_query[0]->first_name?>">
                                <label class="focus-label">Name</label>
                            </div>
                        </div>
                        <div class="col-lg-3  form-group nopadding-right">
                            
                            <div class="form-focus">
                                <input type="text" class="form-control floating" value="<?php echo $request_query[0]->emis_number?>">
                                <label class="focus-label">NH No.</label>
                            </div>
                        
                        </div>
                        <div class="col-lg-3  form-group nopadding-right">
                            
                            <div class="form-focus">
                                <input type="text" class="form-control floating" value="21-01-1980">
                                <label class="focus-label">DOB</label>
                            </div>
                        </div>
                        <div class="col-lg-3  form-group nopadding-right">
                            <div class="form-focus">
                                <input type="text" class="form-control floating" value="20S0">
                                <label class="focus-label">Hospital No.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row d-block">

                <div class="card-group">
                    
                    <div class="card saved">
                        <div class="card-body text-muted">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <!-- <i class="fa fa-dot-circle-o mt-3 mr-2"></i> -->
                                    <div>
                                        <span class="d-block font-12">
                                        Clinic Date</span>
                                         <span class="d-block color-grey">
                                         <?php echo $request_query[0]->date_rec_by_doctor?></span>
                                    </div>
                                </div>
                                <div>
                                    <!-- <i class="fa fa-lock mt-3"></i> -->
                                </div>
                            </div>
                           
                        </div>
                    </div>
                     <div class="card saved">
                        <div class="card-body text-muted">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <!-- <i class="fa fa-dot-circle-o mt-3 mr-2"></i> -->
                                    <div>
                                        <span class="d-block font-12">
                                        Date Taken</span>
                                         <span class="d-block color-grey">
                                         <?php echo $request_query[0]->date_taken?></span>
                                    </div>
                                </div>
                                <div>
                                    <!-- <i class="fa fa-lock mt-3"></i> -->
                                </div>
                            </div>
                           
                        </div>
                    </div>
                     <div class="card saved">
                        <div class="card-body text-muted">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <!-- <i class="fa fa-dot-circle-o mt-3 mr-2"></i> -->
                                    <div>
                                        <span class="d-block font-12">
                                        Clinician</span>
                                        <?php
                                        $getClinic = getRecords("*","uralensis_clinician",array("hospital_id"=>$request_query[0]->hospital_group_id));
                                        
                                        ?>
                                         <span class="d-block color-grey">
                                        <?php echo $getClinic[0]->clinician_name?></span>
                                    </div>
                                </div>
                                <div>
                                    <!-- <i class="fa fa-lock mt-3"></i> -->
                                </div>
                            </div>
                           
                        </div>
                    </div>
                     <div class="card saved">
                        <div class="card-body text-muted">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <!-- <i class="fa fa-dot-circle-o mt-3 mr-2"></i> -->
                                    <div>
                                        <span class="d-block font-12">
                                        Surgeon</span>
                                        <?php
                                        $getClinic = getRecords("*","uralensis_dermatological_surgeon",array("hospital_id"=>$request_query[0]->hospital_group_id));
                                        
                                        ?>
                                         <span class="d-block color-grey">
                                        <?php echo ($getClinic[0]->dermatological_surgeon_name!="")?$getClinic[0]->dermatological_surgeon_name:"No Surgeon"?></span>
                                    </div>
                                </div>
                                <div>
                                    <!-- <i class="fa fa-lock mt-3"></i> -->
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    
                </div>
                <div class="card-group patient-group">
                    
                    <div class="card saved">
                        <div class="card-body text-muted">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <!-- <i class="fa fa-dot-circle-o text-white mt-3 mr-3"></i> -->
                                    <div>
                                        <span class="d-block font-12">
                                        EMIC Number</span>
                                         <span class="d-block color-grey">
                                         <?php echo $request_query[0]->emis_number?></span>
                                    </div>
                                </div>
                                <div>
                                    <!-- <i class="fa fa-lock mt-3"></i> -->
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card saved">
                        <div class="card-body text-muted">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <!-- <i class="fa fa-dot-circle-o mt-3 mr-2"></i> -->
                                    <div>
                                        <span class="d-block font-12">
                                        Release from LAB</span>
                                         <span class="d-block color-grey">
                                         <?php echo date("Y/d/m",strtotime($request_query[0]->date_sent_touralensis))?></span>
                                    </div>
                                </div>
                                <div>
                                    <!-- <i class="fa fa-lock mt-3"></i> -->
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card saved">
                        <div class="card-body text-muted">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <!-- <i class="fa fa-dot-circle-o mt-3 mr-2"></i> -->
                                    <div>
                                        <span class="d-block font-12">
                                        Authorized by Doc</span>
                                         <span class="d-block color-grey">
                                         <?php echo date("Y/d/m",strtotime($request_query[0]->date_rec_by_doctor))?></span>
                                    </div>
                                </div>
                                <div>
                                    <!-- <i class="fa fa-lock mt-3"></i> -->
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="card saved">
                        <div class="card-body text-muted">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <!-- <i class="fa fa-dot-circle-o text-white mt-3 mr-3"></i> -->
                                    <div>
                                        <span class="d-block font-12">
                                        PCI NO</span>
                                         <span class="d-block color-grey">
                                        <?php echo $request_query[0]->pci_number?></span>
                                    </div>
                                </div>
                                <div>
                                    <!-- <i class="fa fa-lock mt-3"></i> -->
                                </div>
                            </div>
                           
                        </div>
                    </div>

                </div>

                <div class="card-group patient-group m-b-30">
                    
                </div>

            </div>
            <!-- /Cards -->

            <!-- Tabs -->
            
            <div class="row d-block">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs block-tab nav-tabs-top"  style="position:relative">
                        <?php
                    $active = 'active';
                    $count = 1;
                    foreach ($specimen_query as $row) {
                ?>
                            <li class="nav-item"><a class="nav-link <?php echo $active; ?>" href="#top-tab<?php echo $count; ?>" data-toggle="tab">Specimen <?php echo $count; ?></a></li>
                    <?php 
                  $active = '';
                  $count++;
                } ?>                                         
                         
                    <li>
                        <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" data-target="#related_document"><span class="tg-notificationtag">0</span><i data-toggle="tooltip" data-placement="top" title="" class="ti-link" data-original-title="Related Documents"></i></a>
						<a href="javascript:;" class="tg-detailsicon" id="show_pdf_iframe"><i data-toggle="tooltip" data-placement="top" title="" class="ti-search" data-original-title="View Report"></i></a>
						<a href="https://mskcc.uralensisdigital.co.uk/index.php/doctor/generate_report/44775" target="_blank" class="tg-detailsicon" id="show_pdf_iframe"><i data-toggle="tooltip" data-placement="top" title="" class="ti-notepad" data-original-title="View Final PDF"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#further_work" id="further_work_add"><i data-toggle="tooltip" data-placement="top" title="" class="ti-target" data-original-title="Add Further Work"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-recordid="44775" id="add_to_authorization"><i data-toggle="tooltip" data-placement="top" title="" class="ti-layers" data-original-title="Add to Queue"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#mdt_data_modal"><i data-toggle="tooltip" data-placement="top" title="" class="ti-archive" data-original-title="MDT"></i></a><a href="javascript:;" class="tg-detailsicon request_for_opinion" data-toggle="modal" data-target="#request_for_opinion"><i data-toggle="tooltip" data-placement="top" title="" class="ti-pulse" data-original-title="Request for opinion"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#assign_doctor_modal"><i data-toggle="tooltip" data-placement="top" title="" class="ti-support" data-original-title="Assign to other doctor"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#teaching_cpc_modal"><i data-toggle="tooltip" data-placement="top" title="" class="ti-bell" data-original-title="Assign as teaching and cpc"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#add_supplementary"><i data-toggle="tooltip" data-placement="top" title="" class="ti-plus" data-original-title="Add Supplementarty Report"></i></a>
                        <a href="javascript:;" id="publish_supplementary_btn" data-recordid="44775" class="tg-detailsicon hide_tag_selection"><i data-toggle="tooltip" data-placement="top" title="" class="ti-check-box" data-original-title="Publish Supplementarty Report"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#manage_supple"><i data-toggle="tooltip" data-placement="top" title="" class="ti-wallet" data-original-title="Manage Supplementary"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#related_document"><i class="ti-upload" data-toggle="tooltip" data-placement="top" title="" data-original-title="Uploaded Documents"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#record_download_history"><i data-toggle="tooltip" data-placement="top" title="" class="ti-clipboard" data-original-title="Report Download History"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#rec_history_modal"><i class="ti-folder" data-toggle="tooltip" data-placement="top" title="" data-original-title="Record History"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#relatedrecordscollapse"><i class="ti-harddrives" data-toggle="tooltip" data-placement="top" title="" data-original-title="Related Records"></i></a>
                        <a href="javascript:;" class="tg-detailsicon hide_tag_selection" data-toggle="modal" data-target="#datasets"><i class="ti-harddrive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Datasets"></i></a>
                        <a href="javascript:;" class="tg-detailsicon bg-gray border-gray" id="show_hidden">...</a>
                    </li>
                </ul>
                <div class="tab-content">

                    <?php
                        $tabs_active = 'active';
                        $inner_tab_count = 1;
                        $specimen_total_count = count($specimen_query);
                        foreach ($specimen_query as $key => $row) { 
                            if($inner_tab_count==1){
                    ?>
                    <div class="tab-pane show <?php echo $tabs_active; ?>" id="top-tab<?php echo $inner_tab_count; ?>">
                        <!-- Collapse Start-->
                        <div class="col-md-12">
                            <?php
                            if ($this->session->userdata('id') !== '') {
                                $record_id = $this->session->userdata('id');
                            }
                            ?>
                            <?php
                            if ($this->session->flashdata('upload_error') != '') {
                                echo $this->session->flashdata('upload_error');
                            }
                            ?>
                            <?php
                            if ($this->session->flashdata('upload_success') != '') {
                                echo $this->session->flashdata('upload_success');
                            }
                            ?>
                            <?php
                            if ($this->session->flashdata('delete_file') != '') {
                                echo $this->session->flashdata('delete_file');
                            }
                            ?>
                        </div>

                        

                        <!-- Collapse End -->
                        <div class="row">
                            <div class="col-xl-12">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card doctorCard">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                            <label class="focus-label">Cinical</label>
                                            <img src="<?php echo base_url()?>assets/institute/img/iconBtn.png">
                                            </span>
                                            <input class="form-control" list="desc" style="height:44px;">
                                            <datalist id="desc">
                                                <option value="Clinical Description 1">
                                                </option>
                                                <option value="Clinical Description 2">
                                                </option>
                                                <option value="Clinical Description 3">
                                                </option>
                                                <option value="Clinical Description 4">
                                                </option>
                                                <option value="Clinical Description 5">
                                                </option>
                                            </datalist>
                                        </div>
                                        <textarea class="tinyTextarea"><?php echo $row->specimen_clinical_history; ?></textarea>
                                         <ul class="tg-themeinputbtn">
                                            <li>
                                                <span class="tg-radio">
                                                    <input checked="" class="specimen_classification_1" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_1">
                                                    <label for="specimen_benign_1">BT</label>
                                                </span>
                                            </li>
                                            <li>
                                                 <span class="tg-radio">
                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_1">
                                                    <label for="specimen_inflammation_1">IN</label>
                                                </span>
                                            </li>
                                            <li>
                                                                                                <span class="tg-radio">
                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_atypical" value="atypical" id="specimen_atypical_1">
                                                    <label for="specimen_atypical_1">AT</label>
                                                </span>
                                            </li>
                                            <li>
                                                                                                <span class="tg-radio">
                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_malignant" value="malignant" id="specimen_malignant_1">
                                                    <label for="specimen_malignant_1">MT</label>
                                                </span>
                                            </li>
                                             <li class="pull-right">
                                                <i class="fa fa-dot-circle-o mt-2 mr-2"></i>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="col-xl-6">
                                    <div class="card doctorCard">
                                        <div class="input-group">
                                           <span class="input-group-text" id="basic-addon1">
                                            <label class="focus-label">Macro</label>
                                                <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png">
                                            </span>
                                            <input class="form-control" list="desc" style="height:44px;" />
                                                <datalist id="desc">
                                                  <option value="Macroscopic Description 1">
                                                  <option value="Macroscopic Description 2">
                                                  <option value="Macroscopic Description 3">
                                                  <option value="Macroscopic Description 4">
                                                  <option value="Macroscopic Description 5">
                                                </datalist>  
                                           
                                        </div>
                                        <textarea class="form-control" name="" style="height:155px;"><?php echo $row->specimen_macroscopic_description?></textarea>
                                    </div>
                                </div>                                            
                            </div>
                        
                        </div>


                    
                    </div>




                        <?php $inner_tab_count++;}} ?>
                </div>

                <?php
               
                        $tabs_active = 'active';
                        $inner_tab_count = 1;
                        $specimen_total_count = count($specimen_query);
                       
                        foreach ($specimen_query as $key => $row) { 
                            

                            if($inner_tab_count >1){
                 ?>
                    <div class="tab-pane" id="top-tab<?php echo $inner_tab_count?>">
                    <div class="row">
                            <div class="col-xl-10">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card doctorCard">
                                        <textarea class="tinyTextarea"><?php echo $row->specimen_clinical_history; ?></textarea>
                                         <ul class="tg-themeinputbtn">
                                            <li>
                                                <span class="tg-radio">
                                                    <input checked="" class="specimen_classification_1" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_1">
                                                    <label for="specimen_benign_1">BT</label>
                                                </span>
                                            </li>
                                            <li>
                                                 <span class="tg-radio">
                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_1">
                                                    <label for="specimen_inflammation_1">IN</label>
                                                </span>
                                            </li>
                                            <li>
                                                                                                <span class="tg-radio">
                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_atypical" value="atypical" id="specimen_atypical_1">
                                                    <label for="specimen_atypical_1">AT</label>
                                                </span>
                                            </li>
                                            <li>
                                                                                                <span class="tg-radio">
                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_malignant" value="malignant" id="specimen_malignant_1">
                                                    <label for="specimen_malignant_1">MT</label>
                                                </span>
                                            </li>
                                             <li class="pull-right">
                                                <i class="fa fa-dot-circle-o mt-2 mr-2"></i>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="col-xl-6">
                                    <div class="card doctorCard">
                                        <div class="input-group">
                                           <span class="input-group-text" id="basic-addon1">
                                                <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png">
                                            </span>
                                            <input class="form-control" list="desc" />
                                                <datalist id="desc">
                                                  <option value="Macroscopic Description 1">
                                                  <option value="Macroscopic Description 2">
                                                  <option value="Macroscopic Description 3">
                                                  <option value="Macroscopic Description 4">
                                                  <option value="Macroscopic Description 5">
                                                </datalist>  
                                           
                                        </div>
                                        <textarea class="form-control" name=""><?php echo $row->specimen_macroscopic_description?></textarea>
                                    </div>
                                </div>                                            
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card doctorCard">
                                        <ul>
                                        <li>
                                                Patient initial: <?php echo $row->patient_initial?>
                                            </li>
                                            <li>
                                                Surname: <?php echo $row->sur_name?>
                                            </li>
                                            <li>
                                                First Name: <?php echo $row->f_name?>
                                            </li>
                                            <li>
                                                Lab Number: <?php echo $row->lab_number?>
                                            </li>
                                           
                                        </ul>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png">
                                                </span>
                                            </div>
                                                <input class="form-control" list="desc" />
                                                <datalist id="desc">
                                                  <option value="Macroscopic Description 1" />
                                                  <option value="Macroscopic Description 2" />
                                                  <option value="Macroscopic Description 3" />
                                                  <option value="Macroscopic Description 4" />
                                                  <option value="Macroscopic Description 5" />
                                                </datalist>  
                                           
                                        </div>
                                        <textarea class="form-control" name=""><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                                        <ul class="tg-themeinputbtn">
                                            <li>
                                                <span class="tg-radio">
                                                    <input checked="" class="specimen_classification_1" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_1">
                                                    <label for="specimen_benign_1">BT</label>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="tg-radio">
                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_1">
                                                    <label for="specimen_inflammation_1">IN</label>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="tg-radio">
                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_atypical" value="atypical" id="specimen_atypical_1">
                                                    <label for="specimen_atypical_1">AT</label>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="tg-radio">
                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_malignant" value="malignant" id="specimen_malignant_1">
                                                    <label for="specimen_malignant_1">MT</label>
                                                </span>
                                            </li>
                                             <li class="pull-right">
                                                <i class="fa fa-dot-circle-o mt-2 mr-2"></i>
                                            </li>
                                        </ul>
                                    </div>                                            
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 d-flex">
                                    
                                    <select class="form-control">
                                        <option value="">Diagnosis</option>
                                        <option value="">Diagnosis</option>
                                        <option value="">Diagnosis</option>
                                    </select>
                                    <button class="btn btn-primary btn-sicon">
                                        <img src="<?php echo base_url()?>assets/subassets/img/layersIcon.png" />
                                    </button>
                                    <button class="btn btn-primary btn-sicon">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 d-flex">
                                    
                                <?php
                    $snomed_t_array = getSnomedCodes('t1');
                    $snomed_t_id = $row->specimen_snomed_t;
                    $snomed_t_arr = explode(',', $snomed_t_id);
                ?>
                                    <select class="form-control">
                                    <?php
                        foreach ($snomed_t_array as $snomed_t_code) {
                            $selected = '';
                            $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                            if (in_array($snomed_t, $snomed_t_arr)) {
                                $selected = 'selected';
                            }
                            $added_by = '';
                            if($snomed_t_code['snomed_added_by'] === $user_id){
                                $added_by = 'snomed_provisional';
                            }
                            echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t_code['usmdcode_code'].' '.$snomed_t_code['usmdcode_code_desc'].'</option>';
                        }
                    ?>
                                    </select>
                                    <?php
                    $snomed_p_array = getSnomedCodes('p');
                    $snomed_p_id = $row->specimen_snomed_p;
                    $snomed_p_arr = explode(',', $snomed_p_id);
                ?>
                                    <select class="form-control">
                                    <?php
                        foreach ($snomed_p_array as $snomed_p_code) {
                            $selected = '';
                            $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
                            if (in_array($snomed_p, $snomed_p_arr)) {

                                $selected = 'selected';
                            }
                            $added_by = '';
                            if($snomed_p_code['snomed_added_by'] === $user_id){
                                $added_by = 'snomed_provisional';
                            }
                            echo '<option class="'.$added_by.'" data-pdesc="'.$snomed_p_code['usmdcode_code_desc'].'" value="'.$snomed_p.'" '.$selected.'>'.$snomed_p_code['usmdcode_code'].' '.$snomed_p_code['usmdcode_code_desc'].'</option>';
                        }
                    ?>
                                    </select>

                                    <?php
                    $snomed_t2_array = getSnomedCodes('t1');
                    $snomed_t2_id = $row->specimen_snomed_t2;
                    $snomed_t2_arr = explode(',', $snomed_t2_id);
                ?>
                                    <select class="form-control">
                                    <?php
                        foreach ($snomed_t2_array as $snomed_t2_code) {
                            $selected = '';
                            $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t2_code['usmdcode_code'])));
                            if (in_array($snomed_t, $snomed_t2_arr)) {
                                $selected = 'selected';
                            }
                            $added_by = '';
                            if($snomed_t2_code['snomed_added_by'] === $user_id){
                                $added_by = 'snomed_provisional';
                            }
                            echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t2_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t2_code['usmdcode_code'].' '.$snomed_t2_code['usmdcode_code_desc'].'</option>';
                        }
                    ?>
                                    </select>

                                    <?php
                    $snomed_m_array = getSnomedCodes('m');
                    $snomed_m_id = $row->specimen_snomed_m;
                    $snomed_m_arr = explode(',', $snomed_m_id);
                ?>
                                    <select class="form-control">
                                    <?php
                        foreach ($snomed_m_array as $snomed_m_code) {
                            $selected = '';
                            $snomed_m = strtolower(str_replace(' ', '', trim($snomed_m_code['usmdcode_code'])));
                            if (in_array($snomed_m, $snomed_m_arr)) {

                                $selected = 'selected';
                            }
                            $added_by = '';
                            if($snomed_m_code['snomed_added_by'] === $user_id){
                                $added_by = 'snomed_provisional';
                            }
                            echo '<option class="'.$added_by.'" data-rcpath="'.$snomed_m_code['rc_path_score'].'" data-diagnoses="'.$snomed_m_code['snomed_diagnoses'].'" data-mdesc="'.$snomed_m_code['usmdcode_code_desc'].'" value="'.$snomed_m.'" '.$selected.'>'.$snomed_m_code['usmdcode_code'].' '.$snomed_m_code['usmdcode_code_desc'].'</option>';
                        }
                    ?>
                                    </select>
                                </div>                                            
                            </div>
                        </div>
                    </div>
                            <?php } $inner_tab_count++;} ?>
                   
                </div>
            </div>

            </div>
            
        </div>


        <!-- Tabs -->

       
        <!-- /Buttons Container -->
        </div>




        </div>
        <!-- /Page Content -->
		</div>
        

        <div class="col-md-12 nopadding-right" style="padding-left:30px;">
            <div class="card doctorCard">
                <ul>
                    <li>
                        Patient initial: <?php echo $row->patient_initial?>
                    </li>
                    <li>
                        Surname: <?php echo $row->sur_name?>
                    </li>
                    <li>
                        First Name: <?php echo $row->f_name?>
                    </li>
                    <li>
                        Lab Number: <?php echo $row->lab_number?>
                    </li>
                   <!-- ?> -->
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <label class="focus-label">Microscopy</label>
                            <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png">
                            
                        </span>
                    </div>
                        <input class="form-control" list="desc" style="height:44px;" />
                        <datalist id="desc">
                          <option value="Macroscopic Description 1" />
                          <option value="Macroscopic Description 2" />
                          <option value="Macroscopic Description 3" />
                          <option value="Macroscopic Description 4" />
                          <option value="Macroscopic Description 5" />
                        </datalist>  
                   
                </div>
                <textarea class="form-control" name="" style="min-height:280px;"><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                <ul class="tg-themeinputbtn">
                    <li>
                        <span class="tg-radio">
                            <input checked="" class="specimen_classification_1" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_1">
                            <label for="specimen_benign_1">BT</label>
                        </span>
                    </li>
                    <li>
                        <span class="tg-radio">
                            <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_1">
                            <label for="specimen_inflammation_1">IN</label>
                        </span>
                    </li>
                    <li>
                        <span class="tg-radio">
                            <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_atypical" value="atypical" id="specimen_atypical_1">
                            <label for="specimen_atypical_1">AT</label>
                        </span>
                    </li>
                    <li>
                        <span class="tg-radio">
                            <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_malignant" value="malignant" id="specimen_malignant_1">
                            <label for="specimen_malignant_1">MT</label>
                        </span>
                    </li>
                     <li class="pull-right">
                        <i class="fa fa-dot-circle-o mt-2 mr-2"></i>
                    </li>
                </ul>
            </div>                                            
        </div>
        <div class="col-md-12 nopadding-right mb-3">
            <div class="col-md-12 nopadding-right d-flex">
                
                <select class="form-control">
                    <option value="">Diagnosis</option>
                    <option value="">Diagnosis</option>
                    <option value="">Diagnosis</option>
                </select>
                <button class="btn btn-primary btn-sicon">
                    <img src="<?php echo base_url()?>assets/subassets/img/layersIcon.png" />
                </button>
                <button class="btn btn-primary btn-sicon">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
            
        </div>
        <div class="mb-3">
            <div class="col-md-12 nopadding-right d-flex">
                <div class="col-md-3 nopadding-right">
                        <?php
            $snomed_t_array = getSnomedCodes('t1');
            $snomed_t_id = $row->specimen_snomed_t;
            $snomed_t_arr = explode(',', $snomed_t_id);
            ?>
                            <select class="form-control">
                            <?php
                foreach ($snomed_t_array as $snomed_t_code) {
                    $selected = '';
                    $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                    if (in_array($snomed_t, $snomed_t_arr)) {
                        $selected = 'selected';
                    }
                    $added_by = '';
                    if($snomed_t_code['snomed_added_by'] === $user_id){
                        $added_by = 'snomed_provisional';
                    }
                    echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t_code['usmdcode_code'].' '.$snomed_t_code['usmdcode_code_desc'].'</option>';
                }
            ?>
                            </select>
                            </div>
                            <div class="col-md-3 nopadding-right">
                            <?php
            $snomed_p_array = getSnomedCodes('p');
            $snomed_p_id = $row->specimen_snomed_p;
            $snomed_p_arr = explode(',', $snomed_p_id);
            ?>
                            <select class="form-control">
                            <?php
                foreach ($snomed_p_array as $snomed_p_code) {
                    $selected = '';
                    $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
                    if (in_array($snomed_p, $snomed_p_arr)) {

                        $selected = 'selected';
                    }
                    $added_by = '';
                    if($snomed_p_code['snomed_added_by'] === $user_id){
                        $added_by = 'snomed_provisional';
                    }
                    echo '<option class="'.$added_by.'" data-pdesc="'.$snomed_p_code['usmdcode_code_desc'].'" value="'.$snomed_p.'" '.$selected.'>'.$snomed_p_code['usmdcode_code'].' '.$snomed_p_code['usmdcode_code_desc'].'</option>';
                }
            ?>
                            </select>
                            </div>
                            <div class="col-md-3 nopadding-right">

                            <?php
            $snomed_t2_array = getSnomedCodes('t1');
            $snomed_t2_id = $row->specimen_snomed_t2;
            $snomed_t2_arr = explode(',', $snomed_t2_id);
            ?>
                            <select class="form-control">
                            <?php
                foreach ($snomed_t2_array as $snomed_t2_code) {
                    $selected = '';
                    $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t2_code['usmdcode_code'])));
                    if (in_array($snomed_t, $snomed_t2_arr)) {
                        $selected = 'selected';
                    }
                    $added_by = '';
                    if($snomed_t2_code['snomed_added_by'] === $user_id){
                        $added_by = 'snomed_provisional';
                    }
                    echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t2_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t2_code['usmdcode_code'].' '.$snomed_t2_code['usmdcode_code_desc'].'</option>';
                }
            ?>
                            </select>
</div>
<div class="col-md-3 nopadding-right">
                            <?php
            $snomed_m_array = getSnomedCodes('m');
            $snomed_m_id = $row->specimen_snomed_m;
            $snomed_m_arr = explode(',', $snomed_m_id);
            ?>
                            <select class="form-control">
                            <?php
                foreach ($snomed_m_array as $snomed_m_code) {
                    $selected = '';
                    $snomed_m = strtolower(str_replace(' ', '', trim($snomed_m_code['usmdcode_code'])));
                    if (in_array($snomed_m, $snomed_m_arr)) {

                        $selected = 'selected';
                    }
                    $added_by = '';
                    if($snomed_m_code['snomed_added_by'] === $user_id){
                        $added_by = 'snomed_provisional';
                    }
                    echo '<option class="'.$added_by.'" data-rcpath="'.$snomed_m_code['rc_path_score'].'" data-diagnoses="'.$snomed_m_code['snomed_diagnoses'].'" data-mdesc="'.$snomed_m_code['usmdcode_code_desc'].'" value="'.$snomed_m.'" '.$selected.'>'.$snomed_m_code['usmdcode_code'].' '.$snomed_m_code['usmdcode_code_desc'].'</option>';
                }
            ?>
                </select>
                </div>
            </div>                                            
        </div>
    </div>

    
    <div class="row">
        <div class="col-xl-12 doctorRCard nopadding-right">
            <div class="col-md-6 form-group nopadding-right">
                <div class="card">
                    <div class="card-body pad-0 text-muted">
                        <textarea class="form-control" style="min-height:160px">Comments</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-group nopadding-right">
                <div class="card">
                    <div class="card-body pad-0 text-muted">
                        <textarea class="form-control"  style="min-height:160px"> Special Notes</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 nopadding-right form-group">
            <div class="col-md-4 nopadding-right">
                <div class="form-group">
                    <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage"><i class="fa fa-envelope-o fa-2x"></i></a>
                    <textarea name="specimen_feedback_to_lab" class="form-control" placeholder="Feedback to Lab:" style="min-height:160px"><?php echo $row->specimen_feedback_to_lab; ?></textarea>
                </div>
            </div>
            <div class="col-md-4 nopadding-right">
                <div class="form-group">
                    <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage"><i class="fa fa-envelope-o fa-2x"></i></a>
                    <textarea name="specimen_feedback_to_secretary" class="form-control" placeholder="Feedback to Secretary:" style="min-height:160px"><?php echo $row->specimen_feedback_to_secretary; ?></textarea>
                </div>
            </div>
            <div class="col-md-4 nopadding-right">
                <div class="form-group">
                    <a class="form-group-btn btn btn-default" href="#" data-toggle="modal" data-target="#sendprivatemessage"><i class="fa fa-envelope-o fa-2x"></i></a>
                    <textarea name="specimen_error_log" class="form-control" placeholder="Error Log:"  style="min-height:160px"><?php echo $row->specimen_error_log; ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div id="sendprivatemessage" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send Private Message</h4>
                </div>
                <div class="modal-body">
                    <div class="form tg-formtheme tg-editform">
                        <fieldset>
                            <?php
                                //Get Lab Number and Serial Number as Subject for Private Message
                                $serial_no = $request_query[0]->serial_number;
                                $lab_no = $request_query[0]->lab_number;

                                $priv_msg_subject = $serial_no .'&nbsp;|&nbsp;'. $lab_no;
                                //Get laboratory user id.
                                $lab_name = $request_query[0]->lab_name;
                                $laboratory_id = getLaboratoryUserId($lab_name);
                                $button_disableb = '';
                                $lab_user_id = '';
                                if(!empty($laboratory_id)){
                                    $lab_user_id = $laboratory_id['user_lab_default_status'];
                                    $lab_name = $laboratory_id['description'];
                                }
                                if(empty($laboratory_id['user_lab_default_status'])){
                                    $button_disableb = 'disabled';
                                    echo '<div class="alert alert-danger">This lab did not set any default user to receive private message, Please set first from admin side in edit group section or contact with Administrator.</div>';
                                }
                            ?>
                            <div class="form-group tg-inputwithicon" style="width:100%;">
                                <input readonly type="text" name="lab_name" value="" id="lab_name" class="form-control" placeholder="<?php echo $lab_name; ?>">
                                <input type="hidden" name="lab_name_id" value="<?php echo intval($lab_user_id); ?>">
                            </div>
                            <div class="form-group tg-inputwithicon" style="width:100%;">
                                <input readonly type="text" name="privmsg_subject" value="<?php echo $priv_msg_subject; ?>" id="privmsg_subject" maxlength="" size="40" class="form-control" placeholder="Subject">
                            </div>
                            <div class="form-group tg-inputwithicon" style="width:100%;">
                                <textarea name="privmsg_body" cols="80" rows="5" id="privmsg_body" class="form-control" placeholder="Message"></textarea>
                            </div>
                            <div class="tg-btnarea">
                                <input type="hidden" name="record_id" value="<?php echo intval($record_id); ?>">
                                <button <?php echo $button_disableb; ?> type="button" class="tg-btn specimen_pm_msg_btn">Send</button>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-12 nopadding-right">
            <!-- Buttons Container -->
            <div class="page-buttons">
                <button class="btn btn-light">
                    <i class="fa fa-dot-circle-o mr-3"></i>
                    Lab: 
                    <span class="badge badge-pill bg-blue">3</span>
                </button>

                <button class="btn btn-light">
                    <i class="fa fa-dot-circle-o"></i>
                    Secretary: 
                    <span class="badge badge-pill bg-blue">3</span>
                </button>

                <button class="btn btn-light">                            
                    Error Log: 
                    <span class="badge badge-pill bg-blue">3</span>
                </button>
               
                <button class="btn btn-light">
                    <span class="badge badge-pill bg-blue">3</span>
                    Primary Doctors                             
                </button>

                <button class="btn btn-light">
                    <span class="badge badge-pill bg-blue">3</span>
                    Others                             
                </button>
                <button class="btn btn-light">
                    <span class="badge badge-pill bg-blue">3</span>
                    GI                            
                </button>
                <button class="btn btn-light">
                    <span class="badge badge-pill bg-blue">3</span>
                    Others                             
                </button>
                <button class="btn btn-primary btn-sm btn-round">
                   <i class="fa fa-arrow-right"></i>                             
                </button>

                <button type="button" class="btn btn-primary btn-lg pull-right">Update Record</button>
            </div>
        </div>
</div>


<div id="add_supplementary" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Supplementary</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('doctor/additional_work'); ?>">
                    <div class="form-group">
                        <label for="additional_work">Add Supplementary Report:</label>
                        <textarea class="form-control" rows="5" id="additional_work" name="additional_description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>







<div id="request_for_opinion" class="modal fade" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close btn-dismis" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Opinion Request</h4>
        </div>
        <div class="modal-body">
            <?php $rec_id = $this->uri->segment(3); ?>
            <form class="form opinion_cases_form">
                <div class="form-group">
                    <label for="opinion_case_doctors">Choose Doctors</label>
                    <select multiple class="form-control" style="padding:2px;" name="opinion_case_doctors[]" id="opinion_case_doctors">
                        <?php
                        if (!empty($list_doctors)) {
                            foreach ($list_doctors as $value) {
                                ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Opinion Request Date</label>
                    <input type="text" value="" readonly class="form-control" name="opinion_date"  id="opinion_date" placeholder="Opinion Request Date">
                    <input type="hidden" value="" name="opinion_date"  id="opinion_date_hide">
                </div>
                <div class="form-group">
                    <label for="opinion_comment">Opinion Comment</label>
                    <textarea id="opinion_comment" name="opinion_comment" class="form-control"></textarea>
                </div>
                <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
                <div class="form-group">
                    <button type="button" class="btn btn-success assign_to_opinion_case">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div id="assign_doctor_modal" class="modal fade" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Assign to other doctor</h4>
        </div>
        <div class="modal-body">
            <div class="assign_doctor_and_authorize">
                <div class="doctor_assign_msg"></div>
                <form id="doctor_assign_form">
                    <select class="form-control" name="assign_doctor" id="assign_doctor">
                        <option value="0">Choose Doctor</option>
                        <?php
                        if (!empty($list_doctors)) {
                            foreach ($list_doctors as $value) {
                                ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div id="teaching_cpc_modal" class="modal fade" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Education and CPC</h4>
        </div>
        <div class="modal-body">
            <form id="teach_and_mdt_form" class="form teach_and_mdt_form">
                <div class="teach_mdt_cpc_msg"></div>
                <div class="form-group">
                    <label for="education_cats">Education</label>
                    <select name="education_cats" id="education_cats" class="form-control">
                        <option value="0">Select Education Category</option>
                        <?php
                        if (!empty($education_cats)) {
                            foreach ($education_cats as $cats) {
                                $selected = '';
                                if ($cats->ura_tec_mdt_id === $request_query[0]->teaching_case) {
                                    $selected = 'selected';
                                }
                                echo '<option ' . $selected . ' value="' . $cats->ura_tec_mdt_id . '">' . $cats->ura_tech_mdt_cat . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cpc_cats">CPC</label>
                    <select name="cpc_cats" id="cpc_cats" class="form-control">
                        <option value="0">Select CPC Category</option>
                        <?php
                        if (!empty($cpc_cats)) {
                            foreach ($cpc_cats as $cats) {
                                echo '<option value="' . $cats->ura_tec_mdt_id . '">' . $cats->ura_tech_mdt_cat . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="record_id" id="record_id" value="<?php echo $record_id; ?>">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div id="record_download_history" class="modal fade" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Record Download History</h4>
        </div>
        <div class="modal-body">
            <table class='table table-bordered'>
                <tr>
                    <th>ID</th>
                    <th>Record</th>
                    <th>Timestamp</th>
                </tr>
                <?php
                if (!empty($download_history)) {
                    foreach ($download_history as $key => $value) {
                        $timestamp = '';
                        if (!empty($value['ura_bulk_report_timestamp'])) {
                            $timestamp = date('d-m-Y H:i:s', $value['ura_bulk_report_timestamp']);
                        }
                        ?>
                        <tr>
                            <td><?php echo $value['ura_bulk_report_history']; ?></td>
                            <td><?php echo $value['ura_bulk_report_record_data']; ?></td>
                            <td><?php echo $timestamp; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
</div>

                <div id="rec_history_modal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Record History</h4>
                            </div>
                            <div class="modal-body">

                                <table class='table table-bordered'>
                                    <tr>
                                        <th>Record Status</th>
                                        <th>User Name</th>
                                        <th>Date/Time</th>
                                    </tr>
                                    <?php if (!empty($record_history)) { ?>
                                        <?php
                                        $counter = 1;
                                        foreach ($record_history as $history) {
                                            $action_name = "Edited";
                                            $username = "Adeel Yaqoob";
                                            $change_class = 'style="background: #666699; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                                            if ($history['rec_history_status'] === 'view') {
                                                $change_class = 'style="background: #009999; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                                                $action_name = "Viewed";
                                            } elseif ($history['rec_history_status'] === 'publish') {
                                                $change_class = 'style="background: #70db70; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                                                $action_name = "Published";
                                            } elseif ($history['rec_history_status'] === 'fw_add') {
                                                $change_class = 'style="background: #e67300; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                                                $action_name = "Further Work Requested";
                                            } elseif ($history['rec_history_status'] === 'supple_add') {
                                                $change_class = 'style="background: #cc00cc; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                                                $action_name = "Supplementary Report Added";
                                            } elseif ($history['rec_history_status'] === 'supple_publish') {
                                                $change_class = 'style="background: #ccccff; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                                                $action_name = "Supplementary Report published";
                                            } elseif ($history['rec_history_status'] === 'unpublish') {
                                                $change_class = 'style="background: #999966; padding: 7px; color: #fff; font-size: 15px; font-weight: bold; margin: 0 0 10px 0;"';
                                                $action_name = "Report Un-Published";
                                            }
                                            ?>
                                            <tr <?php echo $change_class; ?> >
                                                <td><?php echo $action_name; ?></td>
                                                <td><?php echo $username; ?></td>
                                                <td>
                                                    <?php
                                                    $get_time = '';
                                                    if (!empty($history['timestamp'])) {
                                                        $get_time = date('d/m/Y -- (H:i:s A)', $history['timestamp']);
                                                    }
                                                    echo $get_time;
                                                    ?>

                                                </td>
                                            </tr>
                                            <?php
                                            $counter++;
                                        }
                                        ?>
                                    <?php } ?>


                                </table>
                                <div id="edit_history_dynamic_id" class="collapse edit_history_collapse">
                                    <?php
                                    $record_fields = '';
                                    if (isset($history)) {
                                        $record_fields = unserialize($history['rec_history_data']);
                                    }
                                    if (!empty($record_fields)) {
                                        ?>
                                        <table class="table table-striped">
                                            <?php foreach ($record_fields as $key => $value) { ?>
                                                <tr>
                                                    <td><?php echo $key; ?></td>
                                                    <td><?php echo $value; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<!--Show this modal when user wants to add message-->
<div id="mdt_message_modal" class="modal fade" role="dialog">
<div class="modal-dialog">
    <div class="modal-content" style="width:100%;float:left;">
        <div class="modal-header">
            <h4 class="modal-title">MDT Message</h4>
        </div>
        <div class="modal-body">
       
            <form class="form" id="mdt_message_form">
                <div class="form-group">
                    <label for="add_mdt_message">Add MDT Message</label>
                    <textarea class="form-control" id="add_mdt_message" name="mdt_message"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="record_id" value="<?php echo $this->uri->segment(3); ?>">
                    <button class="btn btn-primary" id="add_mdt_msg_btn">Add Message</button>
                    <button class="btn btn-warning pull-right" id="leave_mdt_notes_msg_btn">Leave this.</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--Show this modal when user wants to add message-->
<div id="add_supplementary" class="modal fade" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Supplementary</h4>
        </div>
        <div class="modal-body">
            <form method="post" action="<?php echo site_url('doctor/additional_work'); ?>">
                <div class="form-group">
                    <label for="additional_work">Add Supplementary Report:</label>
                    <textarea class="form-control" rows="5" id="additional_work" name="additional_description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


<div id="related_document" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Related Documents</h4>
            </div>
            <div class="modal-body">
            <?php echo form_open('doctor/do_upload/' . $record_id, array('class' => 'form-inline')); ?>
                
                    <div class="form-group">
                        <input required id="upload_user_file" class="form-control" type="file" name="userfile" />
                    </div>
                    <button type="submit" class="btn btn-default">Upload</button>
                </form>
                <div id="files">
                    <table class="table table-striped custom-table">
                        <h3>Files</h3>
                        <tr>
                            <th>File Name</th>
                            <th>Type</th>
                            <th>File Ext</th>
                            <th>View File</th>
                            <th>Download File</th>
                            <th>Delete</th>
                            <th>Uploaded by</th>
                            <th>Upload On</th>
                        </tr>
                        <?php
                        if (isset($files) && is_array($files)) {
                            $doctor_id = $this->ion_auth->user()->row()->id;
                            $record_id = $this->uri->segment(3);
                            foreach ($files as $file) {
                                $file_id = $file->files_id;
                                $file_path = $file->file_path;
                                $session_data = array(
                                    'file_path' => $file_path
                                );
                                $file_ext = ltrim($file->file_ext, ".");
                                $modify_ext = strtolower($file_ext);
                                $this->session->set_userdata($session_data);
                                ?>
                                <tr>
                                    <td><?php echo $file->title; ?></td>
                                    <td><?php
                                        if ($file->is_image == 1) {
                                            echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                        } else {
                                            echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $file->file_ext; ?></td>
                                    <td>
                                        <a data-exttype="<?php echo $modify_ext; ?>"  data-imageurl="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                            <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                            <?php echo ucfirst($file->title); ?>
                                        </a>
                                        <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                            <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                <img src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>">
                                                <hr>
                                                <button class="btn btn-warning" id="close_hover_image">Close</button>
                                            </div>
                                        <?php } ?>
                                        <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                            <div style="display:none;" class="hover_image_frame hover_<?php echo $modify_ext; ?>" >
                                                <iframe width="700" height="500"  src="<?php echo base_url() . 'uploads/' . $file->file_name; ?>"></iframe>
                                                <hr>
                                                <button class="btn btn-danger" id="close_hover_image">Close</button>
                                            </div>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a download href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                            <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                            <?php echo ucfirst($file->title); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if ($doctor_id == $file->user_id) : ?>
                                            <a href="<?php echo site_url() . '/doctor/delete_record_files?file_id=' . $file_id . '&record_id=' . $record_id; ?>">
                                                <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                            </a>
                                        <?php else : ?>
                                            <span>No Access</span>
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo ucwords($file->user); ?></td>
                                    <td><?php
                                        $time = $file->upload_date;
                                        echo date('M j Y g:i A', strtotime($time));
                                        ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="relatedrecordscollapse" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Related Record</h4>
        </div>
        <div class="modal-body">
            <?php
                $hospital_name = '';
                if (!empty($related_query)) {
                    $hospital_name = $this->ion_auth->group($related_query[0]->hospital_group_id)->row()->description;
                    display_related_posts($related_query, $hospital_name);
                } else {
                    echo '<div class="alert alert-info">Sorry No Related Records Found.</div>';
                }
            ?>
        </div>
    </div>
</div>
</div>

<div id="datasets" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Data Sets</h4>
        </div>
        <div class="modal-body">
        </div>
    </div>
</div>
</div>

<div id="further_work" class="modal fade" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Further Work</h4>
        </div>
        <div class="modal-body">
            <div class="fw_msg"></div>
            <form id="further_work_form" method="post">
                <div class="form-group">
                    <?php
                    $req_id = $this->uri->segment(3);
                    $doc_name = $this->session->userdata('doc_name');
                    $check_count = 1;
                    $hospital_id = $request_query[0]->hospital_group_id;
                    $get_cost_codes['cost_codes'] = $this->Doctor_model->get_cost_codes($hospital_id);


                    if (!empty($get_cost_codes['cost_codes'])) {
                        foreach ($get_cost_codes['cost_codes'] as $codes) {
                            $selected = '';
                            $fw_levels = '';
                            if ($codes->ura_cost_code_type == $request_query[0]->fw_levels) {
                                $selected = 'checked disabled';
                                $fw_levels = $codes->ura_cost_code_type;
                            }
                            if ($codes->ura_cost_code_type == $request_query[0]->fw_immunos) {
                                $selected = 'checked disabled';
                                $fw_levels = $codes->ura_cost_code_type;
                            }
                            if ($codes->ura_cost_code_type == $request_query[0]->fw_imf) {
                                $selected = 'checked disabled';
                                $fw_levels = $codes->ura_cost_code_type;
                            }
                            ?>
                            <input type="hidden" name="<?php echo $codes->ura_cost_code_type; ?>" value="<?php echo $fw_levels; ?>">

                            <label for="report_check_<?php echo $check_count; ?>"><?php echo $codes->ura_cost_code_desc; ?></label>
                            <input id="report_check_<?php echo $check_count; ?>" <?php echo $selected; ?> name="<?php echo $codes->ura_cost_code_type; ?>" type="checkbox" value="<?php echo $codes->ura_cost_code_type; ?>">
                            <?php
                            $check_count++;
                        }//endforeach
                    }//endif
                    ?>
                </div>
                <div class="form-group">
                    <label>Further Work Date</label>
                    <input type="text" value="" readonly class="form-control" name="furtherwork_date"  id="furtherwork_date" placeholder="Further Work Date">
                    <input type="hidden" value="" name="furtherwork_date"  id="further_work_date_hide">
                </div>
                <div class="form-group">
                    <label for="further_work">Further Work:</label>
                    <textarea class="form-control" rows="5" id="further_work" name="description"></textarea>
                </div>
                <input type="hidden" name="record_id" value="<?php echo $req_id; ?>">
                <input type="hidden" name="hospital_group_id" value="<?php echo $hospital_id; ?>"> 
                <button type="button" id="fw_submit_btn" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
</div>
<?php
$record_id = $this->uri->segment(3);
$user_id = $this->ion_auth->user()->row()->id;
?>
<div id="display_iframe_pdf" class="modal fade display_iframe_pdf" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="max-height:630px;">
            <object type="application/pdf" data="<?php echo site_url() . '/doctor/view_report/' . $record_id; ?>" width="100%" style="height: 95vh;">No Support</object>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-danger btn-dismis pull-right" data-dismiss="modal">Close</button> -->
            <?php if ($request_query[0]->specimen_update_status == 1 && $request_query[0]->specimen_publish_status == 0) { ?>
                <a class="pull-left" style="cursor: pointer;" data-toggle="modal" data-target="#user_auth_popup">
                    <img data-toggle="tooltip" data-placement="top" title="Click To Publish This Report" src="<?php echo base_url('assets/img/pdf.png'); ?>">
                </a>
            <?php } else { ?>
                <p class="label label-success pull-left" style="font-size:16px;">Report Already Has Been Published!</p>
            <?php } ?>
        </div>
    </div>
</div>
</div>


<?php if ($request_query[0]->specimen_update_status == 1 && $request_query[0]->specimen_publish_status == 0) { ?>
<div id="user_auth_popup" class="modal fade user_auth_popup" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Publish Report</h4>
            </div>
            <div class="modal-body">
                <?php if (empty($request_query[0]->mdt_case) && empty($request_query[0]->mdt_case_status)) { ?>
                    <div class="well">
                        <p>Please Select One Of The MDT Option.</p>
                        <button class="btn btn-sm btn-success" id="close_popups_for_mdt">Add MDT</button>
                    </div>
                <?php } ?>
                <div id="publish_button"></div>
                <div class="publish_report_form">
                <form class="form" method="post" id="check_auth_pass_form">
                    <?php
                    $split_surname = uralensis_get_record_db_detail($record_id, 'sur_name');
                    if (!empty($split_surname)) { 
                    ?>
                        <div class="form-group ura-surname-field" data-recordid="<?php echo $record_id; ?>">
                        <p><strong>Enter Surname Letters.</strong></p>
                        <p><strong>* </strong><em>Insert Surname from Request Form as final ID check.</em></p>
                            <?php 
                                $dom_array = array();
                                $splitted_name = str_split(strtolower($split_surname));
                                $custom_split_data = array();
                                if (!empty($splitted_name)) {
                                    foreach ($splitted_name as $key_name => $key_value) {
                                        $dom_array[] = trim($key_value);
                                        echo '<input maxlength="1" type="text" data-namekey="'.$key_name.'" data-namevalue="'.$key_value.'" name="checksurname[]"> '; 
                                    }
                                }
                            ?>
                            <input type="hidden" name="surname_data" value='<?php echo count($dom_array) - 1; ?>'>
                        </div>
                        <div class="ura-pin-area">
                            <div class="form-group ura-password-fields">
                                <p>Enter Your Pin To Publish This Report.</p>
                                <input autofocus maxlength="1" type="password" id="auth_pass1" name="auth_pass1">
                                <input maxlength="1" type="password" name="auth_pass2">
                                <input maxlength="1" type="password" name="auth_pass3">
                                <input maxlength="1" type="password" name="auth_pass4">
                                <input name="request_id" type="hidden" value="<?php echo $record_id; ?>">
                                <input name="user_id" type="hidden" value="<?php echo $user_id; ?>">
                                <?php
                                if (empty($request_query[0]->mdt_case) && empty($request_query[0]->mdt_case_status)) {
                                    echo '<input name="mdt_not_select" type="hidden" value="mdt_uncheck">';
                                }
                                ?>
                            </div>
                            <div class="form-group"><button type="button" id="check_pass" class="btn btn-warning pull-right">Submit</button></div>
                        </div>
                        <div class="clearfix"></div>
                        <?php 
                        } else {
                            echo 'Please enter the surname first.';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script>
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
        if (scroll >= 150) {
            $(".second-sidebar").addClass("topUp");
        }else{
          $(".second-sidebar").removeClass("topUp");
        }
    });
</script>