<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-62px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }
    .customBtn{
    padding: 5px 20px !important;
    border-radius: 5px !important;
    color: white !important;
    font-weight: 500 !important;
    font-size: 16px !important;
}
    table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting{
        padding-right: 15px !important
    }
    .custome_BTN label:focus{
        background: #006df1;
        color: #fff !important;
        border-color: #006df1;
    }
    .breadcrumb{padding: 0 !important}
    .tg-cancel input{
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 45px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
    }
    .form-width {
    width: 19%;
}
    div#doctor_record_publish_table_filter {

}
div#doctor_record_publish_table_length{
    position: absolute;
}
div.dataTables_wrapper div.dataTables_length select {
    top: -60px;
    left: 0;
}
.dataTables_wrapper .row+.row {
    width: auto;
}

    @media screen and (min-width: 1600px) {
        body{font-size: 18px;}
    }
     @media screen and (max-width: 1380px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }
        div.dataTables_wrapper div.dataTables_length select{top: -59px;}
    }
    .action_th_icon{
        float: right !important;
    }
	
	td a.hospital_initials {
    display: block;
    width: 30px;
    height: 30px;
    background: #1b75cd;
    color: #ffffff;
    text-align: center;
    border-radius: 50%;
    line-height: 30px;
    font-size: 11px;
    letter-spacing: -1px;
}
	
</style>
<div class="content tablewidth container-fluid publish-record">
        <div class="row">
        <div class="speace-setup col-sm-12">
        <h3 class="page-title">Records</h3>
</div>
 </div>
 <div class="row">
     <div class="col-sm-6 col-lg-6">
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                <li><a href="javascript:;">Dashboard</a></li>
                <li class="active">Publish Reports</li>
            </ol>
</div>
</div>
<div class="col-sm-6 col-lg-6">
            <div class="tg-rightarea">
                <div class="tg-haslayout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    </div>
                </div>

                <!-- <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse_filter_hospital">Filter By Hospital</button> -->
            </div>
        </div>
    </div>

    <div class="tg-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold">
                    <ul class="tg-filters record-list-filters">
                        <li class="tg-statusbar tg-flagcolor">
                        </li>
                        <li class="hide tg-statusbar tg-flagcolor" style="padding: 5px">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                <span class="tg-radio tg-flagcolor1">
                                    <input class="tat" name="tat" id="tat5"  type="radio" onClick="gettatvalue(5)">
                                    <label for="tat5"><span>&lt;5</span></label>
                                </span>
                                <span class="tg-radio tg-flagcolor2">
                                    <input class="tat" type="radio" name="tat" id="tat10" onClick="gettatvalue(10)">
                                    <label for="tat10"><span>&lt;10</span></label>
                                </span>
                                <span class="tg-radio tg-flagcolor3">
                                    <input class="tat" type="radio" name="tat" id="tat20" onClick="gettatvalue(20)">
                                    <label for="tat20"><span>&lt;20</span></label>
                                </span>
                                <span class="tg-radio tg-flagcolor4">
                                    <input class="tat" type="radio" name="tat" id="tat30" onClick="gettatvalue(30)">
                                    <label for="tat30"><span>&gt;20</span></label>
                                </span>
                                <span class="tg-cancel tg-flagcolor4" style="display: none;">
                                    <input class="tat" type="radio" name="tat" id="all_tat">
                                    <label for="all_tat">
                                        <img src="<?php echo base_url(); ?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>

                            </div>
                        </li>

                        <li class=" tg-flagcolor" style="padding: 3px 8px">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo flags_check">
                                <?php
if ($this->session->userdata('color_code') !== '') {
	$session_color = $this->session->userdata('color_code');
}
?>
                                <span class="tg-radio tg-flagcolor1 first">

                                    <input type="radio" id="flag_blue" class="flag_status" name="flag_sorting">
                                    <label for="flag_blue"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor2">

                                    <input type="radio" id="flag_green" class="flag_status" name="flag_sorting">
                                    <label for="flag_green"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor3">

                                    <input type="radio" id="flag_yellow" class="flag_status" name="flag_sorting">
                                    <label for="flag_yellow"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor4">

                                    <input type="radio" id="flag_black" class="flag_status" name="flag_sorting">
                                    <label for="flag_black"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor5">

                                    <input type="radio" id="flag_red" class="flag_status" name="flag_sorting">
                                    <label for="flag_red"></label>
                                </span>
                                <span class="tg-cancel tg-flagcolor6" style="display: none">
                                    <input checked type="radio" class="flag_status"  name="flag_sorting" id="flag_all">
                                    <label for="falg_all">
                                        <img src="<?php echo base_url(); ?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li>

                       <!--  <li class="tg-flagcolor" style="padding: 3px 8px">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                <?php
if ($this->session->userdata('color_code') !== '') {
	$session_color = $this->session->userdata('color_code');
}
?>
                                <span class="tg-radio tg-flagcolor1">
                                    <?php
$checked = '';
if (!empty($session_color) && $session_color === 'blue') {
	$checked = 'checked';
}
?>
                                    <input type="radio" id="flag_blue" class="flag_status" name="flag_sorting" <?php echo $checked; ?>>
                                    <label for="flag_blue"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor2">
                                    <?php
$checked = '';
if (!empty($session_color) && $session_color === 'green') {
	$checked = 'checked';
}
?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_green" class="flag_status" name="flag_sorting">
                                    <label for="flag_green"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor3">
                                    <?php
$checked = '';
if (!empty($session_color) && $session_color === 'yellow') {
	$checked = 'checked';
}
?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_yellow" class="flag_status" name="flag_sorting">
                                    <label for="flag_yellow"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor4">
                                    <?php
$checked = '';
if (!empty($session_color) && $session_color === 'black') {
	$checked = 'checked';
}
?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_black" class="flag_status" name="flag_sorting">
                                    <label for="flag_black"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor5">
                                    <?php
$checked = '';
if (!empty($session_color) && $session_color === 'red') {
	$checked = 'checked';
}
?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_red" class="flag_status" name="flag_sorting">
                                    <label for="flag_red"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor6">
                                    <?php
$checked = '';
if (empty($session_color)) {
	$checked = 'checked';
}
?>
                                    <input <?php echo $checked; ?> type="radio" id="flag_all" class="flag_status" name="flag_sorting">
                                    <label for="flag_all"></label>
                                </span>
                                <span class="tg-cancel tg-flagcolor4" style="display: none;">
                                    <input class="tat" type="radio" name="tat" id="all_tat">
                                    <label for="all_tat">
                                        <img src="<?php echo base_url(); ?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li> -->
                        <li class=" tg-statusbar tg-flagcolor custome-flagcolors">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">

                                <span class="tg-radio tg-flagcolor4" title="Urgent">
                                    <input id="report_urgent" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_urgent">

                                        <img src="<?php echo base_url('/assets/icons/Urgent-wb.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/Urgent-wb-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-radio tg-flagcolor4" title="Routine">
                                    <input id="report_routine" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_routine">
                                    <img src="<?php echo base_url('/assets/icons/Rotate.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/Rotate-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-radio tg-flagcolor4" title="2WW">
                                    <input id="report_2ww" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_2ww">
                                        <img src="<?php echo base_url('/assets/icons/2ww-wc.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/2ww-wc-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-cancel tg-flagcolor4" title="Clear" style="display: none;">
                                    <input id="report_clear" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_clear">
                                        <img src="<?php echo base_url(); ?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li>

                        <!-- <li class="tg-statusbar tg-flagcolor custome-flagcolors">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">

                                <span class="tg-radio tg-flagcolor4">
                                    <input id="report_urgent" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_urgent">
                                        <img src="<?php echo base_url('/assets/icons/Rotate.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/Rotate-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-radio tg-flagcolor4">
                                    <input id="report_routine" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_routine">
                                        <img src="<?php echo base_url('/assets/icons/Urgent-wb.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/Urgent-wb-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-radio tg-flagcolor4">
                                    <input id="report_2ww" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_2ww">
                                        <img src="<?php echo base_url('/assets/icons/2ww-wc.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/2ww-wc-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>
                                <span class="tg-cancel tg-flagcolor4" style="display: none;">
                                    <input class="tat" type="radio" name="tat" id="all_tat">
                                    <label for="all_tat">
                                        <img src="<?php echo base_url(); ?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li> -->
                        <li class="">
                       <a href="<?php echo base_url(); ?>doctor/published_reports/<?php echo date('Y') ?>/all/2" class="btn btn-success customBtn">New</a>
                       <a href="<?php echo base_url(); ?>doctor/published_reports/<?php echo date('Y') ?>/all/1" class="btn btn-success customBtn">Viewed</a>
                            <a href="<?php echo base_url(); ?>doctor/published_reports/<?php echo date('Y') ?>/all/3" class="btn btn-success customBtn">All</a>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors last pull-right" style="padding: 0 10px;">
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="tg-dashboardform tg-haslayout custom-haslayout">
        <div class="collapse" id="collapse_adv_search">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-dashboardformhold">
                        <form class="tg-formtheme tg-advancesearch" action="<?php echo base_url('index.php/doctor/search_request'); ?>" method="post">
                            <fieldset class="col-md-12">
                                <div class="col-md-3 form-width -group">
                                    <input class="form-control" type="text" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                                <div class="col-md-3  form-width form-group">
                                    <input class="form-control" type="text" id="sur_name" name="sur_name" placeholder="Last Name">
                                </div>
                                <div class="col-md-3 form-width form-group">
                                    <input class="form-control" type="text" id="nhs_no" name="nhs_no" placeholder="NHS Number">
                                </div>
                                <div class="col-md-2 form-group tg-inputicon">
                                    <i class="lnr lnr-calendar-full"></i>
                                    <input type="text" name="dob" id="adv_dob" class="form-control unstyled" placeholder="DOB">
                                </div>
                                <div class="col-md-1 form-group">
                                    <span class="tg-select">
                                        <select data-placeholder="Gender" name="gender">
                                            <option value="">Gender</option>
                                            <option value="male" selected>Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </span>
                                </div>
                                 <div class="col-md-2 form-group">
                                    <button type="submit" class="btn btn-success btn-search">Advance Search</button>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="collapse_filter_hospital" class="collapse">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-2">
                    <div class="tg-dashboardformhold">
                        <div class="tg-titlevtwo">
                            <h3>Filter By Hospital</h3>
                        </div>
                        <form method="post" class="filter_by_hospital_form">
                            <table class="table table-bordered">
                                <tr class="bg-primary">
                                    <th>Choose Clinic</th>
                                </tr>
                                <tr>
                                    <td class="col-md-12">
                                        <select class="form-control filter_by_hospital" name="filter_by_hospital">
                                            <option value="0">Choose Clinic</option>
                                            <?php
if (!empty($get_hospitals)) {
	foreach ($get_hospitals as $list_hospitals) {

		echo '<option value="' . $list_hospitals->id . '" ' . $selected . '>' . $list_hospitals->description . '</option>';
	}
}
?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <div class="pull-right">
                                <button type="button" class="btn btn-warning filter_by_hospital_btn">Filter Result</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <?php
if (isset($_GET['msg']) && $_GET['msg'] == 'success') {

	echo '<p class="bg-success" style="padding:7px;">Report Has Been Successfully Published.</p>';
}
if ($this->session->flashdata('unpublish_record_message') != '') {
	echo $this->session->flashdata('unpublish_record_message');
}
?>
            <?php
if ($this->session->flashdata('record_status') != '') {
	echo $this->session->flashdata('record_status');
}
?>
        </div>
    </div>

        <div class="row report_listing">
            <div class="col-md-12">
                <?php
if ($this->session->flashdata('message_further') != '') {
	?>
                    <p class="bg-success" style="padding:7px;"> <?php echo $this->session->flashdata('message_further'); ?></p>
                <?php }?>
                <?php
if ($this->session->flashdata('message_additional') != '') {
	?>
                    <p class="bg-success" style="padding:7px;"> <?php echo $this->session->flashdata('message_additional'); ?></p>
                <?php }?>
                <?php
if ($this->session->flashdata('final_report_message') != '') {
	echo $this->session->flashdata('final_report_message');
}
?>
                <?php
if ($this->session->flashdata('record_updated') != '') {
	echo $this->session->flashdata('record_updated');
}
?>
                <div class="flag_message"></div>
                <!-- <div class="form-group">
                    <button class="sort_by_authorize"><i class="fa fa-sort" style="margin-right:10px;"></i> Sort by authorize</button>
                </div> -->
                <style>
                    .flag_images:not(:hover) + .report_flags {
                        display: none;
                    }
                    ul.report_flags {
                        left: 88% !important;
                        top: 16%;
                        width: 90px;
                        background: #fff;
                        z-index: 1;
                        margin-left: 17px;
                    }
                </style>
                <table id="doctor_record_publish_table" class="table table-striped custom-table custom-search-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <!-- <th>
                                <input type="checkbox" name="check_all">
                                <a href="javascript:;" class="generate-bulk-reports" data-bulkurl="<?php echo base_url('index.php/doctor/generateBulkReports'); ?>">
                                <img width="22px" src="<?php //echo base_url('assets/icons/.png'); ?>">
                                <i class="fa fa-download"></i>
                                </a><input type="hidden" name="bulk_report_ids">
                            </th> -->
                            <th class="no-sort"><input type="checkbox" name="check_all" id="check_all_request"><a href="javascript:;" class="generate-bulk-reports" data-bulkurl="<?php echo base_url('index.php/institute/generateBulkReports'); ?>"><img style="min-width: 15px; width: 25px; margin-left: 5px;" src="<?php echo base_url('assets/img/download-1.png'); ?>"></a><input type="hidden" name="bulk_report_ids"></th>
                            <th>Lab No.</th>
                            <th>Patient</th>
                            <th>DOB</th>
                            <!-- <th>PCI No.</th> -->
                            <!-- <th style="width:80px !important">Digi No.<br>Rec by Lab.</th> -->
                            <th>Clinic</th>
                            <th>Clinician</th>
                            <th>
                                <!-- <i class="lnr lnr-layers" style="font-size:18px;"></i> -->
                                <img data-toggle="tooltip" title="Urgency"  src="<?php echo base_url('/assets/icons/Reported--UnReported.png'); ?>" class="img-responsive">
                            </th>


                            <!-- <th>Authorised</th> -->
                            <th>
                                <img data-toggle="tooltip" title="View" src="<?php echo base_url('/assets/icons/Status.png'); ?>" class="img-responsive">
                                <!-- Status -->
                            </th>
                            <th>Docs</th>

                            <th class="text-center">
                                <i class="lnr lnr-bubble" style="font-size:18px;" data-toggle="tooltip" title="Comments"></i>
                                <!-- <img src="<?php //echo base_url('/assets/icons/Comments.png'); ?>" class="img-responsive"> -->

                            </th>

                            <th class="text-center">
                                <i class="lnr lnr-file-empty" style="font-size:18px;" data-toggle="tooltip" title="Status"></i>
                                <!-- <img src="<?php //echo base_url('/assets/icons/Status.png'); ?>" class="img-responsive"> -->
                            </th>

                            <th style="text-align:center;">
                                <i class="fa fa-flag-o" data-toggle="tooltip" title="Flag"></i>
                                <!-- <img src="<?php //echo base_url('/assets/icons/flag-skyblue.png'); ?>" class="img-responsive"> -->
                            </th>


                            <!-- <th style="text-align:center;">
                                <img src="<?php //echo base_url('/assets/icons/Actions-Blue.png'); ?>" class="img-responsive">
                            </th> -->
                            <!-- <th></th>
                            <th class="text-right sorting_disabled" rowspan="1" colspan="1" style="width: 31px; padding-right: 15px !important">
                                <img data-toggle="tooltip" title="" src="<?php echo base_url('assets/icons/Actions-Blue.png'); ?>" class="img-responsive action_th_icon" data-original-title="Actions">
                            </th> -->
                            <th class="text-align:center">
                                <img data-toggle="tooltip" title="Un-Published" src="<?php echo base_url('assets/icons/UnPublish.png'); ?>">
                            </th>
                            
                            <th>Status</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="courier_request" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Courier Assignment Request</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group form-focus">
                                    <select class="form-control floating">
                                        <option selected="">UK</option>
                                        <option>Pakistan</option>
                                        <option>UAE</option>
                                        <option>India</option>
                                    </select>
                                    <label class="focus-label">Origin</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group form-focus">
                                    <select class="form-control floating">
                                        <option selected="">UK</option>
                                        <option>Pakistan</option>
                                        <option>UAE</option>
                                        <option>India</option>
                                    </select>
                                    <label class="focus-label">Destination</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Batch No.</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Courier No.</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Reference No.</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Parcel Weight</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group form-focus">
                                    <div class="cal-icon">
                                        <input class="form-control floating datetimepicker" type="text">
                                    </div>
                                    <label class="focus-label">Collection Date</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Collection Time.</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Sender Address</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Sender Post Code.</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Sender Phone No.</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group form-focus">
                                    <input type="email" class="form-control floating">
                                    <label class="focus-label">Sender Email</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Reciever Address</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Reciever Post Code</label>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-focus">
                                    <input type="text" class="form-control floating">
                                    <label class="focus-label">Reciver Phone No.</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <div class="form-focus">
                                    <input type="email" class="form-control floating">
                                    <label class="focus-label">Reciever Email</label>
                                </div>
                            </div>


                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center">
                    <button class="btn btn-info btn-rounded btn-lg" style="min-width:120px">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="patient_hl7" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title pdata" id="hl7_title">HL7 Content</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea id="hl7_content" rows="5" class="form-control pdata"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>