<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .dataTables_wrapper .row:first-child{height: 1px;}
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:0px;
        height: 37px !important;
        width: 50px !important;
        left: 15px;
        padding:0;
    }
    div.dataTables_wrapper .dataTables_filter{display: block !important; margin: 0; color: transparent;}
    .input-group-btn{
        right: 26px;
        z-index: 999;
    }
    div.dataTables_wrapper div.dataTables_filter label{
        margin: 0;
        color: transparent;
        font-size: 1px;
    }
       div.dataTables_wrapper div.dataTables_filter {
        position: relative;
        top: 0px;
        right: 15px;
        max-width: 222px;
        float: right;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        border-radius: 4px;
        height: 37px !important;
    }
    div.dataTables_wrapper div.dataTables_filter:before {
        content: "\f002";
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 40px;
        z-index: 9;
        background: #55ce63;
        text-align: center;
        line-height: 2.2;
        color: #fff;
        font-family: 'FontAwesome';
        cursor: pointer;
        height: 37px;
    }

.tg-searchrecordhold{padding: 0;}

    .form-focus .form-control {
        height: 36px;
        padding: 0 12px;
    }
    .comments_icon{
        position: relative;
    }
    .comments_icon .badge {
        position: absolute;
        top: -20px;
        right: -10px;
    }
    .users_hh {
        display: none; 
        position: absolute;
        top: 24px;
        background: #fff;
        font-size: 14px;
        border: 1px solid #ddd;
        padding: 0 5px;
        color: #555;
        cursor: default;
    }
    .like:hover .users_hh{
        display: block;
    }
    .btn-default{
        background: #f5f5f5 !important;
    }
    .breadcrumb{padding: 0 !important}
    
    .tg-cancel input{
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }
    ul.tg-filters.record-list-filters.new_fil li span label:focus {
        background: #006df1 !important;
        color: #fff;
    }
    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 45px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
    }
    .table .dropdown-action .dropdown-menu{
        min-width: 90px;
    }
    .table .dropdown-action .dropdown-menu .dropdown-item{
        font-size: 14px;
    }
    /*.flags_check span.tg-radio {
        display: none;
    }
    .flags_check span.tg-radio.first {
        display: block;
    }*/
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
    
    @media screen and (min-width: 1600px) {
        body{font-size: 18px;}
        .table .dropdown-action .dropdown-menu .dropdown-item{
            font-size: 16px;
        }
        div.dataTables_wrapper div.dataTables_filter{
            top: -66px;
            right: 60px;
        }
    }
    @media screen and (max-width: 1580px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }
    }
    @media screen and (max-width: 1024px) {
    .tg-filterhold {
    padding: 15px 0;
}
}
@media screen and (max-width: 768px) {
.tg-haslayout{
    width:100%!important;
    margin-left:20px!important;
}
.main-wrapper{
    overflow:hidden;
}
div.dataTables_wrapper div.dataTables_length select {
    top: 25px;
}
}
@media screen and (max-width: 580px) {
div.dataTables_wrapper div.dataTables_length select {
    top: 50px;
}
.no_work.bg-danger{
    margin-top: 100px!important;
    width: 90%;
}
div#further_work_table_requested_wrapper table.dataTable {
    margin-top: 60px !important;
}
}
@media screen and (max-width: 400px) {
.user-menu.nav > li > a {
    padding: 0 5px;
}
div.dataTables_wrapper div.dataTables_length select {
    top: 55px;
}
}
    ol.breadcrumb{float: left;}
    .no_work.bg-danger {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
}
.btn-default.bg_blue_select:hover {
    background: #006df1 !important;
    color: #fff !important;
    border-color: #006df1 !important;
}

#further_work_table_requested_wrapper div.row:nth-child(2) .col-sm-12{
    padding-right: 0;
}

button.pdf{
    padding: 5px 7px;
    position: relative;
    top: -15px;
}

button.pdf i{
    font-size: 16px;
}
</style>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 30px; padding-right: 30px;">
        <h3 class="page-title">Laboratory/ Requests</h3>
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                <li><a href="javascript:;">Dashboard</a></li>
                <li class="active">Requests</li>
            </ol>
            <div class="tg-rightarea">
                <div class="tg-haslayout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-filterhold">
                                <ul class="tg-filters record-list-filters">
                                    <!-- <li class="tg-statusbar tg-flagcolor">
                                        <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                            <span class="tg-radio tg-flagcolor1">
                                                <input class="tat" name="hostpital" id="nn" type="radio">
                                                <label for="nn"><span>NN</span></label>
                                            </span>
                                            <span class="tg-radio tg-flagcolor2">
                                                <input class="tat" type="radio" name="hostpital" id="vn">
                                                <label for="vn"><span>VN</span></label>
                                            </span>
                                            <span class="tg-radio tg-flagcolor3">
                                                <input class="tat" type="radio" name="hostpital" id="ss">
                                                <label for="ss"><span>SS</span></label>
                                            </span>
                                           
                                        </div>
                                    </li>
                                    <li>
                                        <button class="btn btn-default bg_blue_select btn-rounded btn-sm pdf" onclick="print()"><i class="fa fa-print fa-2x"></i></button>
                                        <button class="btn btn-default bg_red_select btn-rounded btn-sm pdf"><i class="fa fa-file-pdf-o fa-2x text-danger"></i></button>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class="tg-haslayout" style="width: 71%; margin-left: 84px; position: relative; z-index:1;">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold">
                    <ul class="tg-filters record-list-filters">
                        
                        <li class="tg-statusbar tg-flagcolor" style="padding: 5px; margin-left:0;">
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
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                                
                            </div>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors">
                            <select id="FilterTests">
                                <option value="">--Select Status--</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                            </select>
                        </li>
                       <!--   <li class="tg-flagcolor" style="padding: 3px 8px">
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
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li>
                        
                       <li class="tg-flagcolor" style="padding: 3px 8px">
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
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li> -->
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors">
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
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
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
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li> -->
                        <!-- <li class="tg-statusbar tg-flagcolor custome-flagcolors last pull-right" style="padding: 0 10px;">                              
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li> -->
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors pull-right nobefore search_li" style="padding: 0">
                            <!-- <div class="input-group">
                                <input type="text" class="form-control custom_search_datatable" placeholder="Search" id="publish_record_search">
                                <div class="input-group-btn">
                                  <button class="btn btn-success" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                  </button>
                                </div>
                            </div> -->
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
                                <div class="col-md-3 form-group">
                                    <input class="form-control" type="text" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                                <div class="col-md-3  form-group">
                                    <input class="form-control" type="text" id="sur_name" name="sur_name" placeholder="Last Name">
                                </div>
                                <div class="col-md-3 form-group">
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
                                                   
                                                    echo '<option value="' . $list_hospitals->id . '" '.$selected.'>' . $list_hospitals->description . '</option>';
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
    
    <div class="clearfix"></div>

    <div class="col-md-12 form-group" style="margin-top: -55px;padding-left: 30px; padding-right: 15px;">     
    <input type="hidden" id="lab_number" value="0"/>
    
        <table id="further_work_table_requested" class="table table-stripped custom-table">
            <thead>
                <tr>
                   
                    <th>Lab No.</th> 
                    <th>Patient Name</th>
                    <th>Requester</th> 
                    <!-- <th>Pathologist</th> -->
                    <th>Request Date & Time</th>
                    <th>Request Comment</th> 
                    <th style="text-align: center;">Total Tests </th> 
                    <th style="text-align: center;">
                        Status
                    </th>
                    <th>
                        <img data-toggle="tooltip" title="Actions" src="<?php echo base_url('/assets/icons/Actions-Blue.png'); ?>" class="img-responsive pull-right">
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($requested)) {
                    $count = 0;
                    foreach ($requested as $row) {  
                        $selectedStatus = '';
                        if($row->existingStatus != ''){
                            $currentStatus = explode(",",$row->existingStatus);
                            if(count($currentStatus) == 1){
                                $selectedStatus = $row->existingStatus;
                            }
                        }
                        //Test Counts
                        $sql = "SELECT block.*, fwd.test_id,lt.name as test_name, fwd.id as further_request_detail_id FROM specimen
                        INNER JOIN specimen_blocks as block on block.specimen_id=specimen.specimen_id
                        INNER JOIN further_work_detail as fwd on fwd.block_id=block.specimen_id AND fwd.test_id = block.specimen_no
                        INNER JOIN laboratory_tests as lt ON lt.id=fwd.test_id 
                        WHERE fwd.further_work_id = $row->fw_id GROUP BY id ORDER BY id desc";
                        $query = $this->db->query($sql);
                        $testcounts = count($query->result());

                        ?>
                        <tr id="further_<?php echo $row->fw_id; ?>" data-status="<?php echo $row->existingStatus ?>">
                           
                            <td><a href="<?php echo base_url(); ?>doctor/doctor_record_detail_old/<?php echo $row->request_id; ?>"><?= (!empty($row->lab_number) ? $row->lab_number : 'N/A'); ?></a></td>
                            <td><?= (!empty($row->patient_name) ? $row->patient_name : 'N/A'); ?></td>
                            <td><?php

                                $decryptedDetails = $this->Userextramodel->getUserDecryptedDetailsByid($row->doctor_id);
                                $profile_picture_path  = $decryptedDetails->profile_picture_path;
                                $img = get_profile_picture($profile_picture_path, $decryptedDetails->first_name, $decryptedDetails->last_name);
                                   echo "<img src=".$img." class='avatar' title=$row->requester>";

                                ?></td>
                            <td><?= date('d-m-Y h:i A', strtotime($row->furtherwork_date)); ?></td>
                            <td><?php echo $row->request_comment; ?></td>
                            <!-- <td></td> -->

                            <!-- <td style="text-align: center;">
                                <span class="badge badge-success"><?= $row->pathologist; ?></span>
                            </td> -->
                            <td style="text-align: center;">
                                <span class="badge badge-success"><?php echo $testcounts; ?></span>
                            </td>
                            <td style="text-align: center;">
                                <select class="change_further_status" data-rid="<?php echo $row->fw_id; ?>" data-action="global">
                                    <option value="">--Select Status--</option>
                                    <option value="pending" <?php  echo ($selectedStatus == 'pending') ? "selected" : ""; ?>>Pending</option>
                                    <option value="processing" <?php  echo ($selectedStatus == 'processing') ? "selected" : ""; ?>>Processing</option>
                                    <option value="completed" <?php  echo ($selectedStatus == 'completed') ? "selected" : ""; ?>>Completed</option>
                                </select>
                            </td>
                            <?php 
                            $parameters = array();
                            $parameters['lab_no'] = $row->lab_number;
                            $parameters['request_id'] = $row->request_id;                                                            
                            $parameters['lab_id'] = $row->id;
                            $parameters['test_id'] = $row->test_id; 

                            $parameters['test'] = $row->test_name;
                            $parameters['blockNo'] = $row->further_block_no;
                            $parameters['page'] = "further_work";
                            $parameters['dropdownSelector'] = 'blocks_'.$row->further_request_detail_id;
                            $parameters['dataValues'] = $row->lab_number.",".$row->pSurname;
                            $param = '';
                            $param = json_encode($parameters);

                            $rowData = json_encode($row);
                            ?>
                            <td style="text-align:center">
                                <div class="pull-right">
                                
                                <select multiple name="test_ids[]"  id="blocks_<?php echo $row->further_request_detail_id; ?>" placeholder="Test" class="test_wrap test-list form-control hide">
                                    <?php 
                                        echo '<option class="" value="'.$row->test_id.'" title="'.$row->test_id .' : '.$row->test_name.'" selected>'.$row->test_name.'</option>';
                                        ?>
                                </select>
                                    <!-- <a href='javascript:LoadFurtherWorkData(<?= $row->fw_id; ?>,"<?= $row->lab_number; ?>","<?= $row->request_id; ?>","<?= $row->id; ?>")'><i class="fa fa-eye"></i></a> -->
                                    <a href='javascript:LoadFurtherWorkData(<?php echo $rowData; ?>)'><i class="fa fa-eye"></i></a>
                                    <!-- <a href='javascript:barcode_type(<?= $param; ?>)' class='text-success' title="Print Barcode."><strong><i class="fa-2x fa fa-barcode m-r-5"></i></strong></a>
                                    <a href='javascript:barcode_type(<?= $param; ?>)' class='text-success' title="Print Barcode."><strong><i class="fa-2x fa fa-barcode m-r-5"></i></strong></a> -->
                                    <a href="<?php echo base_url('doctor/add_further_work_new/') . $row->request_id; ?>"<i class="fa fa-pencil edit_icon"></i></a>
                                    <!-- <a href="<?php echo base_url('doctor/doctor_record_detail_old/') . $row->request_id; ?>"><i class="fa fa-eye"></i></a> -->
                                </div>
                                <!-- <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div> -->
                            </td>
                        </tr>
                        <?php
                        $count++;
                    }//endforeach
                } else {
                    echo '<div class="no_work bg-danger" style="padding: 6px;margin-top: 176px;">No Further Work Requested Yet!.</div>';
                }//endif
                ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="modal fade" id="barcode_action" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Barcode Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id=''>
                            <div id="checkboxXontainer">

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group tg-inputwithicon">
                                        <label>How many label you wants to print </label>
                                        <select name="noOfLable" id="noOfLable" class="form-control">
                                            <?php for($i = 1; $i <= 10; $i++){ ?>
                                                <option value="<?php echo $i ?>" <?php echo ($i == 1) ? "selected" : ""; ?>><?php echo $i ?></option>    
                                            <?php } ?>
                                        </select>
                                        <!-- <input type="text" name="noOfLable" value="" onkeypress="return isNumber(event)" id="noOfLable" class="form-control" placeholder="Number of labels"> -->
                                        <!-- <span class="text-danger"></span> -->
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class='col-md-12 text-center'>
                                
                            <center class='center_class'>
                            <!-- <a href="javascript:barcode_p(this,1);" data-value="" id="btn_barcode" data-type="1"  class="btn btn-primary checkboxAction">Generate Barcode</a>
                            <a href="javascript:barcode_p(this,2);" data-value="" id="btn_sp_pot" data-type="2" class="btn btn-success checkboxAction">Specimen Pot</a>
                            <a href="javascript:barcode_p(this,2);" data-value="" id="btn_sp_request" data-type="2" class="btn btn-info checkboxAction">Request</a> -->
                            <a href="javascript:void(0);" onclick="download_request_barcode(this,2, 'single')" id="btn_download_request_cassete" class="inactiveLink btn btn-info checboxTextBox" data-repeat="1" data-values="<?php echo $request_query[0]->barcodeInfo->lab_no.",".$request_query[0]->barcodeInfo->pSurname ?>" data-blocks="<?php echo $request_query[0]->barcodeInfo->block_no_list;?>" data-tests="<?php echo $request_query[0]->barcodeInfo->testids;?>">Cassette</a>
                              <a href="javascript:void(0)" onclick="download_request_barcode(this,1,'single')" id="btn_download_request_slide" class="inactiveLink btn btn-info checboxTextBox" data-repeat="1" data-values="<?php echo $request_query[0]->barcodeInfo->lab_no.",".$request_query[0]->barcodeInfo->pSurname ?>" data-blocks="<?php echo $request_query[0]->barcodeInfo->block_no_list;?>" data-tests="<?php echo $request_query[0]->barcodeInfo->testids;?>">Slide</a>
                            </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="furtherInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Further Work Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body furtherInfoWrapper">
                </div>
            </div>
        </div>
    </div>
    <script src='<?= base_url() ?>assets/js/scripts/barcode.js'></script>
    <script src='<?= base_url() ?>assets/js/scripts/slide_label.js'></script>
    <script>
    $(document).ready(function(){
        $(document).on('change', '.change_status',function(){
            var rid = $(this).attr('data-rid');
            $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>/doctor/updateFurtherRequestStatus",
            data: {
                statusChange: $(this).val(),
                changeId: rid,
                [csrf_name]: csrf_hash
            },
            success: function (response) {
                location.reload();
            },
            error: function () {
                alert("Error");
            },
        });
        });

        $(document).on('change', '.change_further_status',function(){
            var rid = $(this).attr('data-rid');
            var actionType = $(this).attr('data-action');
            $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>/doctor/updateFurtherRequestStatus",
            data: {
                statusChange: $(this).val(),
                changeId: rid,
                actionType : actionType,
                [csrf_name]: csrf_hash
            },
            dataType: 'json',
            success: function (response) {
                // location.reload();
                if(response.status === 'success'){
                    jQuery.sticky("Status has been updated successfully!", {classList: 'success', speed: 200, autoclose: 7000});
                    window.setTimeout(function () {
                        location.reload();
                    }, 500);

                }else{
                    jQuery.sticky("Please choose any status to update!", {classList: 'important', speed: 200, autoclose: 5000});
                }
            },
            error: function () {
                alert("Error");
            },
        });
        });
    });
</script>

